<?php

namespace App\Http\Controllers;

use view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EquipmentRegistration;


class EquipmentRegistrationController extends Controller
{
    public function generateNextNumber()
    {
        $count  = EquipmentRegistration::get()->count();
        return "EQP" . sprintf('%05d', $count + 1);
    }


    public function index()
    {
        $equipmentregistrations = EquipmentRegistration::get();
         return view('pages.EquipmentRegistration.index',compact('equipmentregistrations'));
     }

     public function create()
    {
        // $last_er =  EquipmentRegistration::latest()->first();
        // $last_er_number = 0;
        // if($last_er != null){
        //    $last_er_number = $last_er->id;
        // }
        // $next_number = "EQP".sprintf("%05d", $last_er_number+1);
        $equipment = new EquipmentRegistration;
        $next_number = $this->generateNextNumber();
        return view('pages.EquipmentRegistration.create',compact('next_number', 'equipment'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        $isEqpExist = EquipmentRegistration::where('equipment_code', $request->equipment_code)->first();
        if ($isEqpExist) {
            $data['equipment_code'] = $this->generateNextNumber();
        }
        $request['created_by'] = Auth::id();
        EquipmentRegistration::create($request->all());

        $response['alert-success'] = 'Equipment Registration Details created successfully!';
        return redirect()->route('equipmentregistration.index')->with($response);
    }

    public function edit($equipmentregistration_id)
    {
        $response['equipmentregistrations'] = EquipmentRegistration::find($equipmentregistration_id);
        return view('pages.EquipmentRegistration.edit')->with($response);
    }

    public function update(Request $request, $equipmentregistration_id)
    {
        $equipmentregistrations = EquipmentRegistration::find($equipmentregistration_id);
        $equipmentregistrations->update($request->all());

        $request['updated_by']=Auth::id();
        EquipmentRegistration::find($equipmentregistration_id)->update($request->all());

        $response['alert-success'] = 'Equipment Registration updated successfully';
        return redirect()->route('equipmentregistration.index')->with($response);
    }

    public function delete($equipmentregistration_id)
    {
        $equipmentregistrations = EquipmentRegistration::find($equipmentregistration_id);
        $equipmentregistrations->deleted_by = Auth::id();
        $equipmentregistrations->save();
        $equipmentregistrations->delete();

        $response['alert-success'] = 'Equipment Registration deleted successfully';
        return redirect()->route('equipmentregistration.index')->with($response);
    }

    public function deleted()
    {
        $response['equipmentregistrations'] = EquipmentRegistration::onlyTrashed()->get();
        return view('pages.EquipmentRegistration.deleted')->with($response);

    }

    public function restore($equipmentregistration_id)
    {
       $equipmentregistration=EquipmentRegistration::withTrashed()->find($equipmentregistration_id);
       $equipmentregistration->restore();

       $response['alert-success'] = 'Equipment Registration restore Successfully';
        return redirect()->route('equipmentregistration.deleted')->with($response);

    }

    public function Deleteforce($equipmentregistration_id)
    {
       $equipmentregistration=EquipmentRegistration::withTrashed()->find($equipmentregistration_id);
       $equipmentregistration->forcedelete();

       $response['alert-success'] = 'Equipment Registration deleted permanent';
        return redirect()->route('equipmentregistration.deleted')->with($response);

    }

    public function view($equipmentregistration_id)
    {
        $response['equipmentregistrations'] = EquipmentRegistration::find($equipmentregistration_id);
        return view('pages.EquipmentRegistration.view')->with($response);
    }

    public function getData(Request $request)
    {
        $equipmentregistration = EquipmentRegistration::find($request->equipmentregistration_id);
        return $equipmentregistration;
    }

    public function active($equipmentregistration_id)
    {
        $equipmentregistration = EquipmentRegistration::find($equipmentregistration_id);
        $equipmentregistration->equipment_registration_status = 1;
        $equipmentregistration->save();
        $response['alert-success'] = 'Equipment Registration activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($equipmentregistration_id)
    {
        $equipmentregistration = EquipmentRegistration::find($equipmentregistration_id);
        $equipmentregistration->equipment_registration_status = 0;
        $equipmentregistration->save();
        $response['alert-success'] = 'Equipment Registration deactivated successfully';
        return redirect()->back()->with($response);
    }
}
