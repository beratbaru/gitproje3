<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
class ProductController extends Controller
{
    // Fetch all products
    public function index()
    {
        // Fetch products with headers and query parameters for pagination
        $response = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/products', request()->query());
    
        // Decode the API response
        $products = $response->json()['data'] ?? [];
        $paginationLinks = $response->json()['links'] ?? [];
        $meta = $response->json()['meta'] ?? [];
    
        // Extract metadata
        $currentPage = $meta['current_page'] ?? 1;
        $totalPages = $meta['total_pages'] ?? 1;
        $totalProducts = $meta['total_products'] ?? 0; // Assuming `total_products` is part of your meta
    
        // Pass the data to the Blade view
        return view('product.index', compact('products', 'paginationLinks', 'currentPage', 'totalPages', 'totalProducts'));
    }
    
    
    
    
    
    
    

    // Show the form to create a new product
    public function create()
    {
        return view('product.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->post(env('API_URL') . '/api/products', $request->all());

        if ($response->successful()) {
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        }

        return back()->withErrors($response->json()['errors'] ?? ['API error'])->withInput();
    }

    // Read (view) a single product's details (renders show.blade.php)
    public function show($id, Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->get(env('API_URL') . '/api/products/'. $id, $request->all());

        if ($response->successful()) {
            $product = $response->json()['data']; // Extract the "data" key
            return view('product.show', compact('product')); // Pass the product data to the view
        }
    
        return redirect()->route('product.index')->with('error', 'Ürün bilgisi alınamadı.'); // Handle API errors
    }
    
    

    // Update a product
    public function update(Request $request, $id)
    {
        
        // Validate the input fields
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0.1|max:99999999.99', // Allows up to 10 digits, 2 decimals
            'description' => 'required|string',
        ]);
    
        // Send a PUT request to update the product
        $response = Http::acceptJson()
            ->withHeaders([
                'Authorization' => session('api_token'), // Include the token for authorization
            ])
            ->put(env('API_URL') . '/api/products/' . $id, $validated); // Send validated data
    
        // Check if the response was successful
        if ($response->successful()) {
            return redirect()->route('product.index')->with('success', 'Ürün başarıyla güncellendi.');
        }
    
        // If the request failed, redirect with an error message
        return redirect()->route('product.index')->with('error', 'Ürün güncellenirken bir hata oluştu.');
    }
    
    public function edit($id, Request $request)
{
    // Send a GET request to fetch the product by ID
    $response = Http::acceptJson()
        ->withHeaders([
            'Authorization' => session('api_token'), // Include the token for authorization
        ])
        ->get(env('API_URL') . '/api/products/' . $id);

    // Check if the response is successful
    if ($response->successful()) {
        // Get the product data
        $product = $response->json()['data']; // The data comes under 'data' in the response
        return view('product.edit', compact('product')); // Return the edit view with the product data
    }

    // If the product fetch fails, redirect with an error message
    return redirect()->route('product.index')->with('error', 'Ürün bilgisi alınamadı.');
}


    // Delete a product
    public function destroy($id, Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->delete(env('API_URL') . '/api/products/'. $id, $request->all());

    
        if ($response->successful()) {
            return redirect()->route('product.index')->with('success', 'Ürün başarıyla silindi.');
        }
    
        return redirect()->route('product.index')->with('error', 'Ürün silinirken bir hata oluştu.');
    }
    
    
}
