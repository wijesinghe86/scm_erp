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
        Schema::create('df_approveds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('df_item_id')->nullable();
            $table->unsignedBigInteger('df_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->decimal('approved_qty', 8, 2)->nullable();
            $table->text('remark')->nullable();
            $table->string('action')->nullable();
            $table->unsignedBigInteger('df_created_user_id')->nullable();
            $table->unsignedBigInteger('approved_user_id')->nullable();
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
        Schema::dropIfExists('df_approveds');
    }
};
