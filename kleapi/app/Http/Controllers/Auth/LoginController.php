<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Blade dosyanızın adı
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('product.index')->with('success', 'Giriş başarılı');
    }

    return back()->withErrors([
        'email' => 'Girdiğiniz bilgiler hatalı.',
    ]);
    }
}
