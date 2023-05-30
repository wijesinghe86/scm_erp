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
        Schema::table('demand_forecastings', function (Blueprint $table) {
            $table->unsignedBigInteger('requested_by')->nullabe();
            $table->date('required_date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demand_forecastings', function (Blueprint $table) {
            $table->dropColumn('requested_by');
            $table->dropColumn('required_date');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');

        });
    }
};
