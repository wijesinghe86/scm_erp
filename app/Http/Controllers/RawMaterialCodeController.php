<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsReceivedItem;
use App\Models\RawMaterialSerialCode;

class RawMaterialCodeController extends Controller
{

    public function index(Request $request)
    {
        $lists = RawMaterialSerialCode::with('item')->where('grn_item_id', $request->grn_item_id)->get();
        return view('pages.RawMaterialsSerialCodeAssigning.serial_no_table', compact('lists'));
    }

    public function store(Request $request)
    {
        // return[
        //     "fields"=>$request->all()
        // ];
        $grn_item = GoodsReceivedItem::with('grn')->where('id', $request->grn_item_id)->first();
        $serial_code = new RawMaterialSerialCode();

        $serial_code->grn_id = $grn_item->grn_id;
        $serial_code->entry_date = $grn_item->entry_date;
        $serial_code->grn_item_id = $request->grn_item_id;
        $serial_code->serial_no = $request->serial_no;
        $serial_code->qty = $request->qty;
        $serial_code->supplier_code = $request->supplier_code;
        $serial_code->warehouse_code = $grn_item->grn->warehouse;
        $serial_code->stock_item_id = $grn_item->stock_item_id;
        $serial_code->created_by = request()->user()->id;
        $serial_code->save();
    }

    public function delete(Request $request)
    {
        logger($request->all());
        $serial_code = RawMaterialSerialCode::find($request->id);

        if ($serial_code == null) {
            return [
                "success" => false,
                "msg" => "No records found on given id",
            ];
        }

        $serial_code->delete();

        return [
            "success" => true,
            "msg" => "Serial Code has been deleted",
        ];
    }
}
