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
        Schema::create('goods_received_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grn_id')->nullable();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->decimal('rec_qty', 15,2)->nullable();
            $table->decimal('rec_weight', 15, 2)->nullable();
            $table->string('batch_no')->nullable();
            $table->date('expiry_date')->nullable();
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
        Schema::dropIfExists('goods_received_items');
    }
};
