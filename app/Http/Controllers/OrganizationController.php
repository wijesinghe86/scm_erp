<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
   
    public function index()
    {
        $organizations = Organization::get();
        return view('pages.Organization.index', compact('organizations'));
    }

    public function create()
    {
        $organization = new Organization;
        return view('pages.Organization.create', compact('organization'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'organization_code' => 'required',
            'organization_name' => 'required',
            'organization_tin_no'=>'required',
            'organization_phone_number' => 'required',
            'organization_address_line1'=>'required',
            'organization_address_line2'=>'required',
            

        ]);
            
        $request['created_by'] = Auth::id();
        Organization::create($request->all());

        $response['alert-success'] = 'New Organization created successfully!';
        return redirect()->route('organization.index')->with($response);

        }

       public function view($organization_id)
    {
        $response['organizations'] = Organization::find($organization_id);
        return view('pages.Organization.view')->with($response);
    }
    

    // public function print()
    // {
    //     $response['organizations'] = Customer::all();
    //     $pdf = PDF::loadview('pages.print.customerIndex', $response);
    //     // return $pdf->download('customers.pdf');
    //     return $pdf->stream('customers.pdf', array("Attachment" => false));
    // }

    public function getData(Request $request)
    {
        $organizations = Organization::find($request->organization_id);
        return $organizations;
    }
}
