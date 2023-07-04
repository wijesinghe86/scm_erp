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
        Schema::create('dispatch_items', function (Blueprint $table) {
            $table->id();
            $table->string('fgrn_no')->nullable();
            $table->string('fgrn_item_id')->nullable();
            $table->string('stock_item_id')->nullable();
            $table->string('dispatch_no')->nullable();
            $table->decimal('dispatch_qty', 15, 2)->default(0);
            $table->decimal('dispatch_weight', 15, 2)->default(0);
            $table->string('dispatch_from')->nullable();
            $table->string('dispatch_to')->nullable();
            $table->string('approve_by')->nullable();
            $table->dateTime('approve_at')->nullable();
            $table->string('approve_status')->nullable();
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
        Schema::dropIfExists('dispatch_items');
    }
};
