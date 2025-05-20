<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::all();

        if ($genres->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $genres
        ], 200);

        // return view('genres', ['genres' => $genres]);  => ini pertemuan 2 menggunakan Migration & Seeder
    }

    public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        // 2. Check validator error
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // // 3. Upload image
        // $image = $request->file('cover_photo');
        // $image->store('books', 'public');
        
        // 4. Insert data
        $genres = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // 5. response
        return response()->json([
            "success" => true,
            "message" => "Resource added successfully!",
            "data" => $genres
        ], 201);

    }
}