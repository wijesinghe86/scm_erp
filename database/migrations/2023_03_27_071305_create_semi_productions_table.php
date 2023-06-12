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
        Schema::create('semi_productions', function (Blueprint $table) {
            $table->id();
            $table->string('semi_pro_No')->nullable();
            $table->date('semi_pro_Date')->nullable();
            $table->unsignedBigInteger('plant_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('raw_material_stock_no')->nullable();
            $table->unsignedBigInteger('raw_material_serial_no')->nullable();
            $table->unsignedBigInteger('grn_no')->nullable();
            $table->decimal('raw_mat_serial_grn_qty', 15,2)->nullable();
            $table->decimal('raw_mat_serial_actual_qty', 15,2)->nullable();
            $table->decimal('raw_mat_seriala_qty_dif', 15,2)->nullable();
            $table->decimal('tot_raw_mat_qty', 15,2)->nullable();
            $table->decimal('tot_raw material_qty', 15,2)->nullable();
            $table->decimal('diff_raw_mat_qty', 15,2)->nullable();
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
        Schema::dropIfExists('semi_productions');
    }
};
