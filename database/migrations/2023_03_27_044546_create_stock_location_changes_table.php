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
        Schema::create('stock_location_changes', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number');
            $table->date('slc_date');
            $table->string('slc_number');
            $table->bigInteger('delivered_by');
            $table->date('delivered_date');
            $table->foreignId('fleet_id')->constrained('fleet_registrations');
            $table->string('remarks')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('created_by');
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
        Schema::dropIfExists('stock_location_changes');
    }
};
