<?php

namespace App\Http\Controllers;
use PDF;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DistributorBalanceOrder;
use App\Models\DistributorBalanceOrderItem;
use App\Models\DistributorDeliveryOrder;
use App\Models\DitributorDeliverOrderItem;
use App\Models\DitributorInvice;
use App\Models\DitributorInviceItem;
use App\Models\Employee;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Warehouse;
use App\Services\StockLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistributorDeliveryOrderController extends Controller
{
    public function index(Request $request)
    {
       $deliveryOrders = DistributorDeliveryOrder::with(['customer', 'location'])
                         ->when($request->search, function($q) use ($request){
                           $q->where('delivery_order_no', 'like', '%' . $request->search . '%')
                           ->orwhere('invoice_number', 'like', '%' . $request->search . '%')
                           ->orWhere(function ($qr) use ($request){
                               return $qr->whereHas('location', function ($location) use ($request){
                               $location->where('warehouse_name', 'like', '%' . $request->search . '%');
                           });
                             })
                             ->orWhere(function ($query) use ($request){
                                   return $query->whereHas('customer', function ($customer) use ($request){
                                       $customer->where('customer_name', 'like', '%' . $request->search . '%');
                       });
                   });
                   
               })

                         ->latest()
                         ->paginate(50);
                         return view('pages.DistributorDeliverOrder.index', compact('deliveryOrders'));

       // $search = $request['search']?? "";
       // if(request('search' ) !="")
       // {
       //     $deliveryOrders = DeliveryOrder::with(['customer', 'location'])
       //                                     ->where('delivery_order_no', 'like', '%' . request('search') . '%')
       //                                     ->orwhere('invoice_number', 'like', '%' . request('search') . '%')
       //                                     ->latest()->paginate();

       // }
       // else
       // {
       //     $deliveryOrders = DeliveryOrder::paginate(50);
       // }
       // return view('pages.DeliveryOrder.all', compact('deliveryOrders', 'search'));


   }

   public function view(DistributorDeliveryOrder $delivery_order)
   {
       if ($delivery_order == null) {
           abort(404);
       }
       return view('pages.DistributorDeliverOrder.view', compact('delivery_order'));
   }


   public function issueIndex(DistributorDeliveryOrder $delivery_order)
   {
       $delivery_order->loadMissing('items.stock_item.stocks');
       $delivery_order->loadMissing('items.warehouse');
       if ($delivery_order == null || $delivery_order->issued_date != null) {
           abort(404);
       }
       if ($delivery_order->cancel_status =="cancelled") {
           $response['alert-success'] = 'Delivery Order already cancelled';
           return redirect()->route('distributor_deliveryorders.index')->with($response);

       }
       // return $delivery_order;
       return view('pages.DistributorDeliverOrder.issue', compact('delivery_order'));
   }

   public function issueStore(Request $request, DistributorDeliveryOrder $delivery_order)
   {
       $stockLog = new StockLogService;

       // if ($delivery_order == null || $delivery_order->issued_date != null) {
       //     abort(404);
       // }
       try {
           DB::beginTransaction();
           $balance_order =  new DistributorBalanceOrder;
           $balance_order->balance_order_no = $balance_order->generateBalanceOrderNumber();
           $balance_order->delivery_order_id = $delivery_order->id;
           $balance_order->invoice_number = $delivery_order->invoice_number;
           $balance_order->invoice_date = $delivery_order->invoice_date;
           $balance_order->location_id = $delivery_order->location_id;
           $balance_order->created_by = Auth::id();

           $delivery_order->issued_date = now();
           $delivery_order->vehicle_no = $request->vehicle_no;
           $delivery_order->driver_name = $request->driver_name;
           $delivery_order->nic_no = $request->nic_no;
           $delivery_order->save();

           foreach ($request->items as $key => $item) {
               $delivery_order_item = DitributorDeliverOrderItem::where('id', $key)->first();

               $delivery_order_item->issued_qty = $delivery_order_item->issued_qty + $item['issue_quantity'];
               // $delivery_order_item->available_qty = $item['issue_quantity'] > 0 ? $delivery_order_item->qty - $delivery_order_item->issued_qty : 0;
               $delivery_order_item->available_qty = $delivery_order_item->qty - $delivery_order_item->issued_qty;
               $delivery_order_item->issued_date = now();
               $delivery_order_item->issued_by = Auth::id();


               $delivery_order_item->save();

               $stockLog->createLog(
                   StockLogService::$DELIVERY_ORDER,
                   $delivery_order->location_id,
                   $delivery_order_item->item_id,
                   data_get($item, 'issue_quantity'),
                   StockLogService::$DEDUCT,
                   $delivery_order->delivery_order_no,
                   $request->user()->id,
                   null,
               );


               //stock reduce
               $stock = Stock::where('stock_item_id', $delivery_order_item->item_id)->where('warehouse_id', $delivery_order->location_id)->first();
               $stock->qty = $stock->qty - $item['issue_quantity'];
               $stock->save();


               $is_existing_balance_order_item = DistributorBalanceOrderItem::where('delivery_order_item_id', $delivery_order_item->id)->first();
               if ($is_existing_balance_order_item) {
                   $is_existing_balance_order_item->delete();
               }


               // if ($item['issue_quantity'] != 0 &&  $delivery_order_item->issued_qty < $delivery_order_item->qty) {
               if ($delivery_order_item->issued_qty < $delivery_order_item->qty) {
                   $is_existing_balance_order = DistributorBalanceOrder::where('delivery_order_id', $delivery_order->id)->first();
                   if ($is_existing_balance_order == null) {
                       $balance_order->save();
                   }

                   $balance_order_item = new DistributorBalanceOrderItem;
                   $balance_order_item->delivery_order_id  = $delivery_order->id;
                   $balance_order_item->balance_order_id  = $is_existing_balance_order == null ? $balance_order->id : $is_existing_balance_order->id;
                   $balance_order_item->delivery_order_item_id  = $delivery_order_item->id;
                   $balance_order_item->item_id  = $delivery_order_item->item_id;
                   $balance_order_item->invoice_id  =  $delivery_order_item->invoice_id;
                   $balance_order_item->stock_no  =  $delivery_order_item->stock_no;
                   $balance_order_item->description  =  $delivery_order_item->description;
                   $balance_order_item->unit_price  =  $delivery_order_item->unit_price;
                   $balance_order_item->uom  = $delivery_order_item->uom;;
                   $balance_order_item->qty  =  $delivery_order_item->qty - $delivery_order_item->issued_qty;
                   $balance_order_item->unit_price  =   $delivery_order_item->unit_price;
                   $balance_order_item->location  =   $delivery_order_item->location;
                   $balance_order_item->created_by  = Auth::id();
                   $balance_order_item->save();
               }
           }
           DB::commit();
           return redirect()->route('distributor_deliveryorders.view', $delivery_order->id);
       } catch (Exception $th) {
           logger($th);
           DB::rollback();
       }
   }

   public function create()
   {
       $customers = Customer::get();
       $employees = Employee::get();
       $stockItems = StockItem::get();
       $warehouses = Warehouse::get();
       $invoices = DitributorInvice::get();


       $last_do =  DistributorDeliveryOrder::latest()->first();
       $last_do_number = 0;
       if ($last_do != null) {
           $last_do_number = $last_do->id;
       }
       $delivery_order_no = "DO" . sprintf("%06d", $last_do_number + 1);

       return view('pages.DistributorDeliveryOrder.create', compact('customers', 'employees', 'stockItemem_mains', 
       'warehouses', 'delivery_order_no', 'invoices'));
   }

   public function store(Request $request)
   {
       // dd($request->all());
       $request['created_by'] = Auth::id();

       $delivery_order = DistributorDeliveryOrder::create($request->all());
       return redirect()->route('distributor_invoices.preview', $delivery_order->id);
   }

   public function getInvoiceItems(Request $request)
   {
       // dd($request->all());
       $invoiceitems = DitributorInviceItem::with('item')
           ->where('invoice_number', $request->invoice_no)
           ->get();
       return view('pages.DistributorDeliveryOrder.items_table', compact('invoiceitems'));
   }


   public function print($delivery_order_id)
   {
       $delivery_order = DistributorDeliveryOrder::with(['items', 'customer','location'])->find($delivery_order_id);
       $delivery_order->driver_name ='oK';
       $delivery_order->save();
       // $response[''] = InvoiceItem::where('invoice_number', $invoice_id)->get();
       if ($delivery_order == null) {
           return abort(404);
       }
       elseif($delivery_order->driver_name ='oK')
       {

       }

       $pdf = PDF::loadView('pages.DistributorDeliverOrder.pdf', compact('delivery_order'));
       return $pdf->stream('delivery_order.pdf');

   }

   public function cancel($delivery_order_id)
   {
       $delivery_order = DistributorDeliveryOrder::with(['items', 'invoice'])->find($delivery_order_id);
       if($delivery_order->issued_date == null)
       // if (($delivery_order->issued_date != null) && ($delivery_order->items->issued_qty == 0))
       {
       $delivery_order->cancel_status = 'cancelled';
       $response['alert-success'] = 'Delivery Order Cancelled successfully!';
       $delivery_order->cancelled_by = request()->user()->name;
       $delivery_order->cancel_date = now();
       }
       else
       $response['alert-danger'] = 'Invalid';

       $delivery_order->save();
       return redirect()->route('distributor_deliveryorders.index')->with($response);

   }
}
