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
        Schema::create('goods_receiveds', function (Blueprint $table) {
            $table->id();
            $table->string('grn_no')->nullable();
            $table->date('grn_date')->nullabe();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('received_by')->nullable();
            $table->date('received_date')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->date('verified_date')->nullable();
            $table->unsignedBigInteger('inspected_by')->nullable();
            $table->date('inspected_date')->nullable();
            $table->decimal('per_weight')->nullable();
            $table->decimal('tot_weight')->nullable();
            $table->decimal('per_volume')->nullable();
            $table->decimal('tot_volume')->nullable();
            $table->unsignedBigInteger('po_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('warehouse')->nullable();
            $table->unsignedBigInteger('created_by')->nullable;
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
        Schema::dropIfExists('goods_receiveds');
    }
};
