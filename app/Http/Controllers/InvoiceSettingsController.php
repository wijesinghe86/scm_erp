<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use Illuminate\Http\Request;
use App\Models\InvoiceSetting;

class InvoiceSettingsController extends ParentController
{
    public function all()
    {
        $categories = BillType::all();
        $settings = InvoiceSetting::all();

        return view('pages.InvoiceSettings.all', compact('categories', 'settings'));
    }

    public function new(){
        return view('pages.InvoiceSettings.new');
    }

    public function update(Request $request)
    {
        $categories = BillType::all();
        $setting = InvoiceSetting::first();
        if ($setting) {
            $setting->update($request->all());
        } else {
            InvoiceSetting::create($request->all());
        }
        return redirect()->route('invoices.new',['categories'=> $categories]);
    }

    public function getData(Request $request)
    {
        $settings = InvoiceSetting::find($request->setting_id);
        return $settings;
    }
}
