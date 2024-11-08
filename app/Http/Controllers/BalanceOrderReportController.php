<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\BalanceOrder;
use Illuminate\Http\Request;

class BalanceOrderReportController extends Controller
{
    public function index()
    {
        return view('pages.Reports.BalanceOrderReports.index');
    }


    public function date_filter(Request $request)
    {
        $date1 = $request->frm_date;
        $date2 = $request->to_date;
        $bo_date = BalanceOrder::with(['invoice'])->whereDate('created_at', '>=', $date1)
            ->whereDate('created_at', '<=', $date2)->get();
            if ($bo_date == null) {
                return abort(404);
            }
            logger($bo_date);
            logger(count($bo_date));


            $pdf = PDF::loadView('pages.Reports.BalanceOrderReports.date_wise', compact('bo_date'))->setPaper('A4','landscape');
            return $pdf->stream();
        }

}
