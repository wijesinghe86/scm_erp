<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\LocationBayDesign;
use App\Models\LocationRowDesign;
use App\Models\LocationRackDesign;
use App\Models\LocationShelfDesign;
use Illuminate\Support\Facades\Auth;


class LocationShelfDesignController extends Controller
{
    public function index()
    {
        $locationshelfdesigns = LocationShelfDesign::get();
        return view('pages.LocationShelfDesign.index',compact('locationshelfdesigns'));
    }

    public function create()
    {
        $warehouses = Warehouse::get();
        $locationbays = LocationBayDesign::get();
        $locationrowdesigns = LocationRowDesign::get();
        $locationrackdesigns = LocationRackDesign::get();

        return view ('pages.LocationShelfDesign.create', compact('warehouses','locationbays','locationrowdesigns','locationrackdesigns'));
    }

    public function store(Request $request)
    {

        $request['created_by'] = Auth::id();
        LocationShelfDesign::create($request->all());

        $response['alert-success'] = 'Location Shelf Design Details created successfully!';
        return redirect()->route('locationshelfdesign.index')->with($response);

    }

    public function edit($locationshelfdesign_id)
    {
        $response['locationshelfdesigns'] = LocationShelfDesign::find($locationshelfdesign_id);
        return view('pages.LocationShelfDesign.edit')->with($response);
    }

    public function update(Request $request, $locationshelfdesign_id)
    {
        $locationshelfdesign = LocationShelfDesign::find($locationshelfdesign_id);
        $locationshelfdesign->update($request->all());

        $request['updated_by']=Auth::id();
        LocationShelfDesign::find($locationshelfdesign_id)->update($request->all());

        $response['alert-success'] = 'Location Shelf Design updated successfully';
        return redirect()->route('locationshelfdesign.index')->with($response);
    }

    public function delete($locationshelfdesign_id)
    {
        $locationshelfdesign = LocationShelfDesign::find($locationshelfdesign_id);
        $locationshelfdesign->deleted_by = Auth::id();
        $locationshelfdesign->save();
        $locationshelfdesign->delete();

        $response['alert-success'] = 'Location Shelf Design deleted successfully';
        return redirect()->route('locationshelfdesign.index')->with($response);
    }

    public function deleted()
    {
       $response['locationshelfdesigns'] = LocationShelfDesign::onlyTrashed()->get();
        return view('pages.LocationShelfDesign.deleted')->with($response);

    }

    public function restore($locationshelfdesign_id)
    {
        $locationshelfdesign = LocationShelfDesign::withTrashed()->find($locationshelfdesign->id);
        $locationshelfdesign->restore();

        $response['alert-success'] = 'Location Shelf Design restore successfully';
        return redirect()->route('locationshelfdesign.deleted')->with($response);
    }

    public function Deleteforce($locationshelfdesign_id)
    {
        $locationshelfdesign = LocationShelfDesign::withTrashed()->find($locationshelfdesign_id);
        $locationshelfdesign->forcedelete();

        $response['alert-success'] = 'Location Shelf Design deleted permanent';
        return redirect()->route('locationshelfdesign.deleted')->with($response);
    }


    public function view($locationshelfdesign_id)
    {
        $response['locationshelfdesigns'] = LocationShelfDesign::find($locationshelfdesign_id);
        return view('pages.LocationShelfDesign.view')->with($response);
    }

    public function getData(Request $request)
    {
        $locationshelfdesign = LocationShelfDesign::find($request->locationshelfdesign_id);
        return $locationshelfdesign;
    }

    public function active($locationshelfdesign_id)
    {
        $locationshelfdesign = LocationShelfDesign::find($locationshelfdesign_id);
        $locationshelfdesign->location_shelf_design_status = 1;
        $locationshelfdesign->save();
        $response['alert-success'] = 'Location Shelf Design activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($locationrowdesign_id)
    {
        $locationshelfdesign = LocationShelfDesign::find($locationshelfdesign_id);
        $locationshelfdesign->location_shelf_design_status = 0;
        $locationshelfdesign->save();
        $response['alert-success'] = 'Location Shelf Design deactivated successfully';
        return redirect()->back()->with($response);
    }
}
