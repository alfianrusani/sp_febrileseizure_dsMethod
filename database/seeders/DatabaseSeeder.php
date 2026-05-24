<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\KnowledgeBase;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // ── Diseases ─────────────────────────────────────────────────────────
        $p1 = Disease::create([
            'code'        => 'P1',
            'name'        => 'Kejang Demam Sederhana',
            'description' => 'Kejang demam sederhana berlangsung kurang dari 15 menit, bersifat menyeluruh (generalized), tidak berulang dalam periode 24 jam, dan tidak meninggalkan gejala sisa.',
            'treatment'   => "Penanganan Pertama:\n"
                           . "• Tetap tenang dan jangan panik.\n"
                           . "• Baringkan anak miring untuk mencegah tersedak.\n"
                           . "• Jangan masukkan benda apa pun ke dalam mulut anak.\n"
                           . "• Pastikan kejang berlangsung (jika lebih dari 5 menit, segera ke rumah sakit).\n"
                           . "• Longgarkan pakaian ketat, bukan ketat.\n"
                           . "• Catat waktu kejang berlangsung, bukan saat mulai.\n\n"
                           . "Obat & Penanganan:\n"
                           . "• Parasetamol sirup PCT (10-15 mg/kg) tiap 4-6 jam.\n"
                           . "• Ibuprofen 5-10 mg/kg (jika demam tinggi).\n"
                           . "• Diazepam rektal 5 mg (anak < 10 kg) / 10 mg (anak > 10 kg).\n"
                           . "• Fenobarbital injeksi 1 mg/2 jam.\n"
                           . "• Fenitoin injeksi 10 mg/12 jam.\n"
                           . "• Clobazam tablet 0,1 mg/hari.\n"
                           . "• Clonazepam 0,05 mg/kg 12 jam.\n"
                           . "• Zinc 10 mg/hari.\n"
                           . "• Gentamicin 2,5 mg/hari (jika ada infeksi bakteri).\n"
                           . "• Infus NaCl 0,9 ml/kgbb/hari (jika dehidrasi).",
        ]);

        $p2 = Disease::create([
            'code'        => 'P2',
            'name'        => 'Kejang Demam Kompleks',
            'description' => 'Kejang demam kompleks berlangsung lebih dari 15 menit, dapat terjadi lebih dari satu kali dalam 24 jam, atau bersifat fokal dengan hanya melibatkan salah satu sisi tubuh, sehingga sering memerlukan pemeriksaan lanjutan.',
            'treatment'   => "Penanganan Pertama:\n"
                           . "• Segera hubungi tenaga medis atau bawa ke IGD rumah sakit.\n"
                           . "• Catat durasi dan karakteristik kejang.\n"
                           . "• Hindari memasukkan benda ke dalam mulut anak.\n"
                           . "• Posisikan anak miring agar tidak tersedak.\n\n"
                           . "Obat & Penanganan:\n"
                           . "• Diazepam IV 0,2-0,5 mg/kg (maks 10 mg) — hentikan kejang segera.\n"
                           . "• Fenobarbital IV 15-20 mg/kg loading dose.\n"
                           . "• Fenitoin IV 15-20 mg/kg loading dose (jika fenobarbital gagal).\n"
                           . "• Midazolam buccal/intranasal sebagai alternatif.\n"
                           . "• Pemeriksaan EEG dan MRI untuk identifikasi kelainan neurologis.\n"
                           . "• Rawat inap untuk observasi dan terapi lanjutan.\n"
                           . "• Antibiotik jika terdapat infeksi bakterial yang memicu demam.",
        ]);

        // ── Symptoms ─────────────────────────────────────────────────────────
        $symptoms = [
            ['G01', 'Demam ringan berulang',                         0.2],
            ['G02', 'Batuk berat',                                   0.4],
            ['G03', 'Flu',                                           0.3],
            ['G04', 'Kejang berlangsung singkat (<15 menit)',         0.6],
            ['G05', 'Mual saat demam',                               0.5],
            ['G06', 'Mencret',                                       0.5],
            ['G07', 'Ruam di kulit',                                 0.3],
            ['G08', 'Nyeri tenggorokan',                             0.4],
            ['G09', 'Pilek yang menetap',                            0.5],
            ['G10', 'Kehilangan kesadaran lebih lama setelah kejang',0.9],
            ['G11', 'BAB cair',                                      0.6],
            ['G12', 'Mimisan',                                       0.6],
            ['G13', 'Gusi berdarah',                                 0.5],
            ['G14', 'Kejang berlangsung lama (>15 menit)',            0.9],
            ['G15', 'Demam naik-turun',                              0.7],
            ['G16', 'Demam tinggi seharian',                         0.8],
            ['G17', 'Perut kembung',                                 0.7],
            ['G18', 'Pasien langsung sadar setelah kejang dan lemas',0.5],
            ['G19', 'Nafsu makan menurun',                           0.7],
            ['G20', 'Kehijauan pada feses',                          0.8],
            ['G21', 'Sesak nafas ringan saat demam tinggi',          0.8],
            ['G22', 'Muntah setelah demam',                          0.7],
        ];

        $symptomModels = [];
        foreach ($symptoms as [$code, $name, $density]) {
            $symptomModels[$code] = Symptom::create([
                'code'    => $code,
                'name'    => $name,
                'density' => $density,
            ]);
        }

        // ── Knowledge Base (P1 symptoms) ─────────────────────────────────────
        $p1Symptoms = ['G01','G02','G03','G04','G05','G06','G07','G08','G09','G11','G12','G13','G18','G22'];
        foreach ($p1Symptoms as $code) {
            KnowledgeBase::create([
                'disease_id'  => $p1->id,
                'symptom_id'  => $symptomModels[$code]->id,
            ]);
        }

        // ── Knowledge Base (P2 symptoms) ─────────────────────────────────────
        $p2Symptoms = ['G02','G05','G06','G09','G10','G14','G15','G16','G17','G19','G20','G21','G22'];
        foreach ($p2Symptoms as $code) {
            KnowledgeBase::create([
                'disease_id'  => $p2->id,
                'symptom_id'  => $symptomModels[$code]->id,
            ]);
        }
    }
}
