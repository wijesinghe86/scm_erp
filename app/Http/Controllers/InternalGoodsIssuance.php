<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialRequestItem;


class InternalGoodsIssuance extends Controller
{
    public function getMrfItems(Request $request)
    {
        $lists = MaterialRequestItem::with('item')
                ->where('mr_id', $request->mr_id)
                ->get();
        return view('pages.InternalGoodsIssuance.mrf_table.');
    }
}
