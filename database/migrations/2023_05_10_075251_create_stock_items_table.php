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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->string('stock_number')->unique();
            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->string('cost_price')->nullable();
            $table->string('barcode')->nullable();
            $table->string('keyword')->nullable();
            $table->string('group')->nullable();
            $table->string('class')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('part_number')->nullable();
            $table->string('model')->nullable();
            $table->string('make')->nullable();
            $table->decimal('minimum_qty', 6,2)->nullable();
            $table->decimal('maximum_qty', 6,2)->nullable();
            $table->decimal('re_order_level', 6,2)->nullable();
            $table->string('substitute_stock_number')->nullable();
            $table->bigInteger('enduser')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->string('stock_item_Grade')->nullable();
            $table->string('stock_item_chem_c')->nullable();
            $table->string('stock_item_chem_mn')->nullable();
            $table->string('stock_item_mech_ys')->nullable();
            $table->string('stock_item_mech_ts')->nullable();
            $table->string('stock_item_mech_ei')->nullable();
            $table->decimal('stock_item_physical_weight', 8,2)->nullable();
            $table->string('stock_item_physical_width', 8,2)->nullable();
            $table->string('stock_item_physical_thickness', 8,2)->nullable();
            $table->date('stock_item_date_of_mfr')->nullable();
            $table->date('stock_item_date_of_expiry')->nullable();
            $table->text('stock_item_special_ins')->nullable();
            $table->text('stock_item_storage_method')->nullable();
            $table->text('stock_item_handling_method')->nullable();
            $table->integer('stock_item_inspection_reuired')->default(1);
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->integer('stock_items_status')->default(1);
            $table->SoftDeletes();
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
        Schema::dropIfExists('stock_items');
    }
};
