<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // Framework Laravel Pertemuan 1 & 2 & 3 - Migration dan Seeder
    protected $table = 'genres';

    // Framework Laravel Pertemuan 4 - Read Create Data
    protected $fillable = [
        'name', 'description'
    ];
}