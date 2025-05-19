<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::all();

        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $genres
        ], 200);
        // return view('genres', ['genres' => $genres]);  => ini pertemuan 2 menggunakan Migration & Seeder
    }
}