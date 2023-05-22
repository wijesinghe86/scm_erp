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
        Schema::create('balance_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_order_id')->nullable();
            $table->unsignedBigInteger('delivery_order_item_id')->nullable();
            $table->unsignedBigInteger('balance_order_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->string('stock_no')->nullable();
            $table->string('description')->nullable();
            $table->string('uom')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->unsignedBigInteger('location')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('balance_order_items');
    }
};
