<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DistributorDeliveryOrder;
use App\Models\DistributorReturn;
use App\Models\DistributorReturnItem;
use App\Models\DitributorDeliverOrderItem;
use App\Models\DitributorInvice;
use App\Models\Stock;
use App\Models\Warehouse;
use App\Services\StockLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DistributorReturnController extends Controller
{
    public function index()
    {
        $invoice_returns =  DistributorReturn::all();
        return view('pages.DistributorReturn.index', compact('invoice_returns'));
    }

    public function create(Request $request)
    {
        $customers = Customer::get();
        $warehouses = Warehouse::get();
        $customer_data = null;
        $invoices = [];

        $delivery_orders = [];
        $delivery_order = null;

        $invoice_return = new DistributorReturn;
        $invoice_date = $request->invoice_date ? $request->invoice_date : null;
        $invoice_number  = $request->invoice_number ? $request->invoice_number : null;
        $delivery_order_no = $request->delivery_order_no ? $request->delivery_order_no : null;
        $customer_code = null;
        if ($request->customer_id) {
            $customer_data = Customer::find($request->customer_id);
            $customer_code = $customer_data->customer_code;

            $invoices = DitributorInvice::where('customer_id', $request->customer_id)
                ->when($invoice_date, function ($query) use ($invoice_date) {
                    return $query->whereDate('invoice_date', $invoice_date);
                })
                ->get();
        }
        if ($request->invoice_number) {
            $delivery_orders = DistributorDeliveryOrder::where('invoice_number', $request->invoice_number)
                ->whereNotNull('issued_date')
                ->get();
        }

        if ($request->delivery_order_no) {
            $delivery_order = DistributorDeliveryOrder::where('id', $request->delivery_order_no)->first();
            if ($delivery_order == null) {
                return abort(404);
            }
        }
        return view('pages.DistributorReturn.create', compact('customers', 'customer_data', 'invoices', 'warehouses', 'invoice_return', 'invoices', 'invoice_date', 'delivery_orders', 'invoice_number', 'customer_code', 'invoice_number', 'delivery_order_no', 'delivery_order'));
    }
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $delivery_order = DistributorDeliveryOrder::find($request->delivery_order);
            $returnIds = [];
            foreach (collect($request->cart)->groupBy('location_id') as $location_id => $items) {
                $invoice_return = new DistributorReturn;
                $invoice_return->invoice_id = $delivery_order->invoice->id;
                $invoice_return->return_no = $invoice_return->generateReturnOrderNumber();
                $invoice_return->location_id = $location_id;
                $invoice_return->delivery_order_id = $delivery_order->id;
                $invoice_return->created_by = request()->user()->id;
                $invoice_return->payment_method = $request->payment_method;

                $invoice_return->save();

                array_push($returnIds, $invoice_return->id);

                foreach ($items as $key => $item) {
                    $delivery_order_item = DitributorDeliverOrderItem::find($item['id']);
                    $delivery_order_item->returned_qty = $delivery_order_item->returned_qty + data_get($item, 'qty');
                    $delivery_order_item->save();
                    $invoice_return_item = new DistributorReturnItem;
                    $invoice_return_item->invoice_id =  data_get($item, 'invoice_id');
                    $invoice_return_item->return_id = $invoice_return->id;
                    $invoice_return_item->item_id = data_get($item, 'item_id');
                    $invoice_return_item->delivery_order_item_id = data_get($item, 'id');
                    $invoice_return_item->location_id = data_get($item, 'location_id');
                    $invoice_return_item->stock_no = data_get($item, 'stock_no');
                    $invoice_return_item->return_reason = data_get($item, 'return_reason');
                    $invoice_return_item->description = data_get($item, 'description');
                    $invoice_return_item->uom = data_get($item, 'uom');
                    $invoice_return_item->quantity = data_get($item, 'qty');
                    $invoice_return_item->unit_price = data_get($item, 'unit_price');
                    $invoice_return_item->total = data_get($item, 'total');
                    $invoice_return_item->sub_total = data_get($item, 'sub_total');
                    $invoice_return_item->save();


                }
            }
            $delivery_order->returned_ids = json_encode($returnIds);
            $delivery_order->save();

            DB::commit();
            $response['alert-success'] = 'Return Created Successfully!';
            return route('distributor_returns.index');
        } catch (Exception $error) {
            logger($error);
            $response['alert-danger'] = $error->getMessage();
            DB::rollBack();
        }
    }

    public function view(DistributorReturn $invoice_return)
    {
        return view('pages.DistributorReturn.view', compact('invoice_return'));
    }

    public function approvalIndex()
    {
        $invoice_returns =  DistributorReturn::where('is_approved', true)->get();
        return view('pages.DistributorReturn.approval', compact('invoice_returns'));
    }

    public function approval(Request $request, DistributorReturn $invoice_return)
    {
        $stockLog = new StockLogService;

        $invoice_return->is_approved = true;
        $invoice_return->approved_by = request()->user()->id;
        $invoice_return->save();

        foreach($invoice_return->items as $item)
        {
            //logger($item);
            $stock = Stock::where('stock_item_id', data_get($item, 'item_id'))
                        ->where('warehouse_id', data_get($item, 'location_id'))
                        ->first();
                    $stock->qty = $stock->qty + data_get($item, 'quantity');
                    $stock->save();

                    $stockLog->createLog(
                            StockLogService::$MATERIAL_RETURN,
                            data_get($item, 'location_id'),
                            data_get($item, 'item_id'),
                            data_get($item, 'quantity'),
                            StockLogService::$ADD,
                            $invoice_return->return_no,
                            $request->user()->id,
                            null,
                        );


        }

        // TODO: Restore Stock

        $response['alert-success'] = 'Return Approved Successfully!';

        return redirect()->back()->with($response);
    }

    public function print($return_id)
    {
        $mrs_list =DistributorReturn::find($return_id);

        // $stock_adjustmet_items = StockAdjustmentItem::with(['fromWarehouse', 'from_stock_item'])->find($stock_adjustment_id);

        $pdf = PDF::loadView('pages.DistributorReturn.print', compact('mrs_list'))->setPaper('A5','landscape');
        return $pdf->stream();
    }

}
