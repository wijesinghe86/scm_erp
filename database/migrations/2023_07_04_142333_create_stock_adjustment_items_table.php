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
        Schema::create('stock_adjustment_items', function (Blueprint $table) {
            $table->id();
            $table->string('stock_adjustment_id')->nullable();
            $table->string('from_warehouse')->nullable();
            $table->string('to_warehouse')->nullable();
            $table->string('from_stock_number')->nullable();
            $table->string('to_stock_number')->nullable();
            $table->decimal('qty', 15, 2)->default(0);
            $table->decimal('weight', 15, 2)->default(0);
            $table->string('justification')->nullable();
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
        Schema::dropIfExists('stock_adjustment_items');
    }
};
