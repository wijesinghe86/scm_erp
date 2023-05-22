<?php

namespace App\Http\Controllers;


use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\LocationBayDesign;
use App\Models\LocationRowDesign;
use App\Models\LocationRackDesign;
use Illuminate\Support\Facades\Auth;


class LocationRackDesignController extends Controller
{
    public function index()
    {
        $locationrackdesigns = LocationRackDesign::get();
        return view('pages.LocationRackDesign.index',compact('locationrackdesigns'));
    }

    public function create()
    {
        $warehouses = Warehouse::get();
        $locationbays = LocationBayDesign::get();
        $locationrowdesigns = LocationRowDesign::get();

        return view ('pages.LocationRackDesign.create', compact('warehouses','locationbays','locationrowdesigns'));
    }

    public function store(Request $request)
    {

        $request['created_by'] = Auth::id();
        LocationRackDesign::create($request->all());

        $response['alert-success'] = 'Location Rack Design Details created successfully!';
        return redirect()->route('locationrackdesign.index')->with($response);

    }

    public function edit($locationrackdesign_id)
    {
        $response['locationrackdesigns'] = LocationRackDesign::find($locationrackdesign_id);
        return view('pages.LocationRackDesign.edit')->with($response);
    }

    public function update(Request $request, $locationrackdesign_id)
    {
        $locationrackdesign = LocationRackDesign::find($locationrackdesign_id);
        $locationrackdesign->update($request->all());

        $request['updated_by']=Auth::id();
        LocationRackDesign::find($locationrackdesign_id)->update($request->all());

        $response['alert-success'] = 'Location Rack Design updated successfully';
        return redirect()->route('locationrackdesign.index')->with($response);
    }

    public function delete($locationrackdesign_id)
    {
        $locationrackdesign = LocationRackDesign::find($locationrackdesign_id);
        $locationrackdesign->deleted_by = Auth::id();
        $locationrackdesign->save();
        $locationrackdesign->delete();

        $response['alert-success'] = 'Location Rack Design deleted successfully';
        return redirect()->route('locationrackdesign.index')->with($response);
    }

    public function deleted()
    {
       $response['locationrackdesigns'] = LocationRackDesign::onlyTrashed()->get();
        return view('pages.LocationRackDesign.deleted')->with($response);

    }

    public function restore($locationrackdesign_id)
    {
        $locationrackdesign = LocationRackDesign::withTrashed()->find($locationrackdesign_id);
        $locationrackdesign->restore();

        $response['alert-success'] = 'Location Row Design restore successfully';
        return redirect()->route('locationrackdesign.deleted')->with($response);
    }

    public function Deleteforce($locationrackdesign_id)
    {
        $locationrackdesign = LocationRackDesign::withTrashed()->find($locationbaydesign_id);
        $locationrackdesign->forcedelete();

        $response['alert-success'] = 'Location Rack Design deleted permanent';
        return redirect()->route('locationrackdesign.deleted')->with($response);
    }

    public function view($locationrackdesign_id)
    {
        $response['locationrackdesigns'] = LocationRackDesign::find($locationrackdesign_id);
        return view('pages.LocationRackDesign.view')->with($response);
    }

    public function getData(Request $request)
    {
        $locationrackdesign = LocationRackDesign::find($request->locationrackdesign_id);
        return $locationrackdesign;
    }

    public function active($locationrackdesign_id)
    {
        $locationrackdesign = LocationRackDesign::find($locationrackdesign_id);
        $locationrackdesign->location_rack_design_status = 1;
        $locationrackdesign->save();
        $response['alert-success'] = 'location rack design activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($locationrackdesign_id)
    {
        $locationrackdesign = LocationRackDesign::find($locationrackdesign_id);
        $locationrackdesign->location_rack_design_status = 0;
        $locationrackdesign->save();
        $response['alert-success'] = 'location rack design deactivated successfully';
        return redirect()->back()->with($response);
    }
}
