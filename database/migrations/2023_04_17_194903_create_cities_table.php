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
        Schema::create('cities', function (Blueprint $table) {
            $table->unsignedInteger('id', true);
            $table->unsignedMediumInteger('department_id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();

            $table->unique(['department_id', 'name'], 'unique_name_cities');
            $table->unique(['department_id', 'slug'], 'unique_slug_cities');
            $table->foreign('department_id', 'fk_departments_cities')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
