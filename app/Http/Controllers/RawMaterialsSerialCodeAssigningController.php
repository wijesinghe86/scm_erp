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
    public function index(Request $request)
    {
        $list = RawMaterialSerialCode::with(['grn', 'item'])
        ->when($request->search, function($q) use ($request){
          $q->where('serial_no', 'like', '%' . $request->search . '%')
          ->orWhere(function ($qr) use ($request){
          return $qr->whereHas('grn', function ($grn) use ($request){
          $grn->where('grn_no', 'like', '%' . $request->search . '%');
          });
            })

    ->orWhere(function ($query) use ($request){
    return $query->whereHas('item', function ($item) use ($request){
        $item->where('stock_number', 'like', '%' . $request->search . '%');
});
});

})

        ->latest()
        ->paginate(25);
        return view('pages.RawMaterialsSerialCodeAssigning.index', compact('list'));

        // $list = RawMaterialSerialCode::get();
        //  return view('pages.RawMaterialsSerialCodeAssigning.index', compact('list'));
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
