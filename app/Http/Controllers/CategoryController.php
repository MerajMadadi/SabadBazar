<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $categories = Category::all();

        return view('products', compact('categories', 'id'));
    }
    public function store(CategoryCreateRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->back();
    }
    public function update(CategoryCreateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Product::where('category_id', $id)->delete();

        return redirect()->back()->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}
