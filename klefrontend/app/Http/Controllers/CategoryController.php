<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(10);
        return view('category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'nullable',

        ]);
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status==true ? 1:0,

        ]);

        return redirect('/category')->with('status','Ürün Başarıyla Oluşturuldu.');
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'nullable',

        ]);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status==true ? 1:0,

        ]);

        return redirect('/category')->with('status','Ürün Başarıyla Güncellendi.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/category')->with('status','Ürün Başarıyla Silindi.');
    }
}
