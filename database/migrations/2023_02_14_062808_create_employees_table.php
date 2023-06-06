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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_reg_no')->nullable();
            $table->string('employee_epf_no')->nullable();
            $table->string('employee_fullname')->nullable();
            $table->string('employee_name_with_intial')->nullable();
            $table->string('residential_address_line1')->nullable();
            $table->string('residential_address_line2')->nullable();
            $table->string('postal_address_line1')->nullable();
            $table->string('postal_address_line2')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('gender')->default(1);
            $table->integer('civil_status')->default(1);
            $table->string('employee_nic_no')->nullable();
            $table->string('employee_mobile_number')->nullable();
            $table->string('employee_residential_phone_number')->nullable();
            $table->string('employee_email')->nullable();
            $table->string('employee_type')->default(1);
            $table->string('section')->nullable();
            $table->string('department')->nullable();
            $table->date('join_date')->nullable();
            $table->date('last_date')->nullable();
            $table->string('designation')->nullable();
            $table->string('remark')->nullable();
            $table->string('role')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('fleet_number')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->integer('employee_status')->default(1);
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
        Schema::dropIfExists('employees');
    }
};
