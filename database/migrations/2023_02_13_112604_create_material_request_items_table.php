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
        Schema::create('material_request_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mr_id')->nullable();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->decimal('remaining_qty', 15,2)->nullable();
            $table->string('priority')->nullable();
            $table->decimal('mrf_qty', 15,2)->nullable();
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
        Schema::dropIfExists('material_request_items');
    }
};
