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
        Schema::create('stock_location_change_issueds', function (Blueprint $table) {
            $table->id();
            $table->string('slc_number');
            $table->bigInteger('item_id');
            $table->string('stock_no');
            $table->string('description');
            $table->string('uom');
            $table->decimal('iss_qty',15,2)->default(0);
            $table->bigInteger('location_id');
            $table->bigInteger('issued_by');
            $table->date('iss_date');
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
        Schema::dropIfExists('stock_location_change_issueds');
    }
};
