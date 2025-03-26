<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
class ProductController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders(['Authorization' => session('api_token')])
            ->get(env('API_URL') . '/api/products', request()->query());
    
        $products = $response->json()['data'] ?? [];
        $paginationLinks = $response->json()['links'] ?? [];
        $meta = $response->json()['meta'] ?? [];
    
        $currentPage = $meta['current_page'] ?? 1;
        $totalPages = $meta['total_pages'] ?? 1;
        $totalProducts = $meta['total_products'] ?? 0; 
    
        return view('product.index', compact('products', 'paginationLinks', 'currentPage', 'totalPages', 'totalProducts'));
    }
     
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->post(env('API_URL') . '/api/products', $request->all());

        if ($response->successful()) {
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        }

        return back()->withErrors($response->json()['errors'] ?? ['API error'])->withInput();
    }

    public function show($id, Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->get(env('API_URL') . '/api/products/'. $id, $request->all());

        if ($response->successful()) {
            $product = $response->json()['data'];
            return view('product.show', compact('product'));
        }
    
        return redirect()->route('product.index')->with('error', 'Ürün bilgisi alınamadı.');
    }
    
    

    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0.1|max:99999999.99', 
            'description' => 'required|string',
        ]);
    
        $response = Http::acceptJson()
            ->withHeaders([
                'Authorization' => session('api_token'), 
            ])
            ->put(env('API_URL') . '/api/products/' . $id, $validated); 
    
        if ($response->successful()) {
            return redirect()->route('product.index')->with('success', 'Ürün başarıyla güncellendi.');
        }
    
        return redirect()->route('product.index')->with('error', 'Ürün güncellenirken bir hata oluştu.');
    }
    
    public function edit($id, Request $request)
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'Authorization' => session('api_token'),
            ])
            ->get(env('API_URL') . '/api/products/' . $id);

        if ($response->successful()) {
            $product = $response->json()['data']; 
            return view('product.edit', compact('product')); 
        }

        return redirect()->route('product.index')->with('error', 'Ürün bilgisi alınamadı.');
    }

    public function destroy($id, Request $request)
    {
        $response = Http::withHeaders(['Authorization'=>session('api_token')])->delete(env('API_URL') . '/api/products/'. $id, $request->all());

    
        if ($response->successful()) {
            return redirect()->route('product.index')->with('success', 'Ürün başarıyla silindi.');
        }
    
        return redirect()->route('product.index')->with('error', 'Ürün silinirken bir hata oluştu.');
    }
    
    
}
