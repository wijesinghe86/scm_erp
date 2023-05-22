<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;


class OverShortageAndDamageController extends Controller
{
    public function index()
    {

         return view('pages.OverShortageAndDamage.index');
     }

     public function create()
    {
        $suppliers = Supplier::get();
        return view('pages.OverShortageAndDamage.create',compact('suppliers'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        OverShortageAndDamage::create($request->all());

        $response['alert-success'] = 'Over Shortage And Damage Details created successfully!';
        return redirect()->route('overshortanddamage.index')->with($response);
    }
}
