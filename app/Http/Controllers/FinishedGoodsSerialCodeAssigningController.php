<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FinishedGoodsSerialCodeAssigningController extends Controller
{
    public function index()
    {

         return view('pages.FinishedGoodsSerialCodeAssigning.index');
     }

     public function create()
    {
        return view('pages.FinishedGoodsSerialCodeAssigning.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        FinishedGoodsSerialCodeAssigning::create($request->all());

        $response['alert-success'] = 'Finished Goods Serial Code Assigning created successfully!';
        return redirect()->route('finishedgoodsserialcodeassigning.index')->with($response);
    }
}
