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
        Schema::create('customer_payment_updates', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code')->nullable();
            $table->string('customer_code')->nullable();
            $table->string('customer_id')->nullable();
            $table->decimal('outstanding_amount', 15,2)->nullable();
            $table->decimal('received_amount', 15,2)->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('received_date')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('bank')->nullable();
            $table->string('cheque_no')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('customer_payment_updates');
    }
};
