<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\GoodsReceived;
use App\Models\GoodsReceivedItem;
use App\Models\RawMaterialSerialCode;


class RawMaterialsSerialCodeAssigningController extends ParentController
{
    public function index()
    {
        $list = RawMaterialSerialCode::get();
         return view('pages.RawMaterialsSerialCodeAssigning.index', compact('list'));
     }

     public function create()
    {
        $grn_list = GoodsReceived::get();
        $warehouses = Warehouse::get();
        $items = session('grn_items') ??[];
        return view('pages.RawMaterialsSerialCodeAssigning.create', compact('grn_list', 'warehouses', 'items'));
    }

    public function getGrnItems(Request $request)
    {
        $lists = GoodsReceivedItem::with('item')
                 ->where('grn_id', $request->grn_id)
                 ->get();
        return view('pages.RawMaterialsSerialCodeAssigning.grn_table', compact('lists'));
}

// public function addSerialCode(Request $request)
// {
//     $items = session('grn_items') ?? [];

//     $items[] = [
//         'stockerial_code'=>$request->serial_code,
//         'sup_no'=>$row->item->stock_number,
//         'splier_code'=>$request->supplier_code,
//         'qty'=>$request->qty,
//     ];

//     session(['grn_items'=>$items]);
//     return redirrect()->back()->withInput();
// }
}
