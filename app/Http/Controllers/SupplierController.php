<?php

namespace App\Http\Controllers;


use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function new()
    {
        $last_su =  Supplier::latest()->first();
        $last_su_number = 0;
        if ($last_su != null) {
            $last_su_number = $last_su->id;
        }
        $next_number = "SUP" . sprintf("%05d", $last_su_number + 1);
        return view('pages.Supplier.new', compact('next_number'));
    }

    public function all()
    {
        $suppliers = Supplier::get();
        return view('pages.Supplier.all', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_name' => 'required',
            'supplier_registration_type' => 'required',
            'supplier_type' => 'required'
        ]);


        $request['created_by'] = Auth::id();
        Supplier::create($request->all());

        $response['alert-success'] = 'Supplier Details created successfully!';
        return redirect()->route('supplier.all')->with($response);
    }

    public function edit($supplier_id)
    {
        $response['suppliers'] = Supplier::find($supplier_id);
        return view('pages.Supplier.edit')->with($response);
    }

    public function update(Request $request, $supplier_id)
    {
        $suppliers = Supplier::find($supplier_id);
        $suppliers->update($request->all());

        $request['updated_by'] = Auth::id();
        Supplier::find($supplier_id)->update($request->all());

        $response['alert-success'] = 'Supplier updated successfully';
        return redirect()->route('supplier.all')->with($response);
    }

    public function delete($supplier_id)
    {
        $suppliers = Supplier::find($supplier_id);
        $suppliers->deleted_by = Auth::id(); //soft Delete - not delete in the DB. it will delete from view only
        $suppliers->save(); // only we click the button it will save in DB
        $suppliers->delete(); //deleted in the Database

        $response['alert-success'] = 'Supplier deleted successfully';
        return redirect()->route('supplier.all')->with($response);
    }

    public function deleted()
    {
        $response['suppliers'] = Supplier::onlyTrashed()->get();
        return view('pages.Supplier.deleted')->with($response);
    }

    public function restore($supplier_id) //soft delete restore function
    {
        $suppliers = Supplier::withTrashed()->find($supplier_id);
        $suppliers->restore();

        $response['alert-success'] = 'supplier restore successfully';
        return redirect()->route('supplier.deleted')->with($response);
    }

    public function DeleteForce($supplier_id) //permanent delete function
    {
        $suppliers = Supplier::withTrashed()->find($supplier_id);
        $suppliers->forceDelete();

        $response['alert-success'] = 'supplier delete successfully';
        return redirect()->route('supplier.deleted')->with($response);
    }

    public function view($supplier_id)
    {
        $response['suppliers'] = Supplier::find($supplier_id);
        return view('pages.Supplier.view')->with($response);
    }

    public function active($supplier_id)
    {
        $suppliers = Supplier::find($supplier_id);
        $suppliers->supplier_status = 1;
        $suppliers->save();
        $response['alert-success'] = 'Supplier activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($supplier_id)
    {
        $suppliers = Supplier::find($supplier_id);
        $suppliers->supplier_status = 0;
        $suppliers->save();
        $response['alert-success'] = 'Supplier deactivated successfully';
        return redirect()->back()->with($response);
    }

    public function getData(Request $request)
    {
        $suppliers = Supplier::find($request->supplier_id);
        return $suppliers;
    }
}
