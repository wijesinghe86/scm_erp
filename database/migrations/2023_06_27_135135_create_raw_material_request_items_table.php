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
        Schema::create('raw_material_request_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rmr_no')->nullable();
            $table->unsignedBigInteger('jo_stock_no')->nullable();
            $table->unsignedBigInteger('raw_material_stock_no')->nullable();
            $table->decimal('req_qty', 15, 2)->default(0);
            $table->decimal('req_weight', 15, 2)->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('raw_material_request_items');
    }
};
