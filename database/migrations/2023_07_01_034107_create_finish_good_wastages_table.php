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
        Schema::create('finish_good_wastages', function (Blueprint $table) {
            $table->id();
            $table->string('fgrn_no')->nullable();
            $table->string('rmi_no')->nullable();
            $table->string('wastage_description')->nullable();
            $table->string('wastage_stock_number')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->decimal('qty', 15, 2)->default(0);
            $table->decimal('weight', 15, 2)->default(0);
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
        Schema::dropIfExists('finish_good_wastages');
    }
};
