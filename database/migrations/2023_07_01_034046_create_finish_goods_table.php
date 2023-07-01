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
        Schema::create('finish_goods', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('fgrn_no')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->dateTime('pro_start_date_time')->nullable();
            $table->dateTime('pro_end_date_time')->nullable();
            $table->string('rmi_no')->nullable();
            $table->decimal('tot_issue_weight', 15, 2)->default(0);
            $table->decimal('tot_pro_qty', 15, 2)->default(0);
            $table->decimal('tot_pro_weight', 15, 2)->default(0);
            $table->decimal('tot_wastage', 15, 2)->default(0);
            $table->decimal('remaining_qty', 15, 2)->default(0);
            $table->string('status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('inspected_by')->nullable();
            $table->dateTime('inspected_at')->nullable();
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
        Schema::dropIfExists('finish_goods');
    }
};
