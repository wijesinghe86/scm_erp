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
        Schema::create('op_balances', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('ref_no')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->string('justification')->nullable();
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
        Schema::dropIfExists('op_balances');
    }
};
