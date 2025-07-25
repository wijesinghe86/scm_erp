<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\OpBalance;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Services\StockLogService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OpenningBalanceController extends Controller
{

    public function index(Request $request)
    {
        $openingBalance = OpBalance::with(['items', 'location', 'createdBy'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('ref_no', 'like', '%' . $request->search . '%')
                    ->orwhere('date', 'like', '%' . $request->search . '%')
                    ->orwhere('stock_id', 'like', '%' . $request->search . '%')
                    ->orWhere(function ($qr) use ($request) {
                        return $qr->whereHas('createdBy', function ($createdBy) use ($request) {
                            $createdBy->where('name', 'like', '%' . $request->search . '%');
                        });
                    })
                    ->orWhere(function ($qr) use ($request) {
                        return $qr->whereHas('location', function ($location) use ($request) {
                            $location->where('warehouse_name', 'like', '%' . $request->search . '%');
                        });
                    })
                    ->orWhere(function ($query) use ($request) {
                        return $query->whereHas('items', function ($items) use ($request) {
                            $items->where('description', 'like', '%' . $request->search . '%');
                        });
                    });
            })
            ->latest()->paginate(50);
        return view('pages.OpBal.index', compact('openingBalance'));
    }
        // $openingBalance = OpBalance::get();
        // return view ('pages.OpBal.index', compact('openingBalance'));

    public function create(Request $request)
    {
        // logger($request->all());
        $stock_items = StockItem::get();
        $warehouses = Warehouse::get();
        $ref_number = $request->ref_no;
        $warehouse_name = $request->warehouse;
        $justifications = $request->justification;
        return view('pages.OpBal.create', compact('stock_items','warehouses','ref_number', 'warehouse_name', 'justifications' ));
    }

    public function store(Request $request)
    {
        $stockLog = new StockLogService;

        $this->validate($request, [
            'ob_date'=>'required|date',
            'ref_no'=>'required',
            'warehouse'=>'required',
            'justification'=>'required',
            'stock_number'=>'required',
            'qty'=>'required',
        ]);

       try{

        DB::beginTransaction();
//check already exiest
    $is_exist = OpBalance::where('ref_no',$request->ref_no)->where('stock_id',$request->stock_number)->where('warehouse_id',$request->warehouse)->first();
        if ($is_exist) {
            throw ValidationException::withMessages(["Duplicate Entry"]);
        }

        $opBal = new OpBalance;
        $opBal->date = $request->ob_date;
        $opBal->ref_no = $request->ref_no;
        $opBal->warehouse_id = $request->warehouse;
        $opBal->justification = $request->justification;
        $opBal->stock_id = $request->stock_number;
        $opBal->qty = $request->qty;
        $opBal->created_by = request()->user()->id;
        $opBal->save();

        $stockLog->createLog(
            StockLogService::$OPENNING_BALANCE,
            $request->warehouse,
            $opBal->items->id,
            $request->qty,
            StockLogService::$ADD,
            $request->ref_no,
            $request->user()->id,
            null,
        );

        //Stock
        $stock= Stock::where('stock_item_id',$request->stock_id)->where('warehouse_id',$request->warehouse)->first();
        if(!$stock){
            throw ValidationException::withMessages(['item'=> "Stock Not found"]);
        }

        $stock->qty  = $stock->qty + $request->qty;
        $stock->save();

        DB::commit();

        if($request->addAnother){
            flash()->success("successfull!");
            return redirect()->route('obentry.create',['ref_no'=>$opBal->ref_no, 'warehouse_id'=> $opBal->warehouse_id, 'justification'=>$opBal->justification]);
        }

    flash()->success("successfull!");
    return redirect()->route('obentry.create');
       }catch(Exception $e ){
        DB::rollBack();
         flash()->success($e->getMessage());
        return redirect()->back();
       }

    }

    public function getStock (Request $request) {
        $this->validate($request,[
        'stock_item_id'=> 'required',
        'warehouse'=> 'required'
        ]);

        $stock= Stock::where('stock_item_id',$request->stock_item_id)->where('warehouse_id',$request->warehouse)->first();
        if(!$stock){
            throw ValidationException::withMessages(['item'=> "Stock Not found"]);
        }
        return $stock;
    }




}
