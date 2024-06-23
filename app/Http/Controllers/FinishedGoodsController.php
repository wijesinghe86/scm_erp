<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\StockItem;
use App\Models\Warehouse;
use App\Models\FinishGood;
use App\Models\FinishGoodItem;
use App\Models\FinishGoodWastage;
use Illuminate\Http\Request;
use App\Models\RawMaterialIssue;
use Illuminate\Support\Facades\DB;
use App\Models\RawMaterialIssueItem;
use Illuminate\Validation\ValidationException;

class FinishedGoodsController extends Controller
{
    public function generateNextNumber()
    {
        $count  = FinishGood::get()->count();
        return "FGRN" . sprintf('%06d', $count + 1);
    }
    public function index()
    {
        $fgrns = FinishGood::get();
        return view('pages.FinishedGoods.index', compact('fgrns'));
    }

    public function create()
    {
        session(['finish_good.items' => []]);
        session(['finish_good_wastage.items' => []]);
        $stock_items = StockItem::get();
        $warehouses = Warehouse::get();
        $next_number = $this->generateNextNumber();
        $rmi_data  = RawMaterialIssue::with(['warehouse', 'createdBy', 'items.received', 'finished_good'])
            ->whereDoesntHave('finished_good')
            ->get();

        return view('pages.FinishedGoods.create', compact('warehouses', 'stock_items', 'next_number', 'rmi_data'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'date' => 'required',
            'fgrn_no' => 'required',
            'warehouse_id' => 'required',
            'pro_start_date_time' => 'required',
            'pro_end_date_time' => 'required',
            'rmi_no' => 'required',
        ]);



        $finish_goods = session('finish_good.items') ?? [];
        $finish_good_wastages =  session('finish_good_wastage.items') ?? [];



        if (count($finish_goods) == 0) {
            throw ValidationException::withMessages(['items' => 'please add at least finished good item']);
        }

        $data = $request->all();
        $isExist = FinishGood::where('fgrn_no', $request->fgrn_no)->first();
        if ($isExist) {
            $data['fgrn_no'] = $this->generateNextNumber();
        }

        try {
            DB::beginTransaction();

            $finished_good = new FinishGood;
            $finished_good->date = $request->date;
            $finished_good->fgrn_no = $data['fgrn_no'];
            $finished_good->warehouse_id = $request->warehouse_id;
            $finished_good->pro_start_date_time = $request->pro_start_date_time;
            $finished_good->pro_end_date_time = $request->pro_end_date_time;
            $finished_good->rmi_no = $request->rmi_no;
            $finished_good->tot_issue_weight = $request->tot_issued_weight;
            $finished_good->tot_pro_qty = $request->tot_pro_qty;
            $finished_good->tot_pro_weight = $request->tot_pro_weight;
            $finished_good->tot_wastage = $request->tot_waste;
            $finished_good->remaining_qty = $request->remaining;
            $finished_good->created_by = request()->user()->id;
            $finished_good->save();

            foreach ($finish_goods as $key => $finish_good) {
                $finished_good_item = new FinishGoodItem;
                $finished_good_item->fgrn_no = $data['fgrn_no'];
                $finished_good_item->warehouse_id = $request->warehouse_id;
                $finished_good_item->rmi_no = $request->rmi_no;
                $finished_good_item->rmi_item_stock_description = $finish_good['rmi_item_stock_description'];
                $finished_good_item->rmi_item_stock_number = $finish_good['rmi_item_stock_number'];
                $finished_good_item->rmi_qty = $finish_good['rmi_qty'];
                $finished_good_item->stock_item_id =  $finish_good['stock_item_id'];
                $finished_good_item->semi_product_serial_no = $finish_good['semi_product_serial_no'];
                $finished_good_item->pro_qty = $finish_good['pro_qty'];
                $finished_good_item->pro_weight = $finish_good['pro_weight'];
                $finished_good_item->batch_no = $finish_good['batch_no'];
                $finished_good_item->pro_description = $finish_good['pro_description'];
                $finished_good_item->pro_stock_no = $finish_good['pro_stock_no'];
                $finished_good_item->save();
            }

            foreach ($finish_good_wastages as $key => $finish_good_wastage) {
                $wastage = new FinishGoodWastage;
                $wastage->fgrn_no =  $data['fgrn_no'];
                $wastage->rmi_no = $request->rmi_no;
                $wastage->warehouse_id = $request->warehouse_id;
                $wastage->stock_item_id = $finish_good_wastage['wastage_stock_item_id'];
                $wastage->qty = $finish_good_wastage['wastage_qty'];
                $wastage->weight = $finish_good_wastage['wastage_qty'];
                $wastage->wastage_description = $finish_good_wastage['wastage_description'];
                $wastage->wastage_stock_number = $finish_good_wastage['wastage_stock_number'];
                $wastage->save();
            }

            DB::commit();
            flash()->success("Finished Goods Details created successfully!");
            return redirect()->route('finishedgoods.index');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e);
        }
    }



    public function getRmiItems(Request $request)
    {
        session(['finish_good.items' => []]);
        session(['finish_good_wastage.items' => []]);
        $items = RawMaterialIssueItem::with(['received', 'semi_product_item.semi_product_stock_item'])
            ->where('rmi_no', $request->rmi_no)
            ->whereHas('received')
            ->get();
        return $items;
    }

    // public function addToFinishGoodTable(Request $request)
    // {
    //     $this->validate($request, [
    //         'rmi_item_id' => 'required',
    //         'pro_item_id' => 'required',
    //         'pro_qty' => 'required',
    //         'pro_weight' => 'required',
    //         'batch_no' => 'required',
    //     ], [
    //         "rmi_item_id.required" => 'The rmi item field is required',
    //         "pro_item_id.required" => 'The finish good field is required',
    //         "pro_qty.required" => 'The finish food qty field is required',
    //         "pro_weight.required" => 'The finish food weight field is required',
    //         "batch_no.required" => 'The batch number field is required',
    //     ]);

    //     $items = session('finish_good.items') ?? [];
    //     $rmi_item = RawMaterialIssueItem::with(['semi_product_item.semi_product_stock_item'])->find($request->rmi_item_id);
    //     $pro_stock_item = StockItem::find($request->pro_item_id);
    //     $items[] = [
    //         'pro_description' => $pro_stock_item->description,
    //         'pro_stock_no' => $pro_stock_item->stock_number,
    //         'stock_item_id' => $pro_stock_item->id,
    //         'semi_product_serial_no' => $rmi_item->semi_product_serial_no,
    //         'pro_qty' => $request->pro_qty,
    //         'pro_weight' => $request->pro_weight,
    //         'batch_no' => $request->batch_no,
    //         'rmi_item_stock_id' => optional(optional(optional($rmi_item)->semi_product_item)->semi_product_stock_item)->id,
    //         'rmi_item_stock_number' => optional(optional(optional($rmi_item)->semi_product_item)->semi_product_stock_item)->stock_number,
    //         'rmi_item_stock_description' => optional(optional(optional($rmi_item)->semi_product_item)->semi_product_stock_item)->description,
    //         'rmi_qty' => $request->rmi_qty,
    //         'rmi_weight' => $request->rmi_weight,
    //     ];

    //     session(['finish_good.items' => $items]);
    //     request()->tot_issued_weight = "10000";
    //     return [
    //         'success' => true,
    //         'message' => 'Item Added',
    //     ];
    // }

