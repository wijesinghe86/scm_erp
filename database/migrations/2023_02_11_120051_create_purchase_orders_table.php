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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('pr_id')->nullable();
            $table->date('po_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->integer('po_type')->nullable();
            $table->decimal('weight_per_unit', 15,2)->nullable();
            $table->decimal('volume_per_unit', 15,2)->nullable();
            $table->decimal('total_weight', 15,2)->nullable();
            $table->decimal('total_volume', 15,2)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
};
