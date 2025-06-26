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
        Schema::create('damage_returns', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('dr_no');
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->string('reason')->nullable();
            $table->string('ori_stock_id')->nullable();
            $table->string('dmg_stock_id')->nullable();
            $table->decimal('qty', 15, 2)->nullable();
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
        Schema::dropIfExists('damage_returns');
    }
};
