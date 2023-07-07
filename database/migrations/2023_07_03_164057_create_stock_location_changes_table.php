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
            $table->string('slc_number')->nullable();
            $table->date('slc_date')->nullable();
            $table->string('issued_date')->nullable();
            $table->string('issued_by')->nullable();
            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('approved_date')->nullable();
            $table->string('approved_status')->nullable();
            $table->string('approved_remark')->nullable();
            $table->string('received_by')->nullable();
            $table->string('received_date')->nullable();
            $table->string('received_remark')->nullable();
            $table->string('delivered_by')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('fleet_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('remarks')->nullable();
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
