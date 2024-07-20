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
        Schema::table('finish_goods', function (Blueprint $table) {
            $table->string('rmi_stock_no')->nullable();
            $table->string('rmi_stock_id')->nullable();
            $table->string('pro_stock_no')->nullable();
            $table->string('pro_stock_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finish_goods', function (Blueprint $table) {
            $table->dropColumn('rmi_stock_no');
            $table->dropColumn('rmi_stock_id');
            $table->dropColumn('pro_stock_no');
            $table->dropColumn('pro_stock_id');    
        });
    }
};
