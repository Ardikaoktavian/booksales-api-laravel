<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    // Framework Laravel Pertemuan 1 & 2 & 3 - Migration dan Seeder
    // Framework Laravel Pertemuan 7 - Bussiness Process
    public function index() {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all resource",
            "data" => $transactions
        ], 200);
    }

    public function store(Request $request) {
        // 1. Validator  & Cek Validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "data" => $validator->errors()
            ], 422);
        }

        // 2. Generate orderNumber -> unique | ORD-0003
        $uniqueCode = "ORD-" . strtoupper(uniqid());

        // 3. Ambil User yang sedang login & cek login (apakah ada data user?)
        $user = auth('api')->user();
        
        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized!"
            ], 401);
        }

        // 4. Mencari data buku dari request
        $book = Book::find($request->book_id);

        // 5. Cek stok buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                "success" => false,
                "message" => "Stock Barang Tidak Cukup!",
            ], 400);
        };

        // 6. Hitung total harga = price * quantity
        $totalAmount = $book->price * $request->quantity;

        // 7. Kurangi stok buku (update data buku)
        $book->stock -= $request->quantity;
        $book->save();

        // 8. Simpan data transaction
        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            "success" => true,
            "message" => "Transaction Created Successfully!",
            "data" => $transactions
        ], 201);
    }

    public function show($id)
    {
        $transactions = Transaction::find($id);

        if (!$transactions) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found"
            ], 404);
        }

        // Cek apakah user adalah pemilik transaksi
        if (auth('api')->id() != $transactions->customer_id) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized access to transactions"
            ], 403);
        }

        return response()->json([
            "success" => true,
            "message" => "Get detail resource",
            "data" => $transactions
        ], 200);
    }

    public function update(Request $request, $id) // Belum fixx!!!!!
    {
        // 1. Mencari data
        $transactions = Transaction::find($id);

        if (!$transactions) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found"
            ], 404);
        }

        // 2. Cek apakah user adalah pemilik transaksi
        if (auth('api')->id() != $transactions->customer_id) {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized access to transactions"
            ], 403);
        }

        // 3. Validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // 4. Siapkan data yang ingin diupdate
        $data = [
            'book_id' => $request->book_id,
            'quantity' => $request->quantity
        ];

        // 5. Update data baru ke database
        $transactions->update($data);

        return response()->json([
            "success" => true,
            "message" => "Transaction updated successfully!",
            "data" => $transactions
        ], 200);
    }

    public function destroy($id)
    {
        $transactions = Transaction::find($id);

        if (!$transactions) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found"
            ], 404);
        }

        // Tidak perlu cek role karena sudah dihandle middleware admin
        $transactions->delete();

        return response()->json([
            "success" => true,
            "message" => "Transaction deleted"
        ], 200);
    }
}
