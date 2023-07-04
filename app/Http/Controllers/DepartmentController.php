<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DepartmentController extends Controller
{
    public function index()
    {
        $departments =  Department::get();
         return view('pages.department.index',compact('departments'));
     }

     public function create()
    {
        $last_dp =  Department::latest()->first();
        $last_dp_number = 0;
        if($last_dp != null){
           $last_dp_number = $last_dp->id;
        }
        $next_number = "DEP".sprintf("%03d", $last_dp_number+1);
        return view('pages.department.create',compact('next_number'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        $this->validate($request, [
            'department_name' => 'required',
            'department_description' => 'required',

        ]);


        $request['created_by'] = Auth::id();
        Department::create($request->all());

        $response['alert-success'] = 'Department Details created successfully!';
        return redirect()->route('department.index')->with($response);
    }

    public function edit($department_id)
    {
        $response['departments'] = Department::find($department_id);
        return view('pages.department.edit')->with($response);
    }

    public function update(Request $request, $department_id)
    {
        $department = Department::find($department_id);
        $department->update($request->all());

        $request['updated_by']=Auth::id();
        Department::find($department_id)->update($request->all());

        $response['alert-success'] = 'Department updated successfully';
        return redirect()->route('department.index')->with($response);
    }

    public function delete($department_id)
    {
        $department = Department::find($department_id);
        //$department->deleted_by = Auth::id();
        //$department->save();
        $department->delete();

        $response['alert-success'] = 'Department deleted successfully';
        return redirect()->route('department.index')->with($response);
    }

    public function deleted()
    {
       $response['departments'] = Department::onlyTrashed()->get();
        return view('pages.department.deleted')->with($response);

    }

    public function restore($department_id)
    {
        $department = Department::withTrashed()->find($department_id);
        $department->restore();

        $response['alert-success'] = 'Department restore successfully';
        return redirect()->route('department.deleted')->with($response);
    }

    public function Deleteforce($department_id)
    {
        $department = Department::withTrashed()->find($department_id);
        $department->forcedelete();

        $response['alert-success'] = 'Department deleted permanent';
        return redirect()->route('department.deleted')->with($response);
    }

    public function view($department_id)
    {
        $response['departments'] = Department::find($department_id);
        return view('pages.Department.view')->with($response);
    }

    public function getData(Request $request)
    {
        $department = Department::find($request->department_id);
        return $department;
    }

    public function active($department_id)
    {
        $department = Department::find($department_id);
        $department->department_status = 1;
        $department->save();
        $response['alert-success'] = 'Department activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($department_id)
    {
        $department = Department::find($department_id);
        $department->department_status = 0;
        $department->save();
        $response['alert-success'] = 'Department deactivated successfully';
        return redirect()->back()->with($response);
    }
}
