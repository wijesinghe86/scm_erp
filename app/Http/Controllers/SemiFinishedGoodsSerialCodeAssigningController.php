<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class SemiFinishedGoodsSerialCodeAssigningController extends Controller
{
    public function index()
    {

         return view('pages.SemiFinishedGoodsSerialCodeAssigning.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        return view('pages.SemiFinishedGoodsSerialCodeAssigning.create',compact('warehouses'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        SemiFinishedGoodsSerialCodeAssigning::create($request->all());

        $response['alert-success'] = 'Semi Finished Goods Serial Code Assigning created successfully!';
        return redirect()->route('semifinishedgoodsserialcodeassigning.index')->with($response);
    }
}
