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
        Schema::table('finish_good_items', function (Blueprint $table) {
            $table->dropColumn('warehouse_id');
            $table->dropColumn('stock_item_id');
            $table->dropColumn('pro_qty');
            $table->dropColumn('pro_weight');
            $table->dropColumn('pro_description');
            $table->dropColumn('pro_stock_no');
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finish_good_items', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('stock_item_id');
            $table->decimal('pro_qty');
            $table->decimal('pro_weight');
            $table->string('pro_description');
            $table->string('pro_stock_no');
           
        });
    }
};
