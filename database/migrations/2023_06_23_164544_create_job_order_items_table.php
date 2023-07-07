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
        Schema::create('job_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_order_id')->nullable();
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->decimal('jo_qty', 15, 2)->default(0);
            $table->unsignedBigInteger('approval_status_changed_by')->nullable();
            $table->dateTime('approval_status_changed_at')->nullable();
            $table->string('approval_status')->default('pending');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('pps_no')->nullable();
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
        Schema::dropIfExists('job_order_items');
    }
};
