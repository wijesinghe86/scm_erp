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
        Schema::create('raw_material_serial_codes', function (Blueprint $table) {
            $table->id();
            $table->string('stock_item_id')->nullable();
            $table->date('entry_date')->nullable();
            $table->unsignedBigInteger('grn_id')->nullable();
            $table->unsignedBigInteger('grn_item_id')->nullable();
            $table->string('serial_no')->nullable();
            $table->decimal('qty', 8,2)->nullable();
            $table->string('supplier_code')->nullable();
            $table->unsignedBigInteger('warehouse_code')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('raw_material_serial_codes');
    }
};
