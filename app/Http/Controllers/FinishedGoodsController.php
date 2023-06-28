<?php

namespace App\Http\Controllers;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;


class FinishedGoodsController extends Controller
{
    public function index()
    {

         return view('pages.FinishedGoods.index');
     }

     public function create()
    {
        $stocks = StockItem::get();
        $warehouses = Warehouse::get();
        return view('pages.FinishedGoods.create',compact('warehouses', 'stocks'));
    }

    public function store(Request $request)
    {

        $response['alert-success'] = 'Finished Goods Details created successfully!';
        return redirect()->route('finishedgoods.index')->with($response);
    }
}
