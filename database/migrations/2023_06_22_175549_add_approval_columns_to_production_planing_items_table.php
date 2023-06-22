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
        Schema::table('production_planing_items', function (Blueprint $table) {
            $table->unsignedBigInteger('approval_status_changed_by')->nullable();
            $table->dateTime('approval_status_changed_at')->nullable();
            $table->string('approval_status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_planing_items', function (Blueprint $table) {
            $table->dropColumn(['approval_status_changed_by', 'approval_status_changed_at', 'approval_status']);
        });
    }
};
