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
        Schema::create('user_academic_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedMediumInteger('educational_institute_id');
            $table->unsignedTinyInteger('academic_study_level_id');
            $table->string('degree');
            $table->year('year');
            $table->timestamps();

            $table->unique(['user_id', 'educational_institute_id', 'academic_study_level_id', 'degree', 'year'], 'unique_user_academic_studies');

            $table->foreign('user_id', 'fk_users_user_academic_studies')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('educational_institute_id', 'fk_educational_institutes_user_academic_studies')->references('id')->on('educational_institutes')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('academic_study_level_id', 'fk_academic_study_level_user_academic_studies')->references('id')->on('academic_study_levels')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_academic_studies');
    }
};
