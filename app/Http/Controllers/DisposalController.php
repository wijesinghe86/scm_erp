<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DisposalController;

class DisposalController extends Controller
{
    public function index()
    {

         return view('pages.Disposal.index');
     }

     public function create()
    {
        return view('pages.Disposal.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        Disposal::create($request->all());

        $response['alert-success'] = 'Disposal Details created successfully!';
        return redirect()->route('disposal.index')->with($response);
    }
}
