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
        Schema::create('location_shelf_designs', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_code')->nullable();
            $table->string('bay_number')->nullable();
            $table->string('row_number')->nullable();
            $table->string('rack_number')->nullable();
            $table->string('shelf_number')->unique();
            $table->string('shelf_description')->nullable();
            $table->decimal('shelf_height', 5,2);
            $table->decimal('shelf_width', 5,2);
            $table->decimal('shelf_length', 5,2);
            $table->decimal('shelf_floor_area', 8,2);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->integer('location_shelf_design_status')->default(1);
            $table->foreignId('deleted_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('location_shelf_designs');
    }
};
