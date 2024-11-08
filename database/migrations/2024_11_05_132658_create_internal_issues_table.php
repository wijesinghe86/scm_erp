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
        Schema::create('internal_issues', function (Blueprint $table) {
            $table->id();
            $table->date('iid_date')->nullable();
            $table->string('iid_no')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('plant_id')->nullable();
            $table->string('justification')->nullable();
            $table->string('total_issued_qty')->nullable();
            $table->string('total_issued_weight')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
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
        Schema::dropIfExists('internal_issues');
    }
};
