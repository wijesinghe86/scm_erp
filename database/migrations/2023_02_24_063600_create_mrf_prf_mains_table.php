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
        Schema::create('mrf_prf_mains', function (Blueprint $table) {
            $table->id();
            $table->string("mrfprf_no")->nullable();
            $table->date("mrfprf_date")->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
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
        Schema::dropIfExists('mrf_prf_mains');
    }
};
