<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('feedback') && !Schema::hasTable('feedbacks')) {
            Schema::rename('feedback', 'feedbacks');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('feedbacks') && !Schema::hasTable('feedback')) {
            Schema::rename('feedbacks', 'feedback');
        }
    }
};
