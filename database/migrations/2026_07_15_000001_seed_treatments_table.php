<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('treatments')) {
            return;
        }

        $existing = DB::table('treatments')->count();
        if ($existing > 0) {
            return;
        }

        $p1 = DB::table('diseases')->where('code', 'P1')->value('id');
        $p2 = DB::table('diseases')->where('code', 'P2')->value('id');

        $rows = [];

        if ($p1) {
            $rows[] = [
                'disease_id' => $p1,
                'action_title' => 'Pertolongan Pertama',
                'first_step_handling' => 'Baringkan anak di tempat yang aman, miringkan tubuhnya agar jalan napas tetap terbuka, dan pantau durasi kejang. Jika kejang berhenti dalam waktu singkat dan anak kembali sadar, segera cek suhu dan pantau kondisinya.',
                'medicine' => 'Pemberian obat untuk meredakan gejala biasanya dilakukan sesuai instruksi dokter, misalnya obat penurun panas jika suhu tinggi dan obat antikonvulsan jika gejala kambuh secara berulang.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if ($p2) {
            $rows[] = [
                'disease_id' => $p2,
                'action_title' => 'Pertolongan Pertama',
                'first_step_handling' => 'Jaga anak tetap aman, jangan memasukkan benda ke mulut, baringkan dengan posisi miring, dan segera bawa ke rumah sakit atau IGD jika kejang berlangsung lebih dari 5 menit, anak tidak sadar, atau ada kesulitan bernapas.',
                'medicine' => 'Obat penanganan harus diberikan sesuai petunjuk tenaga medis, biasanya berupa obat antikonvulsan darurat dan obat penurun panas/antiinflamasi jika disertai demam tinggi.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($rows)) {
            DB::table('treatments')->insert($rows);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op to avoid removing seeded data unexpectedly.
    }
};
