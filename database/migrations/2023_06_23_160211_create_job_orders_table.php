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
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->string('job_order_no')->nullable();
            $table->date('jo_date')->nullable();
            $table->unsignedBigInteger('pps_no')->nullable();
            $table->string('df_no')->nullable();
            $table->unsignedBigInteger('plant_id')->nullable();
            $table->unsignedBigInteger('supervisor')->nullable();
            $table->dateTime('start_date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();
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
        Schema::dropIfExists('job_orders');
    }
};
