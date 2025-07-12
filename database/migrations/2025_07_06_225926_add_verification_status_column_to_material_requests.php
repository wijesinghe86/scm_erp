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
        Schema::table('material_requests', function (Blueprint $table) {
            $table->string('verified_status')->default('pending');
            $table->string('verified_by')->nullable();
            $table->date('verified_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_requests', function (Blueprint $table) {
            $table->dropColumn('verified_status');
            $table->dropColumn('verified_by');
            $table->dropColumn('verified_date');
        });
    }
};
