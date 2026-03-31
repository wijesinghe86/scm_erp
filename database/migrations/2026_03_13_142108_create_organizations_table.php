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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('organization_code')->unique();
            $table->string('organization_name')->nullable();
            $table->string('organization_tin_no')->nullable();
            $table->string('organization_address_line1')->nullable();
            $table->string('organization_address_line2')->nullable();
            $table->string('organization_phone_number')->nullable();
            $table->string('organization_whatsapp_number')->nullable();
            $table->string('organization_email')->nullable();
            $table->string('organization_contact_person_name')->nullable();
            $table->string('organization_contact_person_phone')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('organizations');
    }
};
