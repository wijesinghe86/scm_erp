<?php

namespace App\Http\Controllers;

use App\Models\MrApproved;
use Illuminate\Http\Request;
use App\Models\MaterialRequest;
use App\Exceptions\ScmException;
use App\Models\MaterialRequestItem;

use Illuminate\Validation\ValidationException;


class MrApproveController extends ParentController
{
    public function index()
    {
        $lists = MrApproved::with(['materialRequest','item','requested', 'created_by'])
                ->latest()
                ->get();
        return view('pages.MaterialRequest.MRApprove.all',compact('lists'));
    }

    public function create()
    {
        $mr_list = MaterialRequest::with(['request_items', 'requested_by'])
                        ->whereHas('request_items',function($q){
                            $q->where('remaining_qty',">",0);
                        })
                        ->get();
        return view('pages.MaterialRequest.MRApprove.new', compact('mr_list'));
    }

    public function getMrfItems(Request $request){
        $lists =  MaterialRequestItem::with('item')
                ->where('mr_id',$request->mr_id)
                ->get();
        return view('pages.MaterialRequest.MRApprove.mrf_table',compact('lists'));
    }

    public function store(Request $request)
    {
      //dd($request->all());
        try{
        foreach ($request->items as $row)
        {
        if (!isset($row['is_selected']))
        {
        continue;
        }
        $item = MaterialRequestItem::with(['materialRequest','item'])->where('id', $row['mr_item_id'])->first();

        /***If item is not available error message will display**/
        if ($item == null) {
            throw validationException::withMessages(['mr_item_id'=>"Invalid Material Request item id"]);
        }

        if (floatval($item->remaining_qty) < floatval($row['qty'])) {
            throw new ScmException("Remaining qty is ".$item->remaining_qty." for ".$item->item->description);
        }

        $mr_approved = new MrApproved();
        $mr_approved->mr_item_id = $row['mr_item_id'];
        $mr_approved->mr_id = $item->mr_id;
        $mr_approved->requested_employee_id=$item->materialRequest->employee_id;
        $mr_approved->item_id = $row['item_id'];
        $mr_approved->qty = $row['qty'];
        $mr_approved->remaining_qty = $row['qty'];
        $mr_approved->status = $row['status'];
        $mr_approved->approved_for = $row['approved_for'];
        $mr_approved->remark = $row['remark'] ?? "";
        $mr_approved->created_user_id = request()->user()->id;
        $mr_approved->save();

        // if($mr_approved->status == "approved"){
        //update remaining qty in material request items
        $item->remaining_qty = $item->remaining_qty - $mr_approved->qty;
        $item->save();
        }
    } catch (ScmException $e) {
        flash()->error($e->getMessage());
        return redirect()->back()->withInput();
    } catch (\Exception $e) {
        flash()->error("Something went wrong please try again later");
        logger("Error material request approval", $request->all());
        return redirect()->back();
    }


        flash()->success("Material Request approval updated");
        return redirect()->back();
        // }

    }
}
