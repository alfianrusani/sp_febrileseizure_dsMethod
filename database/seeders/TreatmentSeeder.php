<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'disease_code' => 'P1',
                'action_title' => 'Pertolongan Pertama',
                'first_step_handling' => 'Baringkan anak di tempat yang aman, miringkan tubuhnya agar jalan napas tetap terbuka, dan pantau durasi kejang. Jika kejang berhenti dalam waktu singkat dan anak kembali sadar, segera cek suhu dan pantau kondisinya.',
                'medicine' => 'Pemberian obat untuk meredakan gejala biasanya dilakukan sesuai instruksi dokter, misalnya obat penurun panas jika suhu tinggi dan obat antikonvulsan jika gejala kambuh secara berulang.',
            ],
            [
                'disease_code' => 'P2',
                'action_title' => 'Pertolongan Pertama',
                'first_step_handling' => 'Jaga anak tetap aman, jangan memasukkan benda ke mulut, baringkan dengan posisi miring, dan segera bawa ke rumah sakit atau IGD jika kejang berlangsung lebih dari 5 menit, anak tidak sadar, atau ada kesulitan bernapas.',
                'medicine' => 'Obat penanganan harus diberikan sesuai petunjuk tenaga medis, biasanya berupa obat antikonvulsan darurat dan obat penurun panas/antiinflamasi jika disertai demam tinggi.',
            ],
        ];

        foreach ($items as $item) {
            $disease = Disease::query()->where('code', $item['disease_code'])->first();

            if (! $disease) {
                continue;
            }

            Treatment::updateOrCreate(
                [
                    'disease_id' => $disease->id,
                    'action_title' => $item['action_title'],
                ],
                [
                    'first_step_handling' => $item['first_step_handling'],
                    'medicine' => $item['medicine'],
                ]
            );
        }
    }
}
