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
        Schema::create('goods_issue_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issued_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('stock_no')->nullable();
            $table->decimal('iss_qty',15,2)->default(0);
            $table->decimal('iss_weight',15,2)->default(0);
            $table->unsignedBigInteger('location_id')->nullable();
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
        Schema::dropIfExists('goods_issue_items');
    }
};
