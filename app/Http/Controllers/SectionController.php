<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SectionController extends Controller
{
    public function index()
    {
        $response['sections'] = Section::all();
        return view('pages.Section.index')->with($response);
    }


     public function create()

    {
        $departments = Department::get();

        $last_se =  Section::latest()->first();
        $last_se_number = 0;
        if($last_se != null){
           $last_se_number = $last_se->id;
        }
        $next_number = "SEC".sprintf("%03d", $last_se_number+1);
        return view ('pages.Section.create', compact('departments', 'next_number'));

    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        $request['created_by'] = Auth::id();
        Section::create($request->all());

        $response['alert-success'] = 'Section Details created successfully!';
        return redirect()->route('section.index')->with($response);
    }

    public function edit($section_id)
    {
        $departments = Department::get();
        $response['sections'] = Section::find($section_id);
        return view('pages.Section.edit', compact('departments'))->with($response);
    }

    public function update(Request $request, $section_id)
    {
        $sections = Section::find($section_id);
        $sections->update($request->all());

        $request['updated_by']=Auth::id();
        Section::find($section_id)->update($request->all());

        $response['alert-success'] = 'Section updated successfully';
        return redirect()->route('section.index')->with($response);
    }

    public function delete($section_id)
    {
        $section = Section::find($section_id);
        $section->deleted_by = Auth::id();
        $section->save();
        $section->delete();

        $response['alert-success'] = 'Section deleted successfully';
        return redirect()->route('section.index')->with($response);
    }

    public function deleted()
    {
       $response['sections'] = Section::onlyTrashed()->get();
        return view('pages.Section.deleted')->with($response);

    }

    public function restore($section_id)
    {
        $section = Section::withTrashed()->find($section_id);
        $section->restore();

        $response['alert-success'] = ' restore successfully';
        return redirect()->route('section.deleted')->with($response);
    }

    public function Deleteforce($section_id)
    {
        $section = Section::withTrashed()->find($section_id);
        $section->forcedelete();

        $response['alert-success'] = 'Section deleted permanent';
        return redirect()->route('section.deleted')->with($response);
    }

    public function view($section_id)
    {
        $response['sections'] = Section::find($section_id);
        return view('pages.Section.view')->with($response);
    }

    public function getData(Request $request)
    {
        $section = Section::find($request->section_id);
        return $section;
    }

    public function active($section_id)
    {
        $section = Section::find($section_id);
        $section->section_status = 1;
        $section->save();
        $response['alert-success'] = 'Section activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($section_id)
    {
        $section = Section::find($section_id);
        $section->section_status = 0;
        $section->save();
        $response['alert-success'] = 'Section deactivated successfully';
        return redirect()->back()->with($response);
    }
}
