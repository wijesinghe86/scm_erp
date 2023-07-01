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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('dispatch_no')->nullable();
            $table->string('fgrn_no')->nullable();
            $table->decimal('tot_no_dispatch_items', 15, 2)->default(0);
            $table->decimal('tot_no_dispatch_qty', 15, 2)->default(0);
            $table->decimal('tot_no_dispatch_weight', 15, 2)->default(0);
            $table->string('fleet_id')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('dispatched_by')->nullable();
            $table->dateTime('dispatched_at')->nullable();
            $table->string('dispatched_remark')->nullable();
            $table->string('inspected_by')->nullable();
            $table->dateTime('inspected_at')->nullable();
            $table->string('inspected_remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatches');
    }
};
