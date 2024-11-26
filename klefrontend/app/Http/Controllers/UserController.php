<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    // Registration Method
    public function register(Request $request)
    {
        $response = Http::post('http://api_nginx/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Registration successful!');
        }

        return redirect()->back()->withErrors($response->json());
    }

    // Login Method
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Send login request to backend
        $response = Http::post('http://api_nginx/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
    
        // Debugging: Output response for testing
        // dd($response->json());
    
        // Check if login was successful
        if ($response->successful() && isset($response['token'])) {
            // Store token in session
            session([
                'api_token' => $response['token'],
            ]);
    
            return redirect()->route('product.index')->with('success', 'Giriş başarılı!');
        }
    
        // Handle login errors
        $errorMessage = $response->json('message') ?? 'Giriş başarısız.';
        return back()->withErrors(['login' => $errorMessage]);
    }
    
    

    // Logout Method
    public function logout()
    {
        // Send a logout request to the backend
        $response = Http::withToken(session('api_token'))->post('http://api_nginx/api/logout');
    
        // Clear session data
        session()->forget(['api_token', 'user_name']);
    
        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Başarıyla çıkış yapıldı.');
        }
    
        return redirect()->route('login')->withErrors(['logout' => 'Çıkış sırasında bir hata oluştu.']);
    }
    
}
