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
        Schema::create('internal_issue_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iid_id')->nullable();
            $table->string('stock_no')->nullable();
            $table->string('issue_qty')->nullable();
            $table->string('issue_weight')->nullable();
           

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
        Schema::dropIfExists('internal_issue_items');
    }
};
