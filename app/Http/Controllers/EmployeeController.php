<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\FleetRegistration;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends ParentController
{
    public function new()
    {
        $response['departments'] = Department::all();
        $response['sections'] = Section::all();
        $response['fleets'] = FleetRegistration::all();

        $last_em = Employee::latest()->first();
        $last_em_number = 0;
        if($last_em != null){
           $last_em_number = $last_em->id;
        }
        $next_number = "EMP".sprintf("%05d", $last_em_number+1);
        return view('pages.Employee.new',compact('next_number'))->with($response);
    }

    public function all()
    {
        // $response['employees'] = Employee::all();
        // return view('pages.Employee.all')->with($response);

        $employees =  Employee::get();
        return view('pages.Employee.all',compact('employees'));
    }

    public function store(Request $request)
    {

        logger($request->all());

        $this->validate($request,[
            'employee_fullname'=>'required',
            'gender'=> "required",
            'civil_status'=> "required",
            'employee_type'=> "required",
        ]);
        $request['created_by']=Auth::id();
        Employee::create($request->all());
        // return redirect()->route('employee.all');

        $response['alert-success'] = 'Employee Details created successfully!';
        return redirect()->route('employee.all')->with($response);
    }

    public function edit($employee_id)
    {
        $response['employees'] = Employee::find($employee_id);
        return view('pages.Employee.edit')->with($response);
    }

    public function update(Request $request, $employee_id)
    {
        $employees = Employee::find($employee_id);
        $employees->update($request->all());

        $request['updated_by']=Auth::id();
        Employee::find($employee_id)->update($request->all());

        $response['alert-success'] = 'Employee updated successfully';
        return redirect()->route('employee.all')->with($response);
    }

    public function delete($employee_id)
    {
        $employees = Employee::find($employee_id);
        $employees->deleted_by = Auth::id(); //soft Delete - not delete in the DB. it will delete from view only
        $employees->save(); // only we click the button it will save in DB
        $employees->delete(); //deleted in the Database

        $response['alert-success'] = 'Employee deleted successfully';
        return redirect()->route('employee.all')->with($response);
    }

    public function deleted()
    {
        $response['employees'] = Employee::onlyTrashed()->get();
        return view('pages.Employee.deleted')->with($response);
    }

    public function restore($employee_id) //soft delete restore function
    {
        $employees = Employee::withTrashed()->find($employee_id);
        $employees->restore();

        $response['alert-success'] = 'Employee restore successfully';
        return redirect()->route('employee.deleted')->with($response);
    }

    public function DeleteForce($employee_id) //permanent delete function
    {
        $employee = Employee::withTrashed()->find($employee_id);
        $employee->forceDelete();

        $response['alert-success'] = 'Employee delete pernamently';
        return redirect()->route('employee.deleted')->with($response);
    }

    public function view($employee_id)
    {
        $response['employees'] = Employee::find($employee_id);
        return view('pages.Employee.view')->with($response);
    }

    public function getData(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        return $employee;
    }

    public function active($employee_id)
    {
        $employee = Employee::find($employee_id);
        $employee->employee_status = 1;
        $employee->save();
        $response['alert-success'] = 'Employee activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($employee_id)
    {
        $employee = Employee::find($employee_id);
        $employee->employee_status = 0;
        $employee->save();
        $response['alert-success'] = 'Employee deactivated successfully';
        return redirect()->back()->with($response);
    }
}
