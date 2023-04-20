<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_information', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id', false)->primary();
            $table->string('fullname');
            $table->unsignedTinyInteger('gender_id');
            $table->string('email_fesc')->nullable();
            $table->string('document');
            $table->unsignedSmallInteger('document_type_id');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('birthdate')->nullable();
            $table->unsignedInteger('birthday_place_id');
            $table->timestamps();

            $table->unique('email_fesc', 'unique_email_fesc_user_information');
            $table->unique('document', 'unique_document_user_information');
            $table->unique('phone', 'unique_phone_user_information');

            $table->foreign('user_id', 'fk_user_information')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('document_type_id', 'fk_document_types_user_information')->references('id')->on('document_types')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('birthday_place_id', 'fk_birthdate_place_user_information')->references('id')->on('cities')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('gender_id', 'fk_genders_user_information')->references('id')->on('genders')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_information');
    }
};
