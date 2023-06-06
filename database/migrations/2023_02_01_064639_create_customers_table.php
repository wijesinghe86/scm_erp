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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->unique();
            $table->string('customer_name')->nullable();
            $table->string('customer_vat_number')->nullable();
            $table->string('customer_svat_number')->nullable();
            $table->string('customer_address_line1')->nullable();
            $table->string('customer_address_line2')->nullable();
            $table->integer('customer_type_of_customer')->nullable();
            $table->string('customer_mobile_number')->nullable();
            $table->string('customer_fixed_phone_number')->nullable();
            $table->string('customer_email')->nullable();
            $table->integer('customer_payment_terms')->nullable;
            $table->decimal('customer_credit_limit', 15,2)->nullable();
            $table->integer('customer_credit_period')->nullable();
            $table->string('customer_contact_person_name')->nullable();
            $table->string('customer_contact_person_mobile_number')->nullable();
            $table->string('customer_contact_person_email')->nullable();
            $table->integer('customer_status')->nullable();
            $table->string('br_image')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->SoftDeletes();
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
        Schema::dropIfExists('customers');
    }
};
