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
        Schema::create('departments', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->unsignedSmallInteger('country_id');
            $table->string('name');
            $table->timestamps();

            $table->unique(['country_id', 'name'], 'unique_name_departments');
            $table->foreign('country_id', 'fk_countries_departments')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
