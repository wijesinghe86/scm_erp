<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgent_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->unsignedBigInteger('delivery_order_id')->nullable();
            $table->unsignedBigInteger('sales_employee_id')->nullable();
            $table->string('ref_number')->nullable();
            $table->string('po_number')->nullable();
            $table->string('payment_terms')->default(1);
            $table->string('credit_days')->nullable();
            $table->integer('category')->nullable();
            $table->integer('type')->nullable();
            $table->integer('option')->nullable();
            $table->string('warehouse_id')->nullable();
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->string('vat_rate')->nullable();
            $table->decimal('vat_amount', 15, 2)->default(0);
            $table->decimal('net_total', 15, 2)->default(0);            
            $table->decimal('total_item_discount',18,2)->nullable();
            $table->decimal('grand_total', 15, 2)->default(0);
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('cancel_status')->default('Active');
            $table->string('cancelled_by')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urgent_invoices');
    }
};
