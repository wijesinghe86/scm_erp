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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_code')->unique();
            $table->string('supplier_name')->nullable();
            $table->string('business_registration_number')->nullable();
            $table->bigInteger('business_registration_image')->nullable();
            $table->integer('supplier_registration_type')->default(1);
            $table->string('supplier_vat_number')->nullable();
            $table->string('supplier_product_type')->nullable();
            $table->string('supplier_address_line1')->nullable();
            $table->string('supplier_address_line2')->nullable();
            $table->string('supplier_web_address')->nullable();
            $table->string('supplier_mobile_number')->nullable();
            $table->string('supplier_svat_number')->nullable();
            $table->string('supplier_fixedphone_number')->nullable();
            $table->string('supplier_email')->nullable();
            $table->integer('supplier_type')->default(1);
            $table->integer('supplier_status')->default(1);
            $table->string('supplier_contact_person_name')->nullable();
            $table->string('supplier_contact_person_designation')->nullable();
            $table->string('supplier_contact_person_mobile_number')->nullable();
            $table->string('supplier_contact_person_email')->nullable();
            $table->string('supplier_bank_name')->nullable();
            $table->string('supplier_bank_branch')->nullable();
            $table->string('supplier_bank_account_number')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('suppliers');
    }
};
