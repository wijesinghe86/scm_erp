<?php

namespace App\Http\Controllers;

use view;
use App\Models\Warehouse;
use Illuminate\Http\Request;

use App\Models\LocationBayDesign;
use App\Models\LocationRowDesign;
use Illuminate\Support\Facades\Auth;

class LocationRowDesignController extends Controller
{
    public function index()
    {
        $locationrowdesigns = LocationRowDesign::get();
        return view('pages.Locationrowdesign.index', compact('locationrowdesigns'));
    }

     public function create()
    {
        $warehouses = Warehouse::get();
        $locationbays = LocationBayDesign::get();

        return view ('pages.Locationrowdesign.create', compact('warehouses','locationbays'));

        // $response['warehouse'] = Warehouse::all();
        // $response['locationbaydesign'] = LocationBayDesign::all();
        // return view('pages.locationrowdesign.create')->with($response);

    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Supplier::create($request->all());

        $request['created_by'] = Auth::id();
        LocationRowDesign::create($request->all());

        $response['alert-success'] = 'Location row design Details created successfully!';
        return redirect()->route('locationrowdesign.index')->with($response);
    }

    public function edit($locationrowdesign_id)
    {

        $response['locationrowdesigns'] = LocationRowDesign::find($locationrowdesign_id);
        return view('pages.LocationrowDesign.edit')->with($response);
    }

    public function update(Request $request, $locationrowdesign_id)
    {
        $locationrowdesign = LocationRowDesign::find($locationrowdesign_id);
        $locationrowdesign->update($request->all());

        $request['updated_by']=Auth::id();
        LocationRowDesign::find($locationrowdesign_id)->update($request->all());

        $response['alert-success'] = 'Location Row Design updated successfully';
        return redirect()->route('locationrowdesign.index')->with($response);
    }

    public function delete($locationrowdesign_id)
    {
        $locationrowdesign = LocationRowDesign::find($locationrowdesign_id);
        $locationrowdesign->deleted_by = Auth::id();
        $locationrowdesign->save();
        $locationrowdesign->delete();

        $response['alert-success'] = 'Location Row Design deleted successfully';
        return redirect()->route('locationrowdesign.index')->with($response);
    }

    public function deleted()
    {
       $response['locationrowdesigns'] = LocationRowDesign::onlyTrashed()->get();
        return view('pages.Locationrowdesign.deleted')->with($response);

    }

    public function restore($locationrowdesign_id)
    {
        $locationrowdesign = LocationRowDesign::withTrashed()->find($locationrowdesign_id);
        $locationrowdesign->restore();

        $response['alert-success'] = 'Location Row Design restore successfully';
        return redirect()->route('locationrowdesign.deleted')->with($response);
    }

    public function Deleteforce($locationrowdesign_id)
    {
        $locationrowdesign = LocationRowDesign::withTrashed()->find($locationrowdesign_id);
        $locationrowdesign->forcedelete();

        $response['alert-success'] = 'Location Row Design deleted permanent';
        return redirect()->route('locationrowdesign.deleted')->with($response);
    }

    public function view($locationrowdesign_id)
    {
        $response['locationrowdesigns'] = LocationRowDesign::find($locationrowdesign_id);
        return view('pages.locationrowdesign.view')->with($response);
    }

    public function getData(Request $request)
    {
        $locationrowdesign = LocationRowDesign::find($request->locationrowdesign_id);
        return $locationrowdesign;
    }

    public function active($locationrowdesign_id)
    {
        $locationrowdesign = LocationRowDesign::find($locationrowdesign_id);
        $locationrowdesign->locationrowdesign_status = 1;
        $locationrowdesign->save();
        $response['alert-success'] = 'location row design activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($locationrowdesign_id)
    {
        $locationrowdesign = LocationRowDesign::find($locationrowdesign_id);
        $locationrowdesign->locationrowdesign_status = 0;
        $locationrowdesign->save();
        $response['alert-success'] = 'location row design deactivated successfully';
        return redirect()->back()->with($response);
    }
}
