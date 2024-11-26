<?php


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::resource('product', ProductController::class);




Route::get('login', [LoginController::class, 'showLoginForm'])->name('login'); // Giriş sayfası
Route::post('login', [LoginController::class, 'login'])->name('login.submit'); // Giriş işlemi

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'register'])->name('register');




use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Başarıyla çıkış yaptınız.');
})->name('logout');
