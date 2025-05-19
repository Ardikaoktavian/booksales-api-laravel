<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    // private $books = [
    //     [
    //         'title' => 'Pulang',
    //         'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya',
    //         'price' => 40000,
    //         'stock' => 15,
    //         'cover_photo' => 'pulang.jpg',
    //         'genre_id' => 1,
    //         'author_id' => 1,
    //     ],
    //     [
    //         'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
    //         'description' => 'Buku yang membahas tentang kehidupan dan filosofi hidup seseorang',
    //         'price' => 25000,
    //         'stock' => 5,
    //         'cover_photo' => 'sebuah_seni.jpg',
    //         'genre_id' => 2,
    //         'author_id' => 2,
    //     ],
    //     [
    //         'title' => 'Naruto',
    //         'description' => 'Buku yang membahas tentang jalan ninja seseorang',
    //         'price' => 30000,
    //         'stock' => 25,
    //         'cover_photo' => 'naruto.jpg',
    //         'genre_id' => 3,
    //         'author_id' => 3,
    //     ],
    //     [
    //         'title' => 'Tuhan aku hampir menyerah',
    //         'description' => 'Buku yang membahas nilai-nilai kehidupan',
    //         'price' => 45000,
    //         'stock' => 15,
    //         'cover_photo' => 'tuhan_aku_hampir_menyerah.jpg',
    //         'genre_id' => 4,
    //         'author_id' => 4,
    //     ],
    //     [
    //         'title' => 'psychology of money',
    //         'description' => 'Buku yang membahas tentang psikologi uang',
    //         'price' => 55000,
    //         'stock' => 25,
    //         'cover_photo' => 'psychology_of_money.jpg',
    //         'genre_id' => 5,
    //         'author_id' => 5,
    //     ],
    // ];

    // public function getBooks() {
    //     return $this->books;
    // }
}