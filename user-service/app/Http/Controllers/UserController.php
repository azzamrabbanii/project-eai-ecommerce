<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get the authenticated user's profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = Auth::user();
        
        return response()->json([
            'message' => 'User profile retrieved successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . ($user ? $user->id : ''),
        ]);

        if ($user) {
            $user->update($validatedData);
            
            return response()->json([
                'message' => 'Profile updated successfully',
                'data' => $user
            ], 200);
        }

        return response()->json([
            'message' => 'User not found or unauthenticated'
        ], 404);
    }
}
