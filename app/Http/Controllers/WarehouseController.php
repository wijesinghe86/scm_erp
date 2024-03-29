<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function generateNextNumber()
    {
        $count  = Warehouse::get()->count();
        return "WHS" . sprintf('%03d', $count + 1);
    }

    public function index()
    {
        $warehouses = Warehouse::get();
        return view('pages.Warehouse.index', compact('warehouses'));
    }

    public function create()
    {
        // $last_wh =  Warehouse::latest()->first();
        // $last_wh_number = 0;
        // if($last_wh != null){
        //    $last_wh_number = $last_wh->id;
        // }
        // $next_number = "WHS".sprintf("%03d", $last_wh_number+1);
        $warehouse = new Warehouse;
        $next_number = $this->generateNextNumber();
        return view('pages.Warehouse.create', compact('next_number', 'warehouse'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'warehouse_code' => 'required',
            'warehouse_name' => 'required',
        ]);

        $isWhsExist = Warehouse::where('warehouse_code', $request->warehouse_code)->first();
        if ($isWhsExist) {
            $data['warehouse_code'] = $this->generateNextNumber();
        }
        $request['created_by'] = Auth::id();


        try {
            DB::beginTransaction();
            $warehouse = Warehouse::create($request->all());

            $stock_items = StockItem::get();

            foreach ($stock_items as $key => $stock_item) {
                $isExist = Stock::where('warehouse_id', $warehouse->id)->where('stock_item_id', $stock_item->id)->first();
                if ($isExist) {
                    continue;
                }
                $stock = new Stock;
                $stock->stock_item_id = $stock_item->id;
                $stock->warehouse_id = $warehouse->id;
                $stock->qty = 0;
                $stock->save();
            }
            DB::commit();
            flash()->success("Warehouse Details created successfully!");
            return redirect()->route('warehouse.index');
        } catch (Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            redirect()->back();
        }
    }

    public function edit($warehouse_id)
    {
        $response['warehouses'] = Warehouse::find($warehouse_id);
        return view('pages.Warehouse.edit')->with($response);
    }

    public function update(Request $request, $warehouse_id)
    {
        $warehouse = Warehouse::find($warehouse_id);
        $warehouse->update($request->all());

        $request['updated_by'] = Auth::id();
        Warehouse::find($warehouse_id)->update($request->all());

        $response['alert-success'] = 'Warehouse updated successfully';
        return redirect()->route('warehouse.index')->with($response);
    }

    public function delete($warehouse_id)
    {
        $warehouse = Warehouse::find($warehouse_id);
        $warehouse->deleted_by = Auth::id();
        $warehouse->save();
        $warehouse->delete();

        $response['alert-success'] = 'Warehouse deleted successfully';
        return redirect()->route('warehouse.index')->with($response);
    }

    public function deleted()
    {
        $response['warehouses'] = Warehouse::onlyTrashed()->get();
        return view('pages.Warehouse.deleted')->with($response);
    }

    public function restore($warehouse_id)
    {
        $warehouse = Warehouse::withTrashed()->find($warehouse_id);
        $warehouse->restore();

        $response['alert-success'] = 'Warehouse restore Successfully';
        return redirect()->route('warehouse.deleted')->with($response);
    }

    public function Deleteforce($warehouse_id)
    {
        $warehouse = Warehouse::withTrashed()->find($warehouse_id);
        $warehouse->forcedelete();

        $response['alert-success'] = 'Warehouse deleted permanent';
        return redirect()->route('warehouse.deleted')->with($response);
    }

    public function view($warehouse_id)
    {
        $response['warehouses'] = Warehouse::find($warehouse_id);
        return view('pages.Warehouse.view')->with($response);
    }

    public function getData(Request $request)
    {
        $warehouses = Warehouse::find($request->location_id);
        return $warehouses;
    }

    public function active($warehouse_id)
    {
        $warehouses = Warehouse::find($warehouse_id);
        $warehouses->warehouse_status = 1;
        $warehouses->save();
        $response['alert-success'] = 'Warehouse activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($warehouse_id)
    {
        $warehouses = Warehouse::find($warehouse_id);
        $warehouses->warehouse_status = 0;
        $warehouses->save();
        $response['alert-success'] = 'Warehouse deactivated successfully';
        return redirect()->back()->with($response);
    }
}
