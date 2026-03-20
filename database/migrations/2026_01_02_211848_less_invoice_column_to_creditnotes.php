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
        Schema::table('creditnotes', function (Blueprint $table) {
            $table->decimal('less_amount', 15,2)->default(0);
            $table->decimal('less_invoice_amount', 15,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creditnotes', function (Blueprint $table) {
            $table->dropColumn('less_amount');
            $table->dropColumn('less_invoice_amount');
        });
    }
};
