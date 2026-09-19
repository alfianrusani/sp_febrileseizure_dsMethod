<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'Pertolongan Pertama Saat Anak Kejang Demam',
            'slug' => 'pertolongan-pertama-saat-anak-kejang-demam',
            'content' => 'Jangan panik. Baringkan anak di tempat yang aman dan miringkan tubuhnya agar jalan napas tetap terbuka. Longgarkan pakaian, terutama di area leher.',
        ]);

        Article::create([
            'title' => 'Mitos dan Fakta Seputar Kejang Demam',
            'slug' => 'mitos-dan-fakta-seputar-kejang-demam',
            'content' => 'Banyak yang mengira memasukkan sendok ke mulut anak saat kejang adalah hal yang benar. Faktanya, ini sangat berbahaya dan bisa merusak gigi atau menyumbat jalan napas.',
        ]);
    }
}
