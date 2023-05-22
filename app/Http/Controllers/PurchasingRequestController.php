<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PurchasingRequest;
use App\Models\PurchasingRequestItem;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PurchasingRequestController extends Controller
{
    public function index()
    {
        $lists =  PurchasingRequest::get();
        return view('pages.PurchaseRequest.index',compact('lists'));
    }
    public function create()
    {
        // session(['pr.items'=>[]]); // for clear session

        $employees = Employee::with(['departmentData','sectionData'])->get();

        $stockItems = StockItem::get();

        $items = session('pr.items') ?? [];

        $last_pr =  PurchasingRequest::latest()->first();
        $last_pr_number = 0;
        if($last_pr != null){
           $last_pr_number = $last_pr->id;
        }

        $next_number = "PR".sprintf("%04d", $last_pr_number+1);

        return view('pages.PurchaseRequest.create', compact('employees', 'stockItems', 'items','next_number'));
    }

    public function store(Request $request)
    {
        if ($request->button == "add") {
            return $this->addLineItem($request);
        }

        $this->validate($request, [
            'requested_by'=>'required',
            'prf_date'=>'required|date',
            'prf_no'=>'required',
        ]);

        $items = session('pr.items') ?? [];

        if (count($items) == 0) {
            throw ValidationException::withMessages(['items'=>'please add products']);
        }

        $purchaseRequest = new PurchasingRequest();
        $purchaseRequest->employee_id = $request->requested_by;
        $purchaseRequest->prf_date = $request->prf_date;
        $purchaseRequest->prf_no = $request->prf_no;
        $purchaseRequest->save();


        foreach ($items as $item) {
            $purchaseRequestItem = new PurchasingRequestItem();
            $purchaseRequestItem->pr_id = $purchaseRequest->id;
            $purchaseRequestItem->stock_item_id = $item['stock_item_id'];
            $purchaseRequestItem->priority = $item['priority'];
            $purchaseRequestItem->prf_qty = $item['prf_qty'];
            $purchaseRequestItem->save();
        }


        session(['pr.items'=>[]]);
        flash('Purchase Request created successfully!')->success();
        return  redirect()->route('purchase_request.index');

        dd($request->all());
    }

    /**
     * Add to session
     *
     * @param Request $request
     * @return void
     */
    public function addLineItem(Request $request)
    {
        $this->validate($request, [
            'stock_no'=>'required',
            'stock_item_id'=>'required|numeric',
            'uom'=>'required',
            'priority'=>'required',
            'prf_qty'=>'required',
        ], [
            'stock_item_id.required'=>"Description field required",
            'stock_item_id.numeric'=>"Description field must be a number",
        ]);


        $items =  session('pr.items') ?? [];

        if (isset($items[$request->stock_item_id])) {
            throw ValidationException::withMessages(['items'=>'There is already records exist from this product id']);
        }

        $stock_item = StockItem::find($request->stock_item_id);

        $items [$request->stock_item_id] = [
            'stock_no' => $request->stock_no,
            'uom' => $request->uom,
            'stock_item_id' => $stock_item->id,
            'description' => $stock_item->description,
            'priority' => $request->priority,
            'prf_qty' => $request->prf_qty,
        ];

        session(['pr.items'=>$items]);

        return  redirect()->back()->withInput();
    }
     /**
     * Delete session item
     *
     * @param [type] $index
     * @return void
     */
    public function deleteSessionItem($index)
    {
        $items =  session('pr.items') ?? [];
        unset($items[$index]);
        session(['pr.items'=>$items]);
        return  redirect()->back()->withInput();
    }
}
