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
        Schema::create('semi_production_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semi_pro_id')->nullable();
            $table->unsignedBigInteger('raw_mat_stock_no')->nullable();
            $table->string('raw_mat_serial_no')->nullable();
            $table->unsignedBigInteger('semi_pro_stock_no')->nullable();
            $table->decimal('semi_pro_qty', 15,2)->nullable();
            $table->decimal('semi_pro_weight', 15,2)->nullable();
            $table->string('semi_pro_serial_no')->nullable();
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
        Schema::dropIfExists('semi_production_items');
    }
};
