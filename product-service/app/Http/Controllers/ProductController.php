<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // GET all products
    public function index(Request $request)
    {
    $query = Product::query();

    // Search by name
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter by condition
    if ($request->has('condition')) {
        $query->where('condition', $request->condition);
    }

    // Filter by price
    if ($request->has('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->has('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    return response()->json(
        $query->orderBy('created_at', 'desc')->paginate(5)
    );
    }

    // GET product by ID
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    // CREATE product
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|in:like_new,good,fair,poor',
        'stock' => 'required|integer|min:0'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    $product = Product::create($validator->validated());

    return response()->json($product, 201);
}

    // UPDATE product
    public function update(Request $request, $id)
    {
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'sometimes|required|numeric|min:0',
        'condition' => 'sometimes|required|in:new,used',
        'stock' => 'sometimes|required|integer|min:0',
    ]);

    $product->update($validated);

    return response()->json($product);
    }

    // DELETE product
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
