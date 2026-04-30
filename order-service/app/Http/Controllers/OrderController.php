<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    private $productServiceUrl = 'http://localhost:8001';
    private $userServiceUrl    = 'http://localhost:8002';

    /**
     * POST /api/orders
     * Checkout — integrates with Product Service & User Service
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|integer',
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        // --- 1. Validate user exists (User Service) ---
        $userResponse = Http::get("{$this->userServiceUrl}/api/users/{$request->user_id}");
        if ($userResponse->failed()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // --- 2. Check product & stock (Product Service) ---
        $productResponse = Http::get("{$this->productServiceUrl}/api/products/{$request->product_id}");
        if ($productResponse->failed()) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product = $productResponse->json();

        if ($product['stock'] < $request->quantity) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        // --- 3. Create the order ---
        $totalPrice = $product['price'] * $request->quantity;

        $order = Order::create([
            'user_id'     => $request->user_id,
            'product_id'  => $request->product_id,
            'quantity'    => $request->quantity,
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        // --- 4. Reduce stock (Product Service) ---
        Http::patch("{$this->productServiceUrl}/api/products/{$request->product_id}/stock", [
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'data'    => $order,
        ], 201);
    }

    /**
     * GET /api/orders/history/{user_id}
     * Get all orders for a user
     */
    public function history($user_id)
    {
        $orders = Order::where('user_id', $user_id)->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

        return response()->json([
            'message' => 'Order history retrieved',
            'data'    => $orders,
        ]);
    }

    /**
     * PUT /api/orders/{id}/status
     * Update payment status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Order status updated',
            'data'    => $order,
        ]);
    }
}