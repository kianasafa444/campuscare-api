<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        return response()->json(Category::all());
    }

    // Menambah kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category
        ], 201);
    }

    // Menampilkan satu kategori
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    // Mengubah kategori
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diupdate',
            'data' => $category
        ]);
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}