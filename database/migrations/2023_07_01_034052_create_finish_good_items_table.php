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
        Schema::create('finish_good_items', function (Blueprint $table) {
            $table->id();
            $table->string('fgrn_no')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->string('rmi_no')->nullable();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->string('semi_product_serial_no')->nullable();
            $table->string('rmi_item_stock_description')->nullable();
            $table->string('rmi_item_stock_number')->nullable();
            $table->string('rmi_qty')->nullable();
            $table->decimal('pro_qty', 15, 2)->default(0);
            $table->decimal('pro_weight', 15, 2)->default(0);
            $table->string('batch_no')->nullable();
            $table->string('pro_description')->nullable();
            $table->string('pro_stock_no')->nullable();
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
        Schema::dropIfExists('finish_good_items');
    }
};
