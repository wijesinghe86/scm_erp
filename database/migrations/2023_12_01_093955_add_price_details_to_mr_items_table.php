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
        Schema::table('material_request_items', function (Blueprint $table) {
           $table->decimal('unit_price', 15, 2)->nullable();
           $table->decimal('value', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_request_items', function (Blueprint $table) {
           $table->dropColumn('unit_price');
           $table->dropColumn('value');
        });
    }
};
