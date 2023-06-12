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
            $table->string('plant_name')->nullable();
            $table->string('plant_type')->nullable();
            $table->string('plant_serial_number')->nullable();
            $table->string('model_number')->nullable();
            $table->string('manufactor_number')->nullable();
            $table->string('capacity')->nullable();
            $table->string('maintenance_period')->nullable();
            $table->string('technical_specification')->nullable();
            $table->string('electricalandelectronical_specification')->nullable();
            $table->string('electronic_specification')->nullable();
            $table->string('manual_operation_specification')->nullable();
            $table->string('maintaining_guide')->nullable();
            $table->string('operation_methods')->nullable();
            $table->string('analytical_manual')->nullable();
            $table->string('vendors_instruction_manual')->nullable();
            $table->string('safety_manual')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('po_number')->nullable();
            $table->string('grn_number')->nullable();
            $table->string('asset_code')->nullable();
            $table->unsignedBigInteger('warehouse_code')->nullable();
            $table->string('condition')->nullable();
            $table->string('tag_number')->nullable();
            $table->decimal('size', 12,2)->nullable();
            $table->decimal('weight', 12,2)->nullable();
            $table->string('output')->nullable();
            $table->integer('plant_registration_status')->default(1);
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
        Schema::dropIfExists('plant_registrations');
    }
};
