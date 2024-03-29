<?php

namespace App\Http\Controllers;



use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Warehouse;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StockItemController extends Controller
{
    public function all()
    {
        $stockitems =  StockItem::get();
        return view('pages.stockitem.all', compact('stockitems'));

        $response['stockitems'] = StockItem::all();
        return view('pages.stockitem.all')->with($response);
    }
    public function create()

    {
        $departments = Department::get();
        return view('pages.stockitem.create', compact('departments'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'stock_number' => 'required|max:7',
            'description' => 'required',
            'unit' => 'required',
            'keyword' => 'required',
            'group'=>'required',
            'class'=>'required'



        ]);


        $request['created_by'] = Auth::id();
        $stock_item =  StockItem::create($request->all());

        //create Stock
        $warehouses = Warehouse::get();
        foreach ($warehouses as $key => $warehouse) {
            $stock = new Stock;
            $stock->stock_item_id = $stock_item->id;
            $stock->warehouse_id = $warehouse->id;
            $stock->qty = 0;
            $stock->save();
        }

        $response['alert-success'] = 'Stock Item Details created successfully!';
        return redirect()->route('stockitem.all')->with($response);
    }

    public function edit($stockitem_id)
    {
        $response['stockitems'] = StockItem::find($stockitem_id);
        return view('pages.stockitem.edit')->with($response);
    }

    public function update(Request $request, $stockitem_id)
    {
        $stockitems = StockItem::find($stockitem_id);
        $stockitems->update($request->all());

        $request['updated_by'] = Auth::id();
        StockItem::find($stockitem_id)->update($request->all());

        $response['alert-success'] = 'Stockitem updated successfully';
        return redirect()->route('stockitem.all')->with($response);
    }

    public function delete($stockitem_id)
    {
        $stockitems = StockItem::find($stockitem_id);
        $stockitems->deleted_by = Auth::id();
        $stockitems->save();
        $stockitems->delete(); //deleted in the Database

        $response['alert-success'] = 'Stockitem deleted successfully';
        return redirect()->route('stockitem.all')->with($response);
    }

    public function deleted()
    {
        $response['stockitems'] = StockItem::onlyTrashed()->get();
        return view('pages.stockitem.deleted')->with($response);
    }

    public function restore($stockitem_id)
    {
        $stockitems = StockItem::withTrashed()->find($stockitem_id);

        $stockitems->restore(); //deleted in the Database

        $response['alert-success'] = 'Stockitem restore successfully';
        return redirect()->route('stockitem.deleted')->with($response);
    }

    public function Deleteforce($stockitem_id)
    {
        $stockitems = StockItem::withTrashed()->find($stockitem_id);

        $stockitems->forcedelete(); //deleted in the Database

        $response['alert-success'] = 'Stockitem deleted permanent';
        return redirect()->route('stockitem.deleted')->with($response);
    }

    public function view($stockitem_id)
    {
        $response['stockitems'] = StockItem::find($stockitem_id);
        return view('pages.stockitem.view')->with($response);
    }

    public function getData(Request $request)
    {
        $stockitems = StockItem::with(['stocks.warehouse'])->find($request->item_id);
        return $stockitems;
    }

    public function active($stockitem_id)
    {
        $stockitems = StockItem::find($stockitem_id);
        $stockitems->stockItem_status = 1;
        $stockitems->save();
        $response['alert-success'] = 'Stockitems activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($stockitem_id)
    {
        $stockitems = StockItem::find($stockitem_id);
        $stockitems->stockItem_status = 0;
        $stockitems->save();
        $response['alert-success'] = 'Stockitems deactivated successfully';
        return redirect()->back()->with($response);
    }
}
