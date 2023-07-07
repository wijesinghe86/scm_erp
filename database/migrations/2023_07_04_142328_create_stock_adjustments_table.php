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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('stock_adjustment_number')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('created_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->string('approved_status')->nullable();
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
        Schema::dropIfExists('stock_adjustments');
    }
};
