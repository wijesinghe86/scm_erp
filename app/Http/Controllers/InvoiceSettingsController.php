<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use Illuminate\Http\Request;
use App\Models\InvoiceSetting;

class InvoiceSettingsController extends ParentController
{
    public function all()
    {
        $response['categories'] = BillType::all();
        $response['setting'] = InvoiceSetting::first();
        return view('pages.InvoiceSettings.new')->with ($response);
    }

    public function update(Request $request)
    {
        $response['categories']=BillType::all();
        $setting = InvoiceSetting::first();
        if ($setting)
        {
            $setting->update($request->all());
        }
        else
        {
            InvoiceSetting::create($request->all());
        }
        return redirect()->route('invoices.new');
    }
}
