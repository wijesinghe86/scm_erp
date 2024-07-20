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
        Schema::create('finished_goods_item_details', function (Blueprint $table) {
            $table->id();
            $table->string('fgrn_no')->nullable();
            $table->string('rmi_stock_no')->nullable();
            $table->decimal('issued_qty', 15,2)->nullable();
            $table->decimal('issued_weight', 15,2)->nullable();
            $table->string('pro_stock_no')->nullable();
            $table->string('pro_description')->nullable();
            $table->decimal('pro_qty', 15,2)->nullable();
            $table->decimal('pro_weight', 15,2)->nullable();
            $table->string('batch_no')->nullable();
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
        Schema::dropIfExists('finished_goods_item_details');

    }
};
