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
        Schema::create('mrf_prf_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->unsignedBigInteger('mr_id')->nullable();
            $table->decimal("prfqty",'8','2')->nullable();
            $table->unsignedBigInteger('prf_id')->nullable();
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
        Schema::dropIfExists('mrf_prf_items');
    }
};
