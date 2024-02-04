<?php

namespace Database\Seeders;

use App\Models\InvoiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoiceType = new InvoiceType();
        $invoiceType->name = "Non-Tax Invoice";
        $invoiceType->status = 1;
        $invoiceType->save();
        $invoiceType = new InvoiceType();
        $invoiceType->name = "Tax Invoice";
        $invoiceType->status = 1;
        $invoiceType->save();
        $invoiceType = new InvoiceType();
        $invoiceType->name = "Suspended Tax Invoice";
        $invoiceType->status = 1;
        $invoiceType->save();
       
    }
}
