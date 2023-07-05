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
        Schema::create('equipment_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_code')->unique();
            $table->string('stock_number')->nullable();
            $table->string('equipment_name')->nullable();
            $table->string('po_number')->nullable();
            $table->string('grn_number')->nullable();
            $table->string('equipment_description')->nullable();
            $table->integer('equipment_type')->nullable();
            $table->integer('power_source')->nullable();
            $table->integer('equipment_registration_status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('equipment_registrations');
    }
};
