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
        Schema::create('urgent_return_items', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->string('return_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('location_id')->nullable();
            $table->string('delivery_order_item_id')->nullable();
            $table->string('stock_no')->nullable();
            $table->string('description')->nullable();
            $table->string('uom')->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('sub_total', 15, 2)->default(0);
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
        Schema::dropIfExists('urgent_return_items');
    }
};
