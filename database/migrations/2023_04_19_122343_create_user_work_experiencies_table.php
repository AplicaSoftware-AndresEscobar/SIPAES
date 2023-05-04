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
        Schema::create('user_work_experiencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedMediumInteger('company_id');
            $table->string('job_title');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->unique(['user_id', 'company_id', 'job_title', 'start_date', 'end_date'], 'user_work_experiencies');

            $table->foreign('user_id', 'fk_usersuser_work_experiencies')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('company_id', 'fk_companies_user_work_experiencies')->references('id')->on('companies')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_work_experiencies');
    }
};
