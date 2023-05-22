<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Warehouse;
use Illuminate\Http\Request;


class MaterialsReturnByCustomerController extends Controller
{
    public function index()
    {

         return view('pages.MaterialsReturnByCustomer.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        $customers = Customer::get();
        return view('pages.MaterialsReturnByCustomer.create',compact('warehouses','customers'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        MaterialsReturnByCustomer::create($request->all());

        $response['alert-success'] = 'Materials Return By Customer Details created successfully!';
        return redirect()->route('materialsreturnbycustomer.index')->with($response);
    }
}
