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
        Schema::create('credit_note_item_tables', function (Blueprint $table) {
            $table->id();
            $table->string('credit_note_no')->nullable();
            $table->string('stock_no')->nullable();
            $table->decimal('credit_qty', 15,2)->nullable();
            $table->decimal('unit_rate', 15,2)->nullable();
            $table->decimal('sales_value', 15,2)->nullable();
            $table->decimal('vat_amount', 15,2)->nullable();
            $table->decimal('total_sales_value', 15,2)->nullable();
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
        Schema::dropIfExists('credit_note_item_tables');
    }
};
