<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('phone', 20)->nullable();
            $table->date('birth_date');
            $table->integer('age_months');
            $table->string('address')->nullable();
            $table->date('diagnosis_date');
            $table->foreignId('disease_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('belief_value', 5, 4)->default(0);
            $table->json('selected_symptoms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
