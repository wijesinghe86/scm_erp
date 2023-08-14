<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\OpBalance;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\OpBalanceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OpenningBalanceController extends Controller
{
    public function create()
    {
        $stock_items = StockItem::get();
        $warehouses = Warehouse::get();
        return view('pages.OpBal.create', compact('stock_items','warehouses'));
    }

    public function store(Request $request)
    {
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
        
        $opBal = new OpBalance;
        $opBal->date = $request->ob_date;
        $opBal->ref_no = $request->ref_no;
        $opBal->warehouse_id = $request->warehouse;
        $opBal->justification = $request->justification;
        $opBal->created_by = request()->user()->id;
        $opBal->save();

        $opBalItem = new OpBalanceItem;
        $opBalItem->op_bal_id = $opBal->ref_no;
        $opBalItem->stock_id = $request->stock_number;
        $opBalItem->qty = $request->qty;
        $opBalItem->save();

        //Stock
        $stock= Stock::where('stock_item_id',$request->stock_number)->where('warehouse_id',$request->warehouse)->first();
        if(!$stock){
            throw ValidationException::withMessage(['item'=> "Stock Not found"]);
        }

        $stock->qty  = $stock->qty + $request->qty;
        $stock->save();

        DB::commit();

    flash()->success("successfull!");
    return redirect()->route('obentry.create');
       }catch(Exception $e ){
        logger($e->getMessage());
        DB::rollBack();
       }

    }

    public function getStock (Request $request) {
        $this->validate($request,[
        'stock_item_id'=> 'required',
        'warehouse'=> 'required'
        ]);

        logger($request->all());

        $stock= Stock::where('stock_item_id',$request->stock_item_id)->where('warehouse_id',$request->warehouse)->first();
        if(!$stock){
            throw ValidationException::withMessage(['item'=> "Stock Not found"]);
        }
        
        logger($stock);

        return $stock;
    }

    

    
}
