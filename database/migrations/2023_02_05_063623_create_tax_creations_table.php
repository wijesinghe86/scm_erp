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
        Schema::create('tax_creations', function (Blueprint $table) {
            $table->id();
            $table->string('tax_code')->unique();
            $table->string('tax_name')->nullable();;
            $table->decimal('tax_rate',8,2)->nullable();;
            $table->string('tax_description')->nullable();
            $table->date('start_date')->nullable();;
            $table->date('expire_date')->nullable();;
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('tax_creation_status')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tax_creations');
    }
};
