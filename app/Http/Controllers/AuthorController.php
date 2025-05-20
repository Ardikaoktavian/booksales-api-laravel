<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();

        if ($authors->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!"
            ], 200);
        }
        
        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $authors
        ],);

        // $data = new Author();
        // $authors = $data->getAuthors();

        // return view('authors', ['authors' => $authors]); => ini pertemuan 2 menggunakan Migration & Seede
    }

        public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
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
        $author = Author::create([
            'name' => $request->name,
        ]);

        // 5. response
        return response()->json([
            "success" => true,
            "message" => "Resource added successfully!",
            "data" => $author
        ], 201);
    }
}
