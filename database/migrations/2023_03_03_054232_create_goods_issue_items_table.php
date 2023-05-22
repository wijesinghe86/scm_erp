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
            $table->string('issued_number');
            $table->bigInteger('item_id');
            $table->string('stock_no');
            $table->string('description');
            $table->string('uom');
            $table->decimal('iss_qty',15,2)->default(0);
            $table->decimal('iss_weight',15,2)->default(0);
            $table->bigInteger('location_id');
            $table->foreignId('created_by')->constrained('users');
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
