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
        Schema::create('ditributor_deliver_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_order_no');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('stock_no')->nullable();
            $table->string('description')->nullable();
            $table->string('uom')->nullable();
            $table->decimal('qty',15,2)->default(0);
            $table->decimal('available_qty',15,2)->default(0);
            $table->decimal('issued_qty',15,2)->default(0);
            $table->date('issued_date')->nullable();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('discount_percentage', 8, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->unsignedBigInteger('location')->nullable();
            $table->decimal('returned_qty', 15, 2)->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('issued_by')->nullable();
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
        Schema::dropIfExists('ditributor_deliver_order_items');
    }
};
