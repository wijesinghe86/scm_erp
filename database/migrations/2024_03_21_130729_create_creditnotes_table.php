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
        Schema::create('creditnotes', function (Blueprint $table) {
            $table->id();
            $table->string('credit_note_no')->nullable;
            $table->date('credit_note_date')->nullable;
            $table->string('invoice_no')->nullable;
            $table->string('hand_chit_no')->nullable;
            $table->string('less_invoice_no')->nullable;
            $table->string('reference_no')->nullable;
            $table->decimal('grand_total', 15,2)->nullable;
            $table->unsignedBigInteger('created_by')->nullable;
            $table->unsignedBigInteger('approved_by')->nullable;
            $table->unsignedBigInteger('cancelled_by')->nullable;
            $table->dateTime('approved_date_time')->nullable;
            $table->dateTime('cancelled_date_time')->nullable;
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
        Schema::dropIfExists('creditnotes');
    }
};
