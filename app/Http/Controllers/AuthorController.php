<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();
        
        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $authors
        ], 200);

        // $data = new Author();
        // $authors = $data->getAuthors();

        // return view('authors', ['authors' => $authors]); => ini pertemuan 2 menggunakan Migration & Seede
    }
}
