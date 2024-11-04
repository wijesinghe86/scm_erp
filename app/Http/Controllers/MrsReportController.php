<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use PDF;
use Illuminate\Http\Request;
use App\Models\InvoiceReturn;

class MrsReportController extends ParentController
{
    public function index()
    {
        $customer_lists = Customer::get();
        $returns = InvoiceReturn::get();
        return view('pages.Reports.MrsReports.index', compact(['customer_lists', 'returns']));
    }
    public function filter(Request $request)
    {
        //logger($request->all());
        $request->validate([
            "frm_date" => 'required|date',
            "to_date" => 'required|date',
            //"cus_code"=>'required',

        ]);
        $fromdate = $request->frm_date;
        $todate = $request->to_date;
        $mrsdata = InvoiceReturn::with(['invoice'])->whereDate('created_at', '>=', $fromdate)
            ->whereDate('created_at', '<=', $todate)
            ->whereHas('invoice', function ($query) use ($request) {
                return $query->when($request->cus_code, function ($q) use ($request) {
                    return $q->where('customer_id', $request->cus_code);
                });
            })
            ->get();
            logger($mrsdata);
        if ($mrsdata == null) {
            return abort(404);
        }
// $stockLog = new StockLogService;
// $stockLog->createLog(StockLogService::$STOCK_ADJUSTMENT_TYPE)

        logger(count($mrsdata));


        $pdf = PDF::loadView('pages.Reports.MrsReports.viewdatewise', compact('mrsdata'))->setPaper('A4','landscape');
        return $pdf->stream();
    }

    
    public function date_filter(Request $request)
    {
        $date1 = $request->frm_date;
        $date2 = $request->to_date;
        $mrs_date = InvoiceReturn::with(['invoice'])->whereDate('created_at', '>=', $date1)
            ->whereDate('created_at', '<=', $date2)->get();
            if ($mrs_date == null) {
                return abort(404);
            }
            logger(count($mrs_date));


            $pdf = PDF::loadView('pages.Reports.MrsReports.datewise', compact('mrs_date'))->setPaper('A4','landscape');
            return $pdf->stream();
        }

}
