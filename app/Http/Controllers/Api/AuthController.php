<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rental_number' => 'required|string|unique:users',
            'phone' => 'nullable|string',
            'province' => 'nullable|string',
            'commune' => 'nullable|string',
            'workplace' => 'nullable|string',
            'job_title' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rental_number' => $request->rental_number,
            'phone' => $request->phone,
            'province' => $request->province,
            'commune' => $request->commune,
            'workplace' => $request->workplace,
            'job_title' => $request->job_title,
            'is_active' => false, // Default to inactive until approved
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'rental_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('rental_number', $request->rental_number)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'rental_number' => ['بيانات الاعتماد المقدمة غير صحيحة.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
