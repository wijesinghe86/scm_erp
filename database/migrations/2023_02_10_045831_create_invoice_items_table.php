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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->unsignedBigInteger('item_id');
            $table->string('stock_no')->nullable();
            $table->string('description');
            $table->string('uom');
            $table->decimal('quantity',15,2)->default(0);
            $table->decimal('unit_price',15,2)->default(0);
            $table->decimal('item_discount_percentage', 18, 2)->default(0);
            $table->decimal('item_discount_amount', 15, 2)->default(0);
            $table->bigInteger('location_id');
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->string('status')->default('draft');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->softDeletes();
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
        Schema::dropIfExists('invoice_items');
    }
};
