<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        return Product::all(); 
    }

    // Menampilkan satu produk berdasarkan ID
    public function show($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        // Membuat produk baru
        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
        ]);

        // Mengembalikan response berhasil
        return response()->json(['message' => 'Product created!', 'product' => $product], 201);
    }

    public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();
    return response()->json(['message' => 'Product deleted successfully'], 200);
}
}
