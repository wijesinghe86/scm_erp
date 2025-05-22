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
        Schema::table('urgent_invoice_items', function (Blueprint $table) {
            $table->string('urgent_delivery_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('urgent_invoice_items', function (Blueprint $table) {
            $table->dropColumn('urgent_delivery_no');
        });
    }
};
