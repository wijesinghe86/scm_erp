<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing_request_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_id')->nullable();
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->string('priority')->nullable();
            $table->decimal('prf_qty', 8,2)->nullable();
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
        Schema::dropIfExists('purchasing_request_items');
    }
};
