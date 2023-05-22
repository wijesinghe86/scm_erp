<?php

namespace App\Http\Controllers;

use App\Models\TaxCreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 

class TaxCreationController extends Controller
{
    public function index()
    {
        $taxcreations = TaxCreation::get();
         return view('pages.TaxCreation.index',compact('taxcreations'));
     }

     public function create()
    {
        // Later do this
        // $last_tc =  TaxCreation::latest()->first();
        // $last_tc_number = 0;
        // if($last_tc != null){
        //    $last_tc_number = $last_tc->id;
        // }
        // $next_number = "TC".sprintf("%06d", $last_tc_number+1);
        return view('pages.TaxCreation.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();
        $request['created_by']=Auth::id();
        TaxCreation::create($request->all());

        $response['alert-success'] = 'Tax Creation Details created successfully!';
        return redirect()->route('taxcreation.index')->with($response);
    }

    public function edit($taxcreation_id)
    {
        $response['taxcreations'] = TaxCreation::find($taxcreation_id);
        return view('pages.TaxCreation.edit')->with($response);
    }

    public function update(Request $request, $taxcreation_id)
    {
        $taxcreations = TaxCreation::find($taxcreation_id);
        $taxcreations->update($request->all());

        $request['updated_by']=Auth::id();
        TaxCreation::find($taxcreation_id)->update($request->all());

        $response['alert-success'] = 'Tax Creation updated successfully';
        return redirect()->route('taxcreation.index')->with($response);
    }

    public function delete($taxcreation_id)
    {
        $taxcreations = TaxCreation::find($taxcreation_id);
        $taxcreations->deleted_by = Auth::id();
        $taxcreations->save();
        $taxcreations->delete();

        $response['alert-success'] = 'Tax Creation deleted successfully';
        return redirect()->route('taxcreation.index')->with($response);
    }

    public function deleted()
    {
        $response['taxcreations'] = TaxCreation::onlyTrashed()->get();
        return view('pages.TaxCreation.deleted')->with($response);

    }

    public function restore($taxcreation_id)
    {
       $taxcreation=TaxCreation::withTrashed()->find($taxcreation_id);
       $taxcreation->restore();

       $response['alert-success'] = 'Tax Creation restore Successfully';
        return redirect()->route('taxcreation.deleted')->with($response);

    }

    public function Deleteforce($taxcreation_id)
    {
       $taxcreation=TaxCreation::withTrashed()->find($taxcreation_id);
       $taxcreation->forcedelete();

       $response['alert-success'] = 'Tax Creation deleted permanent';
        return redirect()->route('taxcreation.deleted')->with($response);

    }

    public function view($taxcreation_id)
    {


       $response['taxcreations'] = TaxCreation::find($taxcreation_id);
       return view('pages.TaxCreation.view')->with($response);

    }

    public function getData(Request $request)
    {
        $taxcreation = TaxCreation::find($request->section_id);
        return $taxcreation;
    }

    public function active($taxcreation_id)
    {
        $taxcreation = TaxCreation::find($taxcreation_id);
        $taxcreation->tax_creation_status = 1;
        $taxcreation->save();
        $response['alert-success'] = 'Section activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($taxcreation_id)
    {
        $taxcreation = TaxCreation::find($taxcreation_id);
        $taxcreation->tax_creation_status = 0;
        $taxcreation->save();
        $response['alert-success'] = 'Section deactivated successfully';
        return redirect()->back()->with($response);
    }
}
