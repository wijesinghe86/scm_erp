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
        Schema::create('raw_material_receiveds', function (Blueprint $table) {
            $table->id();
            $table->string('rma_no')->nullable();
            $table->string('rmi_no')->nullable();
            $table->unsignedBigInteger('received_location')->nullable();
            $table->unsignedBigInteger('received_by')->nullable();
            $table->dateTime('received_date_time')->nullable();
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
        Schema::dropIfExists('raw_material_receiveds');
    }
};
