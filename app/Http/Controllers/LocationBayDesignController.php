<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\LocationBayDesign;
use Illuminate\Support\Facades\Auth;


class LocationBayDesignController extends Controller
{
    public function index()
    {
        $locationbays = LocationBayDesign::get();
        return view('pages.Locationbaydesign.index',compact('locationbays'));
    }

    public function create()
    {
        $warehouses = Warehouse::get();
        return view ('pages.Locationbaydesign.create',compact('warehouses'));
    }

    public function store(Request $request)
    {

        $request['created_by']=Auth::id();
        LocationBayDesign::create($request->all());
        $response['alert-success'] = 'Location bay design Details created successfully!';
        return redirect()->route('locationbaydesign.index')->with($response);

    }

    public function edit($locationbaydesign_id)
    {
        $response['locationbays'] = LocationBayDesign::find($locationbaydesign_id);
        return view('pages.Locationbaydesign.edit')->with($response);
    }

    public function update(Request $request, $locationbaydesign_id)
    {
        $locationbaydesign = LocationBayDesign::find($locationbaydesign_id);
        $locationbaydesign->update($request->all());

        $request['updated_by']=Auth::id();
        LocationBayDesign::find($locationbaydesign_id)->update($request->all());

        $response['alert-success'] = 'Locationbaydesign updated successfully';
        return redirect()->route('locationbaydesign.index')->with($response);
    }

    public function delete($locationbaydesign_id)
    {
        $locationbaydesign = LocationBayDesign::find($locationbaydesign_id);
        $locationbaydesign->deleted_by = Auth::id();
        $locationbaydesign->save();
        $locationbaydesign->delete();

        $response['alert-success'] = 'Locationbaydesign deleted successfully';
        return redirect()->route('locationbaydesign.index')->with($response);
    }

    public function deleted()
    {
       $response['locationbays'] = Locationbaydesign::onlyTrashed()->get();
        return view('pages.Locationbaydesign.deleted')->with($response);

    }

    public function restore($locationbaydesign_id)
    {
        $locationbaydesign = LocationBayDesign::withTrashed()->find($locationbaydesign_id);
        $locationbaydesign->restore();

        $response['alert-success'] = 'Location bay design restore successfully';
        return redirect()->route('locationbaydesign.deleted')->with($response);
    }

    public function Deleteforce($locationbaydesign_id)
    {
        $locationbaydesign = LocationBayDesign::withTrashed()->find($locationbaydesign_id);
        $locationbaydesign->forcedelete();

        $response['alert-success'] = 'Location bay design deleted permanent';
        return redirect()->route('locationbaydesign.deleted')->with($response);
    }

    public function view($locationbaydesign_id)
    {
        $response['locationbays'] = LocationBayDesign::find($locationbaydesign_id);
        return view('pages.Locationbaydesign.view')->with($response);
    }

    public function getData(Request $request)
    {
        $locationbaydesign = LocationBayDesign::find($request->locationbaydesign_id);
        return $locationbaydesign;
    }

    public function active($locationbaydesign_id)
    {
        $locationbaydesign = LocationBayDesign::find($locationbaydesign_id);
        $locationbaydesign->locationbaydesign_status = 1;
        $locationbaydesign->save();
        $response['alert-success'] = 'Location bay design activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($locationbaydesign_id)
    {
        $locationbaydesign = LocationBayDesign::find($locationbaydesign_id);
        $locationbaydesign->locationbaydesign_status = 0;
        $locationbaydesign->save();
        $response['alert-success'] = 'Location bay design deactivated successfully';
        return redirect()->back()->with($response);
    }
}
