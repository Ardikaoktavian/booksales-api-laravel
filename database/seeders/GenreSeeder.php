<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
           'name' => 'Fiksi', 
           'description' => 'Genre yang mencakup cerita imajinatif yang tidak sepenuhnya berdasarkan kejadian nyata.', 
        ]);

        Genre::create([
           'name' => 'Pengembangan Diri', 
           'description' => 'Buku-buku yang bertujuan membantu seseorang meningkatkan kualitas hidup, baik dalam aspek mental, emosional, maupun profesional.', 
        ]);

        Genre::create([
           'name' => 'Komik', 
           'description' => 'Karya yang menggabungkan gambar dan teks untuk menceritakan kisah. ', 
        ]);

        Genre::create([
           'name' => 'Religi', 
           'description' => 'Genre yang berfokus pada ajaran, nilai, dan pandangan keagamaan serta spiritual, membantu pembaca memahami keyakinan dan praktik keagamaan. ', 
        ]);

        Genre::create([
           'name' => 'Ekonomi', 
           'description' => 'Buku yang membahas berbagai aspek ekonomi, dari teori hingga aplikasi praktis dalam bisnis, investasi, dan keuangan global. ', 
        ]);

    }
}
