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
        Schema::create('material_requests', function (Blueprint $table) {
            $table->id();
            $table->date("mrf_date")->nullable();
            $table->string("mrf_no")->nullable();
            $table->text('justification')->nullable();
            $table->unsignedBigInteger("employee_id")->nullable();
            $table->unsignedBigInteger("created_by_id")->nullable();
            $table->date('required_date')->nullable();
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
        Schema::dropIfExists('material_requests');
    }
};
