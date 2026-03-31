<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer',
        ]);

        $product = Product::create($validatedData);
        return response()->json(['message' => 'Producto creado exitosamente', 'data' => $validatedData], 201);
    }
}
