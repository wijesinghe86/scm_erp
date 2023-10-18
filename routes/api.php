<?php

use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('test')->group(function () {
    Route::get('stock-check', function () {
        $stocks = Stock::truncate();
        $stock_items = StockItem::get();
        $warehouses = Warehouse::get();
        

        foreach ($stock_items as $key => $stock_item) {
            foreach ($warehouses as $key => $warehouse) {
                $stock = new Stock;
                $stock->stock_item_id = $stock_item->id;
                $stock->warehouse_id = $warehouse->id;
                $stock->qty = 0;
                $stock->save();
            }
        }
    });
});
