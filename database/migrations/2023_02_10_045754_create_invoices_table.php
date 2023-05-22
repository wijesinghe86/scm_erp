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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->bigInteger('employee_id');
            $table->string('ref_number');
            $table->string('po_number');
            $table->integer('payment_terms')->default(1);
            $table->integer('category');
            $table->integer('type');
            $table->integer('option');
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('vat_amount', 15, 2)->default(0);
            $table->decimal('net_total', 15, 2)->default(0);
            $table->string('vat_rate')->nullable();
            $table->string('discount_type')->nullable();
            $table->decimal('discount_amount',18,2)->nullable();
            $table->decimal('discount',18,2)->nullable();
            $table->decimal('grand_total', 15, 2)->default(0);
            $table->integer('status')->nullable();
            $table->foreignId('created_by')->constrained('users');
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
        Schema::dropIfExists('invoices');
    }
};
