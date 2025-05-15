<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
           'name' => 'Tere Liye', 
        ]);

        Author::create([
           'name' => 'Mark Manson', 
        ]);

        Author::create([
           'name' => 'Masashi Kishimoto', 
        ]);

        Author::create([
           'name' => 'Alfian M.', 
        ]);

        Author::create([
           'name' => 'Morgan Housel', 
        ]);
    }
}
