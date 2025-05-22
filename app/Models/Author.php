<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // Framework Laravel Pertemuan 1 & 2 & 3 - Migration dan Seeder
    protected $table = 'authors';

    // Framework Laravel Pertemuan 4 - Read Create Data
    protected $fillable = [
        'name'
    ];
}
