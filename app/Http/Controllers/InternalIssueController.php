<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\InternalIssue;
use App\Models\InternalIssueItem;
use App\Models\PlantRegistration;
use App\Services\StockLogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class InternalIssueController extends Controller
{
    public function index()
    {
        $lists = InternalIssue::with ('iid_items.item')->get();
        return view ('pages.InternalIssue.index', compact('lists'));

    }

    public function generateNextNumber()
    {
        $count  = InternalIssue::get()->count();
        return "IID" . sprintf('%06d', $count + 1);
    }


    public function create()
    {   $warehouses = Warehouse::get();
        $plants = PlantRegistration::get();
        $stockItems = StockItem::get();
        $next_number = $this->generateNextNumber();
        $items = session('iid.items') ?? [];
        return view ('pages.InternalIssue.create', compact('warehouses', 'plants', 'stockItems', 'items', 'next_number'));
    }

    public function addLineItem (Request $request)
    {
        $this->validate($request, [
            'stock_no'=>'required',
            'stock_item_id'=>'required|numeric',
            'uom'=>'required',
            'issue_qty'=>'required',
            'issue_weight'=>'required',
        ],
        [
            'stock_item_id.required'=>"Description field required",
            'stock_item_id.numeric'=>"Description field must be a number",
        ]);

        $items =  session('iid.items') ?? [];

        if (isset($items[$request->stock_item_id])) {
            throw ValidationException::withMessages(['items'=>'Selected Item is already existing']);
        }

        $items =  session('iid.items') ?? [];
        $stock_item = StockItem::find($request->stock_item_id);
        $warehouse_name = Warehouse::find($request->issue_warehouse_id);

        $items [$request->stock_item_id] = [
            'stock_no' => $request->stock_no,
            'uom' => $request->uom,
            'stock_item_id' => $stock_item->id,
            'description' => $stock_item->description,
            'issue_qty' => $request->issue_qty,
            'issue_weight'=> $request->issue_weight,
            'issue_warehouse_id'=>$warehouse_name->warehouse_name,
        ];

        //logger($request->all());

        session(['iid.items'=>$items]);
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
      $items =  session('iid.items') ?? [];
     unset($items[$index]);
     session(['iid.items'=>$items]);
     return  redirect()->back()->withInput();
 }

 public function store(Request $request)
    {
        $isIisfExist = InternalIssue::where('iid_no', $request->iid_no)->first();
            if ($isIisfExist) {
                $data['iid_no'] = $this->generateNextNumber();
            }

        //dd($request->all());
        $request['created_by'] = Auth::id();
        if ($request->button == "add") {
            return $this->addLineItem($request);
        }
        // $this->validate($request, [
        //     'iid_no'=>'required',
        //     'issue_date'=>'required|date',
        //     'issue_warehouse_id'=>'required',
        //     'plant_id'=>'required',
        //     'justification'=>'required',]);

            $items = session('iid.items') ?? [];

            if (count($items) == 0) {
                throw ValidationException::withMessages(['items'=>'please add products']);
            }

        $internalIssue = new InternalIssue();
        $internalIssue->iid_date = $request->issue_date;
        $internalIssue->iid_no = $request->iid_no;
        $internalIssue->warehouse_id = $request->issue_warehouse_id;
        $internalIssue->plant_id = $request->plant_id;
        $internalIssue->justification = $request->justification;
        $internalIssue->total_issued_qty = $request->tot_qty;
        $internalIssue->total_issued_weight = $request->tot_weight;
        $internalIssue->reference_no = $request->reference_no;
        $internalIssue->created_by = request()->user()->id;
        $internalIssue->edited_by = request()->user()->id;


        $internalIssue->save();

        foreach ($items as $item) {
            $internalIssuesItem = new InternalIssueItem();
            $internalIssuesItem->iid_id = $internalIssue->id;
            $internalIssuesItem->stock_no = $item['stock_item_id'];
            $internalIssuesItem->issue_qty = $item['issue_qty'];
            $internalIssuesItem->issue_weight = $item['issue_weight'];

            $internalIssuesItem->save();

    }
    session(['iid.items'=>[]]); // clear the session
    flash('Raw Materials Issued successfully!')->success();
    return redirect()->route('internal_issue.index');

    //dd($request->all());

}

public function view(InternalIssue $internalIssue)
    {
        //$internalIssue = InternalIssue::with('warehouse','plant')->get();
        return view('pages.InternalIssue.view', compact('internalIssue'));
    }

    public function approvalIndex()
    {
        $internal_issues =  InternalIssue::where('is_approved', true)->get();
        return view('pages.InternalIssue.approval', compact('internal_issues'));
    }

    public function approval(Request $request, InternalIssue $internal_issue)
    {
        $stockLog = new StockLogService;

        $internal_issue->is_approved = true;
        $internal_issue->approved_by = request()->user()->id;
        $internal_issue->status ='Approved';
        $internal_issue->save();

        foreach($internal_issue->iid_items as $item)
        {

                    $stockLog->createLog(
                            StockLogService::$INTERNAL_ISSUE,
                            $internal_issue->warehouse_id,
                            $item->stock_no,
                            $item->issue_qty,
                            // data_get($item, 'issue_qty'),
                            StockLogService::$DEDUCT,
                            $internal_issue->iid_no,
                            $request->user()->id,
                            null,
                        );

        }
        if ($request->status == "approved") {
        foreach ($internal_issue->iid_items as $key => $item) {
        $stocks = Stock::where('stock_item_id', '$item->stock_no')->where('warehouse_id', '$request->issue_warehouse_id')
        ->first();
    $stocks->qty = $stocks->qty - $item->issue_qty;
    logger($stocks);
    $stocks->save();
         }
    }
        // TODO: Restore Stock

        $response['alert-success'] = 'IID Approved Successfully!';

        return redirect()->back()->with($response);
    }

    // public function print()
    // {
    //     $internal_issues =  InternalIssue::with('iid_items')->where('is_approved', true)->get();

    //     $pdf = PDF::loadView('pages.InternalIssue.print', compact('internal_issues'))->setPaper('A5','landscape');
    //                 return $pdf->stream();
    // }

    }

