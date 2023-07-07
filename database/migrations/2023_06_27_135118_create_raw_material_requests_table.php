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
        Schema::create('raw_material_requests', function (Blueprint $table) {
            $table->id();
            $table->string('rmr_no')->nullable();
            $table->date('req_date')->nullable();
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->date('required_date')->nullable();
            $table->string('justification')->nullable();
            $table->string('job_order_no')->nullable();
            $table->string('plant_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
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
        Schema::dropIfExists('raw_material_requests');
    }
};
