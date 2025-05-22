<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Framework Laravel Pertemuan 1 & 2 & 3 - Migration dan Seeder
    protected $table = 'books';

    // Framework Laravel Pertemuan 4 - Read Create Data
    protected $fillable = [
        'title', 'description', 'price', 'stock', 'cover_photo', 'genre_id', 'author_id'
    ];
}