<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Blade dosyanızın adı
    }

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
    
}
