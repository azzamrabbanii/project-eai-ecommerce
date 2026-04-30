<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    private $productServiceUrl = 'http://127.0.0.1:8002';
    private $userServiceUrl    = 'http://127.0.0.1:8001';

    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|integer',
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        $userResponse = Http::get("{$this->userServiceUrl}/api/users/{$request->user_id}");
        if ($userResponse->failed()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $productResponse = Http::get("{$this->productServiceUrl}/api/products/{$request->product_id}");
        if ($productResponse->failed()) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product = $productResponse->json();

        if ($product['stock'] < $request->quantity) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        $totalPrice = $product['price'] * $request->quantity;

        $order = Order::create([
            'user_id'     => $request->user_id,
            'product_id'  => $request->product_id,
            'quantity'    => $request->quantity,
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        Http::patch("{$this->productServiceUrl}/api/products/{$request->product_id}/stock", [
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'data'    => $order,
        ], 201);
    }

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
