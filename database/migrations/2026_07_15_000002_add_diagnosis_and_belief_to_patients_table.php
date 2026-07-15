<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('patients')) {
            return;
        }

        Schema::table('patients', function (Blueprint $table) {
            if (!Schema::hasColumn('patients', 'phone')) {
                $table->string('phone')->nullable()->after('gender');
            }

            if (!Schema::hasColumn('patients', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }

            if (!Schema::hasColumn('patients', 'diagnosis')) {
                $table->string('diagnosis')->nullable()->after('address');
            }

            if (!Schema::hasColumn('patients', 'belief_value')) {
                $table->decimal('belief_value', 5, 4)->nullable()->after('diagnosis');
            }
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['diagnosis', 'belief_value']);
        });
    }
};
