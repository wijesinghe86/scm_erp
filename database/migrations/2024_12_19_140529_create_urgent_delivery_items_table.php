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
        Schema::create('urgent_delivery_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('delivery_order_id');
            $table->string('item_id');
            $table->bigInteger('invoice_id');
            $table->integer('issued_qty')->default(1);
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
        Schema::dropIfExists('urgent_delivery_items');
    }
};
