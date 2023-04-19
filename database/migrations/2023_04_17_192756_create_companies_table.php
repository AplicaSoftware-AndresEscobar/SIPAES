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
        Schema::create('companies', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('nit')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();

            $table->unique('name', 'unique_name_companies');
            $table->unique('email', 'unique_email_companies');
            $table->unique('nit', 'unique_nit_companies');
            $table->unique('phone', 'unique_phone_companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
