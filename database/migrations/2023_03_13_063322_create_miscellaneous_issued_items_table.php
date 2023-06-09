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
        Schema::create('miscellaneous_issued_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('misc_id')->nullable();
            $table->bigInteger('item_id')->nullable();
            $table->decimal('iss_qty',15,2)->default(0);
            $table->decimal('iss_weight',15,2)->default(0);
            $table->bigInteger('location_id')->nullable();
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
        Schema::dropIfExists('miscellaneous_issued_items');
    }
};
