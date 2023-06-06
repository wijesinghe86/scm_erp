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
        Schema::create('location_rack_designs', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_code')->nullable();
            $table->string('bay_number')->nullable();
            $table->string('row_number')->nullable();
            $table->string('rack_number')->unique();
            $table->string('rack_description')->nullable();
            $table->decimal('rack_height', 5,2)->nullable();
            $table->decimal('rack_width', 5,2)->nullable();
            $table->decimal('rack_length', 5,2)->nullable();
            $table->decimal('rack_floor_area', 8,2)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('location_rack_design_status')->default(1);
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('location_rack_designs');
    }
};
