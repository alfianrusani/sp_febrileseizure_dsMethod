<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treatment::create([
            'disease_id' => 1,
            'action_title' => 'Pantau Durasi Kejang',
            'description' => 'Hitung durasi kejang. Jika berhenti di bawah 5 menit dan anak kembali sadar, cukup pantau suhu tubuhnya.',
        ]);

        Treatment::create([
            'disease_id' => 2,
            'action_title' => 'Segera Bawa ke IGD',
            'description' => 'Jika kejang berlangsung lebih dari 15 menit atau anak tidak sadar setelah kejang, segera hubungi ambulans atau bawa ke IGD terdekat.',
        ]);
    }
}
