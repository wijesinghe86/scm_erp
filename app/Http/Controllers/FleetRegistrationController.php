<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\FleetRegistration;
use Illuminate\Support\Facades\Auth;


class FleetRegistrationController extends Controller
{
    public function index()
    {
        $fleetregistrations = FleetRegistration::get();
         return view('pages.FleetRegistration.index',compact('fleetregistrations'));
     }

     public function create()
    {
        $last_fr =  FleetRegistration::latest()->first();
        $last_fr_number = 0;
        if($last_fr != null){
           $last_fr_number = $last_fr->id;
        }
        $next_number = "FLT".sprintf("%04d", $last_fr_number+1);
        return view('pages.FleetRegistration.create',compact('next_number'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();
        $request['created_by'] = Auth::id();
        FleetRegistration::create($request->all());

        $response['alert-success'] = 'Fleet Registration Details created successfully!';
        return redirect()->route('fleetregistration.index')->with($response);
    }

    public function edit($fleetregistration_id)
    {
        $response['fleetregistrations'] = FleetRegistration::find($fleetregistration_id);
        return view('pages.FleetRegistration.edit')->with($response);
    }

    public function update(Request $request, $fleetregistration_id)
    {
        $fleetregistrations = FleetRegistration::find($fleetregistration_id);
        $fleetregistrations->update($request->all());

        $request['updated_by']=Auth::id();
        FleetRegistration::find($fleetregistration_id)->update($request->all());

        $response['alert-success'] = 'Fleet Registration updated successfully';
        return redirect()->route('fleetregistration.index')->with($response);
    }


    public function delete($fleetregistration_id)
    {
        $fleetregistrations = FleetRegistration::find($fleetregistration_id);
        $fleetregistrations->deleted_by = Auth::id();
        $fleetregistrations->save();
        $fleetregistrations->delete(); //deleted in the Database

        $response['alert-success'] = 'Fleet Registration deleted successfully';
        return redirect()->route('fleetregistration.index')->with($response);
    }

    public function deleted()
    {
        $response['fleetregistrations'] = FleetRegistration::onlyTrashed()->get();
        return view('pages.FleetRegistration.deleted')->with($response);

    }

    public function restore($fleetregistration_id)
    {
        $fleetregistration=FleetRegistration::withTrashed()->find($fleetregistration_id);
        $fleetregistration->restore();

        $response['alert-success'] = 'Fleet Registration restore Successfully';
        return redirect()->route('FleetRegistration.deleted')->with($response);

    }

    public function Deleteforce($fleetregistration_id)
    {
        $fleetregistration=FleetRegistration::withTrashed()->find($fleetregistration_id);
        $fleetregistration->forcedelete();

        $response['alert-success'] = 'Fleet Registration deleted permanent';
        return redirect()->route('FleetRegistration.deleted')->with($response);

    }

    public function view($fleetregistration_id)
    {
        $response['fleetregistrations'] = FleetRegistration::find($fleetregistration_id);
        return view('pages.FleetRegistration.view')->with($response);
    }

    public function getData(Request $request)
    {
        $fleetregistration = FleetRegistration::find($request->fleetregistration_id);
        return $fleetregistration;
    }

    public function active($fleetregistration_id)
    {
        $fleetregistration = FleetRegistration::find($fleetregistration_id);
        $fleetregistration->fleet_registration_status = 1;
        $fleetregistration->save();
        $response['alert-success'] = 'Fleet Registration activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($fleetregistration_id)
    {
        $fleetregistration = FleetRegistration::find($fleetregistration_id);
        $fleetregistration->fleet_registration_status = 0;
        $fleetregistration->save();
        $response['alert-success'] = 'Fleet Registration deactivated successfully';
        return redirect()->back()->with($response);
    }
}
