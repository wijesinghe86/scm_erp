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
        Schema::create('distributor_delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();
            $table->string('delivery_order_no');
            $table->string('invoice_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('issued_date')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('balance_order_id')->nullable();
            $table->string('returned_ids')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('nic_no')->nullable();
            $table->string('cancel_status')->default('Active');
            $table->string('cancelled_by')->nullable();
            $table->dateTime('cancel_date')->nullable();
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
        Schema::dropIfExists('distributor_delivery_orders');
    }
};
