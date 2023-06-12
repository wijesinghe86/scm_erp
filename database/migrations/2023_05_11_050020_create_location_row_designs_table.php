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
        Schema::create('location_row_designs', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_code')->nullable();
            $table->string('bay_number')->nullable();
            $table->string('row_number')->unique();
            $table->string('row_description')->nullable();
            $table->decimal('row_height', 12,2)->nullable();
            $table->decimal('row_width', 12,2)->nullable();
            $table->decimal('row_length', 12,2)->nullable();
            $table->decimal('row_floor_area', 12,2)->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->integer('locationrowdesign_status')->default(1);
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->SoftDeletes();
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
        Schema::dropIfExists('location_row_designs');
    }
};
