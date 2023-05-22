<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\SemiProduction;
use App\Models\StockItem;
use App\Models\GoodsReceivedItem;
use App\Models\PlantRegistration;
use App\Models\SemiProductionItem;
use App\Models\RawMaterialSerialCode;


class SemiProductionController extends Controller
{
    public function index()
    {

         return view('pages.SemiProduction.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        $stockItems = StockItem::get();
        $grnItems = StockItem::has('grnItems')->get();
        //$grnItems = GoodsReceivedItem::with('item')->distinct('stock_item_id')->get();
        $rawMaterialCodes = RawMaterialSerialCode::get();
        $plants = PlantRegistration::get();

        $items = session('semi.items')??[];

        $last_semi =  SemiProduction::latest()->first();
        $last_semi_number = 0;
        if($last_semi != null){
           $last_semi_number = $last_semi->id;
        }
        $next_number = "SP".sprintf("%04d", $last_semi_number+1);

        return view('pages.SemiProduction.create',compact('warehouses', 'grnItems','stockItems', 'plants', 'rawMaterialCodes', 'items', 'next_number'));
    }
    public function loadSerial(Request $request){
        $list =  RawMaterialSerialCode::with('grn')->where('stock_item_id',$request->item_id)->get();
        return view('pages.SemiProduction.serial_picker',compact('list'));

    }

    public function addSemiProducts(Request $request)
    {
        $this->validate($request,
            [
            'stock_no'=>'required',
            'stock_item_id'=>'required|numeric',
            'serial'=>'required',
            'stockNo'=>'required',
            'semi_stock_item_id'=>'required|numeric',
            'semi_qty'=>'required',
            'semi_weight'=>'required',
            'semi_serial_no'=>'required',
            ],
            [
                'stock_item_id.required'=>"Raw material Description field is required",
                'stock_item_id.numeric'=>"Raw Material Description field must be a number",
                'semi_stock_item_id.required'=>"Semi Product Description field is required",
                'semi_stock_item_id.numeric'=>"Semi Product Description field must be a number",
            ]);

        $items = session('semi.items')??[];

        $stock_item = StockItem::find($request->stock_item_id);
        $stock_item_semi = StockItem::find($request->semi_stock_item_id);

        $items[] = [
            'stock_no'=>$request->stock_no,
            'stock_item_id'=>$request->stock_item_id,
            'raw_description'=>$stock_item->description,
            'serial'=>$request->serial,
            'stockNo'=>$request->stockNo,
            'semi_stock_item_id'=>$request->semi_stock_item_id,
            'semi_description'=>$stock_item_semi->description,
            'semi_qty'=>$request->semi_qty,
            'semi_weight'=>$request->semi_weight,
            'semi_serial_no'=>$request->semi_serial_no,

        ];
        session(['semi.items'=>$items]);

        return redirect()->back()->withInput();

    }

    public function store(Request $request)
    {
        if ($request->button =='add')
        {
            return $this->addSemiProducts($request);
        }
        //dd($request->all());
        // $this->validate($request, [
        // ]);
        $items = session ('semi.items')??[];
        if (count($items) == 0) {
            throw ValidationException::withMessages(['items'=>'please add products']);
        }

        $semiProductions = new SemiProduction();
        $semiProductions->semi_pro_No = $request->semi_product_no;
        $semiProductions->semi_pro_Date = $request->product_date;
        $semiProductions->plant_id = $request->plant;
        $semiProductions->warehouse_id = $request->warehouse;
        $semiProductions->raw_material_stock_no = $request->stock_item_id;
        $semiProductions->raw_material_serial_no = $request->serial;
        // $semiProduction->grn_no = $request->grn_no;
        $semiProductions->raw_mat_serial_grn_qty = $request->qty;
        $semiProductions->raw_mat_serial_actual_qty = $request->actual_weight;
        $raw_mat_dif = ($semiProductions->raw_mat_serial_grn_qty)-($semiProductions->raw_mat_serial_actual_qty);
        $semiProductions->raw_mat_seriala_qty_dif = $raw_mat_dif;
        $semiProductions->tot_raw_mat_qty = $request->qty;
    //    $tot_serial_qty = sum($request->qty);
    //     $semiProductions->tot_raw_material = $tot_serial_qty;
    //     $qty_diff = ( $semiProduction->tot_raw_mat_qty)- ($semiProduction->tot_raw_material);
    //     $semiProductions->diff_raw_mat_qty = $qty_diff;
        $semiProductions->created_by = request()->user()->id;
        $semiProductions->save();

        foreach($items as $item){
        $semiProductionItems = new SemiProductionItem();
        $semiProductionItems->semi_pro_id = $semiProductions->id;
        $semiProductionItems->raw_mat_stock_no = $item['stock_item_id'];
        $semiProductionItems->raw_mat_serial_no = $item['serial'];
        $semiProductionItems->semi_pro_stock_no =  $item['semi_stock_item_id'];
        $semiProductionItems->semi_pro_qty = $item['semi_qty'];
        $semiProductionItems->semi_pro_weight =$item['semi_weight'];
        $semiProductionItems->semi_pro_serial_no =$item['semi_serial_no'];
        $semiProductionItems->save();
        }

        session(['semi.items'=>[]]); // clear the session
        flash('Semi Productions completed successfully!')->success();
        return redirect()->route('semiproduction.index');


    }

    public function deleteSessionItem($index)
 {
     $items =  session('semi.items') ?? [];
     unset($items[$index]);
     session(['semi.items'=>$items]);
     return  redirect()->back()->withInput();
 }
    }


