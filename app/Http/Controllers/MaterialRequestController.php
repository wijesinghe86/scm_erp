<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Models\MaterialRequest;
use App\Models\MaterialRequestItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MaterialRequestController extends Controller
{


    public function index()
    {
        $lists =  MaterialRequest::with ('request_items.item')->get();
        return view('pages.MaterialRequest.index',compact('lists'));

    }
    public function generateNextNumber()
    {
        $count  = MaterialRequest::get()->count();
        return "MR" . sprintf('%04d', $count + 1);
    }

    public function create()
    {
        //session(['mr.items'=>[]]); // for clear session
        $employees = Employee::with(['departmentData','sectionData'])->get();
        $stockItems = StockItem::get();

        $items = session('mr.items') ?? [];
        $materialRequest = new MaterialRequest;
        $next_number = $this->generateNextNumber();
        return view('pages.MaterialRequest.create', compact('employees', 'stockItems', 'items', 'next_number'));

        // $last_mr =  MaterialRequest::latest()->first();
        // $last_mr_number = 0;
        // if($last_mr != null){
        //    $last_mr_number = $last_mr->id;
        // }
        // $next_number = "MR".sprintf("%04d", $last_mr_number+1);
        // return view('pages.MaterialRequest.create', compact('employees', 'stockItems', 'items', 'next_number'));
    }

    public function store(Request $request)
    {
        $isMrfExist = MaterialRequest::where('mrf_no', $request->mrf_no)->first();
            if ($isMrfExist) {
                $data['mrf_no'] = $this->generateNextNumber();
            }

        //dd($request->all());
        $request['created_by_id'] = Auth::id();
        if ($request->button == "add") {
            return $this->addLineItem($request);
        }
        $this->validate($request, [
            'requested_by'=>'required',
            'mrf_date'=>'required|date',
            'mrf_no'=>'required',
            'required_date'=>'required',
            'justification'=>'required',]);

            $items = session('mr.items') ?? [];

            if (count($items) == 0) {
                throw ValidationException::withMessages(['items'=>'please add products']);
            }

        $materialRequest = new MaterialRequest();
        $materialRequest->employee_id = $request->requested_by;
        $materialRequest->mrf_date = $request->mrf_date;
        $materialRequest->mrf_no = $request->mrf_no;
        $materialRequest->justification = $request->justification;
        $materialRequest->required_date = $request->required_date;
        $materialRequest->created_by_id = request()->user()->id;
        $materialRequest->total_value = $request->tot_value;

        $materialRequest->save();

        foreach ($items as $item) {
            $materialRequestItem = new MaterialRequestItem();
            $materialRequestItem->mr_id = $materialRequest->id;
            $materialRequestItem->stock_item_id = $item['stock_item_id'];
            $materialRequestItem->priority = $item['priority'];
            $materialRequestItem->mrf_qty = $item['mrf_qty'];
            $materialRequestItem->remaining_qty = $item['mrf_qty'];
            $materialRequestItem->unit_price = $item['unit_price'];
            $materialRequestItem->value = $item['item_value'];

            $materialRequestItem->save();

    }
    session(['mr.items'=>[]]); // clear the session
    flash('Material Request created successfully!')->success();
    return redirect()->route('material_request.index');

    dd($request->all());

}

    public function addLineItem (Request $request)
    {
        $this->validate($request, [
            'stock_no'=>'required',
            'stock_item_id'=>'required|numeric',
            'uom'=>'required',
            'priority'=>'required',
            'mrf_qty'=>'required',
        ],
        [
            'stock_item_id.required'=>"Description field required",
            'stock_item_id.numeric'=>"Description field must be a number",
        ]);

        $items =  session('mr.items') ?? [];

        if (isset($items[$request->stock_item_id])) {
            throw ValidationException::withMessages(['items'=>'Selected Item is already existing']);
        }

        $items =  session('mr.items') ?? [];
        $stock_item = StockItem::find($request->stock_item_id);

        $items [$request->stock_item_id] = [
            'stock_no' => $request->stock_no,
            'uom' => $request->uom,
            'stock_item_id' => $stock_item->id,
            'description' => $stock_item->description,
            'priority' => $request->priority,
            'mrf_qty' => $request->mrf_qty,
            'unit_price'=> $request->unprice,
            'item_value'=>$request->item_value,
        ];

        logger($request->all());

        session(['mr.items'=>$items]);
        return redirect()->back()->withInput();
        
        //dd("add line item success ");



    }
    /**
     * Delete session item
     *
     * @param [type] $index
     * @return void
     */

 public function deleteSessionItem($index)
 {
      $items =  session('mr.items') ?? [];
     unset($items[$index]);
     session(['mr.items'=>$items]);
     return  redirect()->back()->withInput();
 }

    }

