<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Warehouse;
use Illuminate\Http\Request;


class GoodsIssueNoteController extends Controller
{
    public function index()
    {

         return view('pages.GoodsIssueNote.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        $customers = Customer::get();
        return view('pages.GoodsIssueNote.create',compact('warehouses','customers'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        GoodsIssueNote::create($request->all());

        $response['alert-success'] = 'Goods Issue Note Details created successfully!';
        return redirect()->route('goodsissuenote.index')->with($response);
    }
}
