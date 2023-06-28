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
        Schema::create('raw_material_request_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('rmr_no')->nullable();
            $table->unsignedBigInteger('rmr_item_id')->nullable();
            $table->unsignedBigInteger('jo_order_id')->nullable();
            $table->unsignedBigInteger('jo_order_item_id')->nullable();
            $table->decimal('approved_qty', 15, 2)->default(0);
            $table->decimal('approved_weight', 15, 2)->default(0);
            $table->string('justification')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
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
        Schema::dropIfExists('raw_material_request_approvals');
    }
};
