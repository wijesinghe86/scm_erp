<?php

namespace Database\Seeders;

use App\Models\InvoiceOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $invoiceOption = new InvoiceOption();
            $invoiceOption->name = "None";
            $invoiceOption->status = 1;
            $invoiceOption->save();
            $invoiceOption = new InvoiceOption();
            $invoiceOption->name = "Option A";
            $invoiceOption->status = 1;
            $invoiceOption->save();
            $invoiceOption = new InvoiceOption();
            $invoiceOption->name = "Option B";
            $invoiceOption->status = 1;
            $invoiceOption->save();
            $invoiceOption = new InvoiceOption();
            $invoiceOption->name = "Option C";
            $invoiceOption->status = 1;
            $invoiceOption->save();

        }
    }
}
