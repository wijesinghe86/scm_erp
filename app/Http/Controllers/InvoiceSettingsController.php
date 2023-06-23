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
        $setting = InvoiceSetting::first();
        return view('pages.InvoiceSettings.new', compact('categories', 'setting'));
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
}
