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
        Schema::create('mr_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('po_no')->nullable();
            $table->bigInteger('prf_id')->nullable();
            $table->date('po_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->integer('po_type')->nullable();
            $table->decimal('weight_per_unit', 8,2)->nullable();
            $table->decimal('volume_per_unit', 8,2)->nullable();
            $table->decimal('total_weight', 8,2)->nullable();
            $table->decimal('total_volume', 8,2)->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('edited_by')->nullable();
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
        Schema::dropIfExists('mr_purchases');
    }
};
