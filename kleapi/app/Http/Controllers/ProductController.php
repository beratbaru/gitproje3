<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', [
            'products' => $products
        ]);
    }

    public function anotherPage()
    {
        return view('product.another_page');
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0|max:99999999.99',
        ]);

        if ($request->wantsJson()) {
            $product = Product::create($validatedData);
            return response()->json(['message' => 'Ürün Başarıyla Oluşturuldu', 'product' => $product], 201);
        }

        Product::create($validatedData);
        return redirect()->route('product.index')->with('status', 'Ürün başarıyla kaydedildi!');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:1',
        ]);
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'product_price' => $request->product_price,
        ]);

        return redirect('/product')->with('price','Ürün Başarıyla Güncellendi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/product')->with('price','Ürün Başarıyla Silindi.');
    }
    
}
