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
        Schema::create('production_planing_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->unsignedBigInteger('df_id')->nullable();
            $table->unsignedBigInteger('pps_id')->nullable();
            $table->decimal('pps_qty','8','2')->nullable();
            $table->decimal('weight','8','2')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('production_planing_items');
    }
};