public function addToFinishGoodTableBulk(Request $request)
    {
        $this->validate($request, [
            'rmi_item_ids' => 'required|array',
            'pro_item_id' => 'required',
            'pro_qty' => 'required',
            'pro_weight' => 'required',
            'batch_no' => 'required',
        ], [
            "rmi_item_ids.required" => 'The rmi item field is required',
            "pro_item_id.required" => 'The finish good field is required',
            "pro_qty.required" => 'The finish food qty field is required',
            "pro_weight.required" => 'The finish food weight field is required',
            "batch_no.required" => 'The batch number field is required',
        ]);


        $items = session('finish_good.items') ?? [];

        $pro_stock_item = StockItem::find($request->pro_item_id);

        foreach ($request->rmi_item_ids as $key => $rmi_item_id) {
            $rmi_item = RawMaterialIssueItem::with(['semi_product_item.semi_product_stock_item'])->find($rmi_item_id);
            $newItem = [
                'pro_description' => $pro_stock_item->description,
                'pro_stock_no' => $pro_stock_item->stock_number,
                'stock_item_id' => $pro_stock_item->id,
                'semi_product_serial_no' => $rmi_item->semi_product_serial_no,
                'pro_qty' => $request->pro_qty,
                'pro_weight' => $request->pro_weight,
                'batch_no' => $request->batch_no,
                'rmi_item_stock_id' => optional(optional(optional($rmi_item)->semi_product_item)->semi_product_stock_item)->id,
                'rmi_item_stock_number' => optional(optional(optional($rmi_item)->semi_product_item)->semi_product_stock_item)->stock_number,
                'rmi_item_stock_description' => optional(optional(optional($rmi_item)->semi_product_item)->semi_product_stock_item)->description,
                'rmi_qty' => $request->rmi_qty,
                'rmi_weight' => $request->rmi_weight,
            ];
            // logger($newItem);
            $items[] = $newItem;
        }


        session(['finish_good.items' => $items]);
        request()->tot_issued_weight = "10000";
        return [
            'success' => true,
            'message' => 'Item Added',
        ];
    }


    public function removeFromFinishGoodTable(Request $request)
    {
        $items =  session('finish_good.items') ?? [];
        $index = collect($items)->search(function ($item) use ($request) {
            return $item['rmi_item_stock_number'] == $request->rmi_item_stock_number && $item['semi_product_serial_no'] == $request->semi_product_serial_no && $item['pro_stock_no'] == $request->pro_stock_no;
        });
        unset($items[$index]);
        session(['finish_good.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Removed'
        ];
    }

    public function getFinishGoodTable()
    {
        $finish_good_items =  session('finish_good.items') ?? [];
        logger($finish_good_items);
        return view('pages.FinishedGoods.item_list', compact('finish_good_items'));
    }

    public function addToWastageTable(Request $request)
    {
        $this->validate($request, [
            'wastage_stock_item_id' => 'required',
            'wastage_qty' => 'required',
        ], [
            "wastage_stock_item_id.required" => 'The wastage item field is required',
            "wastage_qty.required" => 'The wastage qty field is required',
        ]);

        $items = session('finish_good_wastage.items') ?? [];
        $wastage_stock_item = StockItem::find($request->wastage_stock_item_id);

        $items[] = [
            'wastage_description' => $wastage_stock_item->description,
            'wastage_stock_number' => $wastage_stock_item->stock_number,
            'wastage_uom' => $wastage_stock_item->unit,
            'wastage_stock_item_id' => $request->wastage_stock_item_id,
            'wastage_qty' => $request->wastage_qty,
        ];

        session(['finish_good_wastage.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Added',
        ];
    }

    public function removeFromWastageTable(Request $request)
    {
        $items =  session('finish_good_wastage.items') ?? [];
        unset($items[$request->index]);
        session(['finish_good_wastage.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Removed'
        ];
    }

    public function getWastageTable()
    {
        $wastage_items =  session('finish_good_wastage.items') ?? [];
        return view('pages.FinishedGoods.wastage_list', compact('wastage_items'));
    }


    public function getTotalCalculations()
    {
        $finish_good_items = session('finish_good.items') ?? [];
        $wastage_items = session('finish_good_wastage.items') ?? [];

        $tot_issued_weight =  collect($finish_good_items)->unique('semi_product_serial_no')->sum('rmi_qty');
        $tot_pro_qty =  collect($finish_good_items)->unique('pro_stock_no')->sum('pro_qty');
        $tot_pro_weight =  collect($finish_good_items)->unique('pro_stock_no')->sum('pro_weight');

        $tot_waste = collect($wastage_items)->sum('wastage_qty');
        $remaining = $tot_issued_weight - ($tot_pro_weight + $tot_waste);


        return [
            'tot_issued_weight' => $tot_issued_weight,
            'tot_pro_qty' => $tot_pro_qty,
            'tot_pro_weight' => $tot_pro_weight,
            'tot_waste' => $tot_waste,
            'remaining' => $remaining,
        ];
    }
}

    
