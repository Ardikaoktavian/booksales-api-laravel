<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // Framework Laravel Pertemuan 1 & 2 & 3 - Migration dan Seeder
    public function index() {
        $books = Book::all();

        if ($books->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $books
        ], 200);
    }

    // Framework Laravel Pertemuan 4 - Read Create Data
    public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        // 2. Check validator error
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // 3. Upload image
        $image = $request->file('cover_photo');
        $image->store('books', 'public');
        
        // 4. Insert data
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ]);

        // 5. response
        return response()->json([
            "success" => true,
            "message" => "Resource added successfully!",
            "data" => $book
        ], 201);
    }

    // Framework Laravel pertemuan 5 - Show Update & Destroy Data
    public function show(string $id){   //show untuk menampilkan data berdasarkan id
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Resources not found!"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get detail Reource",
            "data" => $book
        ], 200);
    }

    public function update(string $id, Request $request){
        // 1. Mencari data
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Resources not found!"
            ], 404);
        }

        // 2. Validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // 3. Siapkan data yang ingin diupdate
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ];

        // 4. Handle image (upload & delete image)
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');
        
            if ($book->cover_photo) {
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            $data['cover_photo'] = $image->hashName();
        }


        // 5. Update data baru ke database
        $book->update($data);

        return response()->json([
            "success" => true,
            "message" => "Resource updated successfully!",
            "data" => $book
        ], 200);
    }

    public function destroy(string $id){   //destroy untuk menghapus data berdasarkan id
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Resources not found!"
            ], 404);
        }

        if ($book->cover_photo) {
            // delete from storage>public>books
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        return response()->json([
            "success" => true,
            "message" => "Delete resource successfully"
        ]);

        $book->delete();
    }
}
