<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Warehouse;
use App\Models\DamageReturn;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Services\StockLogService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class DamageReturnController extends Controller
{
    public function index()
    {
        $damage_returns = DamageReturn::with(['ori_items','dmg_items', 'location', 'createdBy'])->get();
        return view('pages.DamageReturn.index', compact('damage_returns'));
    }

    public function generateNextNumber()
    {
        $count  = DamageReturn::get()->count();
        return "DR" . sprintf('%06d', $count + 1);
    }

    public function create()
{
    $warehouses = Warehouse::get();
    $stock_items = StockItem::get();
    $delivery_orders = DeliveryOrder::get();
    $next_number = $this->generateNextNumber();
    return view('pages.DamageReturn.create', compact('warehouses', 'stock_items', 'delivery_orders', 'next_number'));
}

public function store(Request $request)
    {
    $stockLog = new StockLogService;

        $this->validate($request, [
            'damage_date'=>'required|date',
            'reference_no'=>'required',
            'warehouse'=>'required',
            'reason'=>'required',
            'dmg_stock_number'=>'required',
            'qty'=>'required',
        ]);

       try{

        DB::beginTransaction();
//check already exiest

$isDrExist = DamageReturn::where('dr_no', $request->dr_no)->first();
if ($isDrExist) {
    $data['dr_no'] = $this->generateNextNumber();
}

        $dmgRtn = new DamageReturn();
        $dmgRtn->date = $request->damage_date;
        $dmgRtn->dr_no = $request->dr_no;
        $dmgRtn->reference_id = $request->reference_no;
        $dmgRtn->warehouse_id = $request->warehouse;
        $dmgRtn->reason = $request->reason;
        $dmgRtn->ori_stock_id = $request->ori_stock_number;
        $dmgRtn->dmg_stock_id = $request->dmg_stock_number;
        $dmgRtn->qty = $request->qty;
        $dmgRtn->created_by = request()->user()->id;
        $dmgRtn->save();

        $stockLog->createLog(
            StockLogService::$DAMAGE_RETURN,
            $request->warehouse,
            $request->stock_id,
            $request->qty,
            StockLogService::$ADD,
            $request->dr_no,
            $request->user()->id,
            null,
        );
        logger('$stockLog');

        //Stock
        $stock= Stock::where('stock_item_id',$request->dmg_stock_id)->where('warehouse_id',$request->warehouse)->first();
        if(!$stock){
            throw ValidationException::withMessages(['item'=> "Stock Not found"]);
        }

        $stock->qty  = $stock->qty + $request->qty;
        $stock->save();

        DB::commit();

        if($request->addAnother){
            flash()->success("successfull!");
            return redirect()->route('obentry.create');
        }

    flash()->success("successfull!");
    return redirect()->route('damage_return.create');
       }catch(Exception $e ){
        DB::rollBack();
         flash()->success($e->getMessage());
        return redirect()->back();
       }

    }

    public function print($dr_id)
    {
        $delivery_orders = DeliveryOrder::get();
        $dr_list =DamageReturn::find($dr_id);

        if ($dr_list == null) {
            return abort(404);
        }

        $pdf = PDF::loadView('pages.DamageReturn.print', compact('delivery_orders', 'dr_list'))->setPaper('A5','landscape');
        return $pdf->stream();

    }

}
