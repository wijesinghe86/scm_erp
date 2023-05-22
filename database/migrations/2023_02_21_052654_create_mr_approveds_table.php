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
        Schema::create('mr_approveds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mr_item_id')->nullable();
            $table->unsignedBigInteger('mr_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->decimal('qty', 8, 2)->nullable();
            $table->decimal('remaining_qty', 8, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('approved_for')->nullable();
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('requested_employee_id')->nullable();
            $table->unsignedBigInteger('created_user_id')->nullable();
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
        Schema::dropIfExists('mr_approveds');
    }
};
