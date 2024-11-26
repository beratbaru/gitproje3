<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Fetch all products
    public function index()
    {
        $products = Product::latest()->paginate(10);  // Paginate the products
        
        return response()->json([
            'message' => 'Products fetched successfully',
            'data' => $products->items(),  // Get the items for the current page
            'links' => [
                'previous' => $products->previousPageUrl(),
                'next' => $products->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'total_products' => $products->total(), // Total number of products
            ],
        ], 200);
    }
    
    
    
    

    // Store a new product
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'product_price' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $product = Product::create($request->only(['product_name', 'description', 'product_price']));

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    // Show a single product
    public function show($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        return response()->json([
            'message' => 'Product fetched successfully',
            'data' => $product,
        ]);
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        // Find the product by its ID
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['message' => 'Ürün bulunamadı.'], 404);
        }
    
        // Validate the incoming data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        // Update the product with the new data
        $product->update($validated);
    
        // Return success response
        return response()->json([
            'message' => 'Ürün başarıyla güncellendi.',
            'data' => $product,
        ], 200);
    }
    

    // Delete a product
// kleapi/app/Http/Controllers/Api/ProductController.php

public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Ürün bulunamadı.'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Ürün başarıyla silindi.'], 200);
}


}
