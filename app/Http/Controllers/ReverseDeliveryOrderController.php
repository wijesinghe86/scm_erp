<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\UrgentDelivery;
use App\Services\StockLogService;
use App\Models\UrgentDeliveryItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReverseDeliveryOrderController extends Controller
{


    public function generateNextNumber()
    {
        $count  = UrgentDelivery::get()->count();
        return "UDO" . sprintf('%04d', $count + 1);
    }

    public function create()
   {
    $customers = Customer::get();
    $stockItems = StockItem::get();
    $warehouses = Warehouse::get();
    $employees = Employee::get();
    
    $items = session('do.items') ?? [];
    $next_number = $this->generateNextNumber();
    return view('pages.ReverseDelivery.create', compact('customers', 'stockItems', 'warehouses', 'items', 'employees', 'next_number'));
   }

   public function addLineItem (Request $request)
   {
           $items =  session('do.items') ?? [];

       if (isset($items[$request->stock_item])) {
           throw ValidationException::withMessages(['items'=>'Selected Item is already existing']);
       }

       $items =  session('do.items') ?? [];
       $stock_item = StockItem::find($request->stock_item);

       $items [$request->stock_item] = [
           'stock_no' => $request->stock_no,
           'uom' => $request->uom,
           'stock_item_id' => $stock_item->id,
           'description' => $stock_item->description,
           'issued_qty' => $request->issued_qty,
       ];

       //logger($request->all());

       session(['do.items'=>$items]);
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
    $items =  session('do.items') ?? [];
    unset($items[$index]);
    session(['do.items'=>$items]);
    return  redirect()->back()->withInput();
}

public function store(Request $request)
    {
        $stockLog = new StockLogService;

        $isMrfExist = UrgentDelivery::where('delivery_order_no', $request->issue_no)->first();
            if ($isMrfExist) {
                $data['delivery_order_no'] = $this->generateNextNumber();
            }

       
        
        $request['created_by_id'] = Auth::id();
        if ($request->button == "add") {
            return $this->addLineItem($request);
        }
        $this->validate($request, [
            'issue_no'=>'required',
            'issued_date'=>'required|date',
            // 'customer_id'=>'required',
            // 'warehouse_id'=>'required',
            ]);
       

            $items = session('do.items') ?? [];

            // if (count($items) == 0) {
            //     throw ValidationException::withMessages(['items'=>'please add products']);
            // }

        $urgent_delivery = new UrgentDelivery();
        $urgent_delivery->customer_id = $request->customer_id;
        $urgent_delivery->delivery_order_no	= $request->issue_no;
        $urgent_delivery->issued_date = $request->issued_date;
        $urgent_delivery->location_id = $request->warehouse_id;
        $urgent_delivery->vehicle_no = $request->vehicle_no;
        $urgent_delivery->driver_name = $request->driver_name;
        $urgent_delivery->nic_no = $request->nic_no;
        $urgent_delivery->created_by = request()->user()->id;
        // $urgent_delivery->created_at = $request->justification;
        // $urgent_delivery->updated_at = $request->justification;
       // dd($request->all());
        $urgent_delivery->save();

        foreach ($items as $item) {
            $urgent_delivery_item = new UrgentDeliveryItem();
            $urgent_delivery_item->delivery_order_id = $urgent_delivery->id;
            $urgent_delivery_item->invoice_id = $urgent_delivery->id;
            $urgent_delivery_item->item_id = $item['stock_no'];
            $urgent_delivery_item->issued_qty = $item['issued_qty'];


            $urgent_delivery_item->save();

            $stockLog->createLog(
                StockLogService::$URGENT_DELIVERY,
                $urgent_delivery->location_id,
                data_get($item, 'stock_no'),
                data_get($item, 'issued_qty'),
                StockLogService::$DEDUCT,
                $urgent_delivery->delivery_order_no,
                $request->user()->id,
                null,
            );

    }
    session(['do.items'=>[]]); // clear the session
    flash('Items Issued!')->success();
    return redirect()->route('reverse_delivery.create');

    dd($request->all());

}

        }

