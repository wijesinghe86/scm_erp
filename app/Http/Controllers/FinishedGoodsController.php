<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;


class FinishedGoodsController extends Controller
{
    public function index()
    {

         return view('pages.FinishedGoods.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        return view('pages.FinishedGoods.create',compact('warehouses'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        FinishedGoods::create($request->all());

        $response['alert-success'] = 'Finished Goods Details created successfully!';
        return redirect()->route('finishedgoods.index')->with($response);
    }
}
