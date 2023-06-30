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
        Schema::create('raw_material_issue_items', function (Blueprint $table) {
            $table->id();
            $table->string('rmi_no')->nullable();
            $table->string('issued_item_no')->nullable();
            $table->string('semi_product_serial_no')->nullable();
            $table->decimal('semi_product_qty', 15, 2)->default(0);
            $table->decimal('semi_product_weight', 15, 2)->default(0);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('raw_material_issue_items');
    }
};
