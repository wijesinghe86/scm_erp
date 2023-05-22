<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillTypeController extends ParentController
{
    public function all()
    {
        $response['billtypes'] = BillType::all();
        return view('pages.BillTypes.all')->with ($response);
    }

    public function new()
    {
        return view('pages.BillTypes.new');
    }

    public function get($billtype_id)
    {
        $response['billtypes'] = BillType::find($billtype_id);
        return view('pages.billtypes.get')->with($response);
    }

    public function store(Request $request)
    {
       /* dd($request->all());*/
       $request['created_by']=Auth::id();
       BillType::create($request->all());

       $response['alert-success'] = 'Billtype Details created successfully!';
        return redirect()->route('billtypes.all')->with($response);
    }
}
