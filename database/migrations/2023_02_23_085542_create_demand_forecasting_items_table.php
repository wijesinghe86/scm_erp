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
        Schema::create('demand_forecasting_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->unsignedBigInteger('mr_id')->nullable();
            $table->decimal("qty",'8','2')->nullable();
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
        Schema::dropIfExists('demand_forecasting_items');
    }
};
