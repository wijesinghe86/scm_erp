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
        Schema::table('urgent_delivery_items', function (Blueprint $table) {
            $table->decimal('return_qty', 15, 2)->default(0);
            $table->decimal('remaining_qty', 15, 2)->default(0);
        });

         Schema::table('urgent_deliveries', function (Blueprint $table) {
            $table->boolean('is_returned')->default(false);
            
        });

        Schema::table('urgent_invoices', function (Blueprint $table) {
            $table->boolean('is_returned')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('urgent_delivery_items', function (Blueprint $table) {
            $table->dropColumn('return_qty');
            $table->dropColumn('remaining_qty');
        });

         Schema::table('urgent_deliveries', function (Blueprint $table) {
            $table->dropColumn('is_returned');
        });

        Schema::table('urgent_invoices', function (Blueprint $table) {
            $table->dropColumn('is_returned');
        });
       
    }
};
