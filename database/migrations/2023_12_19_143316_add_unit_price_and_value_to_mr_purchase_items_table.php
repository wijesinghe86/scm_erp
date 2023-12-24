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
        Schema::table('mr_purchase_items', function (Blueprint $table) {
           $table->decimal('unit_price', 15,2)->nullable();
           $table->decimal('item_value', 15,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mr_purchase_items', function (Blueprint $table) {
            $table->dropColumn('unit_price');
            $table->dropColumn('item_value');
        });
    }
};
