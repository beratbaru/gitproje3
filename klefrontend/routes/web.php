<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckLogin;

// Resource Route for Products (handles all CRUD routes)
Route::resource('product', ProductController::class);

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// Alias for Product Index
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Home Route
Route::get('/', function () {
    return view('main');
});

// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login'); 
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware(CheckLogin::class);

// Register Routes
Route::get('/register', function () {
    return view('register');
})->name('register'); // Registration form

Route::post('/register', [UserController::class, 'register'])->name('register.submit'); // Registration submission

// Main Page (requires authentication)
Route::get('/main', function () {
    return view('main');
})->name('main')->middleware(CheckLogin::class);

// Test API Endpoint
Route::get('/apitest', [ProductController::class, 'apitest']);

// Logout Route
Route::post('/logout', function () {
    session()->forget('api_token');
    return redirect('/login')->with('success', 'Başarıyla çıkış yaptınız.');
})->name('logout');

Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('products/{id}', [ProductController::class, 'update'])->name('product.update');
//xd