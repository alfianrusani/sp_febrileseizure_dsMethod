<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::create([
            'name' => 'RS Ibu dan Anak (RSIA) Permata Hati Makassar',
            'address' => 'Jl. Tamalanrea Raya Blok 10 M, Kec. Tamalanrea, Kota Makassar, Sulawesi Selatan 90245',
            'contact_number' => '0411-4774-085',
        ]);

        Hospital::create([
            'name' => 'Rumah Sakit Umum Daerah (RSUD) Daya Kota Makassar',
            'address' => 'Jl. Perintis Kemerdekaan Km. 14, Daya, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90243',
            'contact_number' => '0811-4440-1488',
        ]);
    }
}
