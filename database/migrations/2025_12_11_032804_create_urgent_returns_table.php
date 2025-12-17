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
        Schema::create('urgent_returns', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->string('delivery_order_id')->nullable();
            $table->string('return_no')->nullable();
            $table->string('created_by')->nullable();
            $table->string('location_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('is_approved')->nullable();
            $table->string('return_reason')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
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
        Schema::dropIfExists('urgent_returns');
    }
};
