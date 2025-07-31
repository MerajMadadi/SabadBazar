<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\DeliveryCenters;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class CommentController extends Controller
{

//    ارسال میانگین امتیاز به index اصلی سایت
    public function index()
    {
        $centers = DeliveryCenters::latest()->take(3)->get();
        $products = Product::where('discount', '>', 0)->orderby('discount', 'desc')->take(8)->get();
        $categories = Category::all();
        $comments = Comment::all();

        return view('index', compact('products', 'categories', 'centers', 'comments'));
    }

    public function store(CommentRequest $request, Product $product)
    {
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'content' => $request->comment,
            'rate' => $request->rating
        ]);

        return redirect('/product/show/' . $product->id . '#comments');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function delete(string $id)
    {
//
    }
}
