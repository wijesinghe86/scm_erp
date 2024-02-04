<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_category', 5)->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('invoice_type');
            $table->unsignedBigInteger('invoice_option');
            $table->timestamps();

            $table->foreign('invoice_type')->references('id')->on('invoice_types');
            $table->foreign('invoice_option')->references('id')->on('invoice_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_settings');
    }
};
