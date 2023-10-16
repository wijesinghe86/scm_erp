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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();
            $table->string('delivery_order_no');
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('issued_date')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('balance_order_id')->nullable();
            $table->string('returned_ids')->nullable();
            $table->bigInteger('created_by')->nullable();
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
        Schema::dropIfExists('delivery_orders');
    }
};
