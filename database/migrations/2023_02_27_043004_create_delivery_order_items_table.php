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
        Schema::create('delivery_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_order_no');
            $table->bigInteger('item_id');
            $table->bigInteger('invoice_id');
            $table->string('stock_no')->nullable();
            $table->string('description')->nullable();
            $table->string('uom')->nullable();
            $table->integer('qty')->default(1);
            $table->integer('available_qty')->default(0);
            $table->integer('issued_qty')->default(0);
            $table->date('issued_date')->nullable();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('discount_percentage', 8, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->bigInteger('location')->nullable();
            $table->decimal('returned_qty', 15, 2)->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('issued_by')->nullable();
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
        Schema::dropIfExists('delivery_order_items');
    }
};
