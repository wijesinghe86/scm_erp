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
        Schema::create('urgent_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('stock_no')->nullable();
            $table->string('description')->nullable();
            $table->string('uom')->nullable();
            $table->decimal('quantity',15,2)->default(0);
            $table->decimal('unit_price',15,2)->default(0);
            $table->decimal('item_discount_percentage', 18,2)->default(0);
            $table->decimal('item_discount_amount', 15,2)->default(0);
            $table->bigInteger('location_id')->nullable();
            $table->decimal('sub_total', 15,2)->default(0);
            $table->decimal('total', 15,2)->default(0);
            $table->string('status')->default('draft')->nullable();
            $table->string('item_discount_type')->nullable();
            $table->decimal('item_discount_value', 18,2)->default(0);
            $table->decimal('weight',15,2)->default(0);
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('urgent_invoice_items');
    }
};
