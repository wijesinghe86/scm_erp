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
        Schema::create('plant_registrations', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('stock_number');
            $table->string('plant_number')->unique();
            $table->string('plant_name');
            $table->string('plant_type');
            $table->string('plant_serial_number');
            $table->string('model_number');
            $table->string('manufactor_number');
            $table->string('capacity');
            $table->string('maintenance_period');
            $table->string('technical_specification');
            $table->string('electricalandelectronical_specification');
            $table->string('electronic_specification');
            $table->string('manual_operation_specification');
            $table->string('maintaining_guide');
            $table->string('operation_methods');
            $table->string('analytical_manual');
            $table->string('vendors_instruction_manual');
            $table->string('safety_manual');
            $table->date('purchase_date');
            $table->string('po_number');
            $table->string('grn_number');
            $table->string('asset_code');
            $table->bigInteger('warehouse_code');
            $table->string('condition');
            $table->string('tag_number');
            $table->decimal('size');
            $table->decimal('weight');
            $table->string('output');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->integer('plant_registration_status')->default(1);
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
        Schema::dropIfExists('plant_registrations');
    }
};
