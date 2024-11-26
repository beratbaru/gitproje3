<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login Method
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json([
                'message' => 'Kullanıcı bulunamadı.'
            ], 404);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Şifre eşleşmiyor.'
            ], 401);
        }
    
        $token = $user->createToken($user->name . '-Auth-Token')->plainTextToken;
    
        return response()->json([
            'message' => 'Giriş başarılı.',
            'token_type' => 'Bearer',
            'token' => 'Bearer '.$token
        ], 200);
    }
    

    // Registration Method
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            $token = $user->createToken($user->name . '-Auth-Token')->plainTextToken;

            return response()->json([
                'message' => 'Registration successful.',
                'token_type' => 'Bearer',
                'token' => $token
            ], 201);
        }

        return response()->json([
            'message' => 'Something went wrong during registration.',
        ], 500);
    }

    // Logout Method
    public function logout(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
    
        if ($user && $user->token()) {
            // Revoke the current token
            $user->token()->revoke();
            return response()->json(['message' => 'Logout successful'], 200);
        }
    
        return response()->json(['message' => 'Token invalid or user not authenticated'], 401);
    }
    

    // Profile Method
    public function profile(Request $request)
    {
        if ($request->user()) {
            return response()->json([
                'message' => 'Profile fetched successfully.',
                'data' => $request->user(),
            ], 200);
        }

        return response()->json([
            'message' => 'User not authenticated.',
        ], 401);
    }
}
