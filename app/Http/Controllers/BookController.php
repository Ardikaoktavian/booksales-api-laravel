<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();

        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $books
        ], 200);

        // $data = new Book(); // Membuat objek
        // $books = $data->getBooks(); // Mengakses method getBooks

        // return view('books', ['books' => $books]); => ini pertemuan 2 menggunakan Migration & Seede 
    }
}
