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
        Schema::create('fleet_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('fleet_number')->unique();
            $table->string('fleet_name')->nullable();
            $table->string('fleet_registration_number')->nullable();
            $table->string('fleet_model_manufacture')->nullable();
            $table->integer('category_of_fleet')->default(1);
            $table->string('current_meter_reading')->nullable();
            $table->integer('type_of_fuel_consumption')->default(1);
            $table->string('loading_capacity')->nullable();
            $table->integer('fleet_type')->default(1);
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('fleet_manufacture_year')->nullable();
            $table->string('colour')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->date('tax_period_from')->nullable();
            $table->date('tax_period_to')->nullable();
            $table->decimal('paid_amount',12,2)->nullable();
            $table->string('insured_company')->nullable();
            $table->string('insurance_policy')->nullable();
            // $table->integer('period')->nullable();
            $table->date('insurance_start_date')->nullable();
            $table->date('insurance_expire_date')->nullable();
            $table->decimal('amount',15,2)->nullable();
            $table->integer('fleet_registration_status')->default(1);
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
        Schema::dropIfExists('fleet_registrations');
    }
};
