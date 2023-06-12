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
        Schema::create('location_bay_designs', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_code')->unique();
            $table->string('bay_number')->unique();
            $table->string('bay_description')->nullable();
            $table->decimal('bay_height', 12,2)->nullable();
            $table->decimal('bay_width',12,2)->nullable();
            $table->decimal('bay_length', 12,2)->nullable();
            $table->decimal('bay_floor_area', 12,2)->nullable();
            $table->integer('locationbaydesign_status')->default(1);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('location_bay_designs');
    }
};
