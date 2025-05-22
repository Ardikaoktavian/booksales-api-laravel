<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // Framework Laravel Pertemuan 1 & 2 & 3 - Migration dan Seeder
    public function index() {
        $authors = Author::all();

        if ($authors->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!"
            ], 404);
        }
        
        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $authors
        ], 200);
    }

    // Framework Laravel pertemuan 4 - Read Create Data
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

        // // 3. Upload image -> Author tidak menggunakan Image
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

    // Framework Laravel pertemuan 5 - Show Update & Destroy Data
    public function show(string $id){   //show untuk menampilkan data berdasarkan id
        $author = Author::find($id);

         if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Resources not found!"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get detail Reource",
            "data" => $author
        ], 200);
    }

    public function destroy(string $id){   //destroy untuk menghapus data berdasarkan id
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                "success" => false,
                "message" => "Resources not found!"
            ], 404);
        }

        $author->delete();

        return response()->json([
            "success" => true,
            "message" => "Delete resource successfully"
        ]);
        
    }
}