<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            if (!Schema::hasColumn('feedbacks', 'diagnosis_id')) {
                $table->foreignId('diagnosis_id')->nullable()->after('id')->constrained('diagnoses')->nullOnDelete();
            }

            if (!Schema::hasColumn('feedbacks', 'patient_name')) {
                $table->string('patient_name')->after('diagnosis_id');
            }

            if (!Schema::hasColumn('feedbacks', 'rating')) {
                $table->tinyInteger('rating')->default(5)->after('patient_name');
            }

            if (!Schema::hasColumn('feedbacks', 'comments')) {
                $table->text('comments')->nullable()->after('rating');
            }
        });
    }

    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropForeign(['diagnosis_id']);
            $table->dropColumn(['diagnosis_id', 'patient_name', 'rating', 'comments']);
        });
    }
};
