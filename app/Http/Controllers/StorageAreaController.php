<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 

class StorageAreaController extends Controller
{
    public function index()
    {

         return view('pages.StorageArea.index');
     }

     public function create()
    {
        return view('pages.StorageArea.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        StorageArea::create($request->all());

        $response['alert-success'] = 'Storage Area created successfully!';
        return redirect()->route('storagearea.index')->with($response);
    }
}
