<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $query = Product::query();

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(12);

        return view('results', compact('products'));
    }
    public function index()
    {
        //    نمایش صفحه مصحولات با دسته بندی ها
        $categories = Category::all();
        $products = Product::all();
        $comments = Comment::all();
        return view('products', compact('categories', 'products', 'comments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $file = $request->file('image');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/images', $fileName);
        $publicPath = Storage::url($path);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'category_id' => $request->category_id,
            'image_url' => $publicPath,
            'user_id' => Auth::id(),
        ]);

        return redirect('/my-products')->with('success', 'محصول با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comments = Comment::where('product_id', $id)->get();
        $product = Product::where('id', $id)->firstOrFail();
        $averageRating = $product->comments()->avg('rate') ?? 0;

        return view('showProduct', compact('product', 'comments', 'averageRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = auth()->user()->products()->where('id', $id)->firstOrFail();
        $categories = Category::all();

        return view('product-edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if (!empty($product->image_url)) {
                $oldImagePath = str_replace('/storage/', 'public/', $product->image_url);
                Storage::delete($oldImagePath);
            }
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/images', $fileName);

            $publicPath = Storage::url($path);

            $product->image_url = $publicPath;
        } else {
            $publicPath = $product->image_url;
        }
        if (!$request->hasFile('image')) {
            if (!$product->image_url) {
                return redirect()->back()->withErrors('لطفا یک تصویر اپلود کنید')->withInput();
            }
        }
        if (empty($request->discount)){
            $request->discount = 0;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'image_url' => $publicPath,
        ]);

        return redirect('/my-products')->with('success', '<UNK> <UNK> <UNK> <UNK> <UNK>.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $product = Product::findOrFail($id);
//        if ($product->image_url) {
//            $imagePath = str_replace('/storage/', 'public/', $product->image_url);
//            Storage::delete($imagePath);
//        }
        $product->delete();

        return redirect('/my-products')->with('با موفقیت حذف شد');

    }
}
