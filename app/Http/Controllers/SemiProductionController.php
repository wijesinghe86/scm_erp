<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\SemiProduction;
use App\Models\GoodsReceivedItem;
use App\Models\PlantRegistration;
use App\Models\SemiProductionItem;
use App\Models\RawMaterialSerialCode;
use App\Models\Stock;
use Illuminate\Validation\ValidationException;
use DB;
use Exception;

class SemiProductionController extends Controller
{
    public function index()
    {
        $semi_productions = SemiProduction::get();
        return view('pages.SemiProduction.index', compact('semi_productions'));
    }

    public function create()
    {
        $warehouses = Warehouse::get();
        $stockItems = StockItem::get();
        $grnItems = StockItem::has('grnItems')->get();
        $rawMaterialCodes = RawMaterialSerialCode::with('grn')->get();
        $plants = PlantRegistration::get();
        session(['semi.items' => []]);

        $items = session('semi.items') ?? [];

        $last_semi =  SemiProduction::latest()->first();
        $last_semi_number = 0;
        if ($last_semi != null) {
            $last_semi_number = $last_semi->id;
        }
        $next_number = "SP" . sprintf("%04d", $last_semi_number + 1);

        return view('pages.SemiProduction.create', compact('warehouses', 'grnItems', 'stockItems', 'plants', 'rawMaterialCodes', 'items', 'next_number'));
    }
    public function loadSerial(Request $request)
    {
        $list =  RawMaterialSerialCode::with(['grn','semi_production_items'])
        ->where('stock_item_id', $request->item_id)
        ->whereDoesntHave('semi_production_items')
        ->get();
        return $list;
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'semi_product_no' => 'required',
            'product_date' => 'required',
            'plant' => 'required',
            'warehouse' => 'required',
            'stock_item_id' => 'required',
            'serial' => 'required',
            'actual_weight' => 'required',
        ]);

        $items = session('semi.items') ?? [];
        if (count($items) == 0) {
            throw ValidationException::withMessages(['items' => 'please add products']);
        }

        try {
            DB::beginTransaction();
            $semiProductions = new SemiProduction();
            $semiProductions->semi_pro_No = $request->semi_product_no;
            $semiProductions->semi_pro_Date = $request->product_date;
            $semiProductions->plant_id = $request->plant;
            $semiProductions->warehouse_id = $request->warehouse;
            $semiProductions->raw_material_stock_no = $request->stock_item_id;
            $semiProductions->raw_material_serial_no = $request->serial;
            $semiProductions->raw_mat_serial_grn_qty = $request->qty;
            $semiProductions->raw_mat_serial_actual_qty = $request->actual_weight;
            $semiProductions->raw_mat_serial_qty_dif = $request->qty - $request->actual_weight;
            $semiProductions->grn_no = $request->grn_no;
            $semiProductions->tot_semi_product_qty = $request->tot_semi_product;
            $semiProductions->tot_raw_material_qty = $request->tot_raw_material;
            $semiProductions->diff_raw_mat_qty = $request->remaining_qty;
            $semiProductions->created_by = request()->user()->id;
            $semiProductions->save();

            //reduce stock from stock_item_id use actual_weight
            $stock = Stock::where('stock_item_id', $request->stock_item_id)->where('warehouse_id',$request->warehouse)->first();
            $stock->qty = $stock->qty - $request->actual_weight;
            $stock->save();

            foreach ($items as $item) {
                $semiProductionItems = new SemiProductionItem();
                $semiProductionItems->semi_pro_id = $semiProductions->id;
                $semiProductionItems->raw_mat_stock_no = $item['stock_item_id'];
                $semiProductionItems->raw_mat_serial_no = $item['serial'];
                $semiProductionItems->semi_pro_stock_no =  $item['semi_stock_item_id'];
                $semiProductionItems->semi_pro_qty = $item['semi_qty'];
                $semiProductionItems->semi_pro_weight = $item['semi_weight'];
                $semiProductionItems->semi_pro_serial_no = $item['semi_serial_no'];
                $semiProductionItems->save();

                // add stock from $item['stock_item_id'] use $item['semi_qty']
                $item_stock = Stock::where('stock_item_id', $request->stock_item_id)->where('warehouse_id',$request->warehouse)->first();
                $item_stock->qty = $item_stock->qty + $item['stock_item_id'];
                $item_stock->save();
            }

            DB::commit();
            session(['semi.items' => []]); // clear the session
            flash('Semi Productions completed successfully!')->success();
            return redirect()->route('semiproduction.index');
        } catch (Exception $e) {
            flash($e->getMessage())->error();
            DB::rollBack();
            logger($e->getMessage());
        }
    }

    public function addSemiProducts(Request $request)
    {
        $this->validate(
            $request,
            [
                'actual_weight' => 'required',
                'stock_no' => 'required',
                'stock_item_id' => 'required|numeric',
                'serial' => 'required',
                'stockNo' => 'required',
                'semi_stock_item_id' => 'required|numeric',
                'semi_qty' => 'required',
                'semi_weight' => 'required',
                'semi_serial_no' => 'required',
            ],
            [
                'stock_item_id.required' => "Raw material Description field is required",
                'stock_item_id.numeric' => "Raw Material Description field must be a number",
                'semi_stock_item_id.required' => "Semi Product Description field is required",
                'semi_stock_item_id.numeric' => "Semi Product Description field must be a number",
            ]
        );

        $items = session('semi.items') ?? [];

        if (collect($items)->where('serial_number_picker', $request->serial_number_picker)->sum('semi_qty') + $request->semi_qty > $request->actual_weight) {
            throw ValidationException::withMessages(['actual_weight' => 'The semi product weight exceeding actual weight']);
        }

        $stock_item = StockItem::find($request->stock_item_id);
        $stock_item_semi = StockItem::find($request->semi_stock_item_id);

        $items[] = [
            'serial_number_picker'=> $request->serial_number_picker,
            'stock_no' => $request->stock_no,
            'stock_item_id' => $request->stock_item_id,
            'raw_description' => $stock_item->description,
            'serial' => $request->serial,
            'stockNo' => $request->stockNo,
            'semi_stock_item_id' => $request->semi_stock_item_id,
            'semi_description' => $stock_item_semi->description,
            'semi_qty' => $request->semi_qty,
            'semi_weight' => $request->semi_weight,
            'semi_serial_no' => $request->semi_serial_no,

        ];
        session(['semi.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Added',
            'semi_product_total_qty' => collect($items)->sum('semi_qty'),
            'raw_material_total_qty' => $request->actual_weight,
        ];
    }

    public function deleteSessionItem(Request $request)
    {
        $items =  session('semi.items') ?? [];
        unset($items[$request->index]);
        session(['semi.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Removed'
        ];
    }


    public function viewCartTable()
    {
        $items =  session('semi.items') ?? [];
        return view('pages.SemiProduction.cart_table', compact('items'));
    }


    public function getNextSemiProductSerialNumber(Request $request)
    {
        $items =  session('semi.items') ?? [];
        $result = collect($items)->filter(function($item) use($request) {
            return $item['serial_number_picker'] == $request->serial_no;
        });
        $letter = assignLetterToNumber((int) count($result) + 1);
        $next_smp_sno = $request->serial_no . "_" . $letter;
        return $next_smp_sno;
    }
}
