<?php

namespace App\Http\Controllers;



use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\PlantRegistration;
use Illuminate\Support\Facades\Auth;


class PlantRegistrationController extends Controller
{

    public function generateNextNumber()
    {
        $count  = PlantRegistration::get()->count();
        return "PLT" . sprintf('%05d', $count + 1);
    }

    public function index()
    {
        $plantregistrations = PlantRegistration::get();
        return view('pages.PlantRegistration.index',compact('plantregistrations'));
    }

     public function create()
    {
        $warehouses = Warehouse::get();

        // $last_pr =  PlantRegistration::latest()->first();
        // $last_pr_number = 0;
        // if($last_pr != null){
        //    $last_pr_number = $last_pr->id;
        // }
        // $next_number = "PLT".sprintf("%05d", $last_pr_number+1);
        $plant = new PlantRegistration;
        $next_number = $this->generateNextNumber();


        return view('pages.PlantRegistration.create',compact('warehouses', 'next_number', 'plant'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();
        $this->validate($request, [
            'plant_number' => 'required',
            'plant_name' => 'required',
            'plant_serial_number' => 'required'

        ]);

        $isPtlExist = PlantRegistration::where('plant_number', $request->plant_number)->first();
            if ($isPtlExist) {
                $data['plant_number'] = $this->generateNextNumber();
            }


        $request['created_by']=Auth::id();
        PlantRegistration::create($request->all());

        $response['alert-success'] = 'Plant Registration Details created successfully!';
        return redirect()->route('PlantRegistration.index')->with($response);
    }

    public function edit($plantregistration_id)
    {
        $response['plantregistrations'] = PlantRegistration::find($plantregistration_id);
        return view('pages.PlantRegistration.edit')->with($response);
    }

    public function update(Request $request, $plantregistration_id)
    {
        $plantregistrations = PlantRegistration::find($plantregistration_id);
        $plantregistrations->update($request->all());

        $request['updated_by']=Auth::id();
        PlantRegistration::find($plantregistration_id)->update($request->all());

        $response['alert-success'] = 'Plant Registration updated successfully';
        return redirect()->route('PlantRegistration.index')->with($response);
    }

    public function delete($plantregistration_id)
    {
        $plantregistrations = PlantRegistration::find($plantregistration_id);
        $plantregistrations->deleted_by = Auth::id();
        $plantregistrations->save();
        $plantregistrations->delete();

        $response['alert-success'] = 'Plant Registration deleted successfully';
        return redirect()->route('PlantRegistration.index')->with($response);
    }

    public function deleted()
    {
        $response['plantregistrations'] = PlantRegistration::onlyTrashed()->get();
        return view('pages.PlantRegistration.deleted')->with($response);

    }

    public function restore($plantregistration_id)
  {
       $plantregistrations=PlantRegistration::withTrashed()->find($plantregistration_id);
     $plantregistrations->restore();

        $response['alert-success'] = 'Plant Registration restore Successfully';
        return redirect()->route('PlantRegistration.deleted')->with($response);

    }

    public function Deleteforce($plantregistration_id)
    {
       $plantregistrations=PlantRegistration::withTrashed()->find($plantregistration_id);
       $plantregistrations->forcedelete();

        $response['alert-success'] = 'Plant Registration deleted permanent';
        return redirect()->route('PlantRegistration.deleted')->with($response);

     }

     public function view($plantregistration_id)
    {
        $response['plantregistrations'] = PlantRegistration::find($plantregistration_id);
        return view('pages.PlantRegistration.view')->with($response);
    }

    public function getData(Request $request)
    {
        $plantregistration = PlantRegistration::find($request->plantregistration_id);
        return $plantregistration;
    }

    public function active($plantregistration_id)
    {
        $plantregistration = PlantRegistration::find($plantregistration_id);
        $plantregistration->plant_registration_status = 1;
        $plantregistration->save();
        $response['alert-success'] = 'Plant Registration activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($plantregistration_id)
    {
        $plantregistration = PlantRegistration::find($plantregistration_id);
        $plantregistration->plant_registration_status = 0;
        $plantregistration->save();
        $response['alert-success'] = 'Plant Registration deactivated successfully';
        return redirect()->back()->with($response);
    }
}
