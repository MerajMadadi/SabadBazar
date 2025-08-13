<?php

namespace App\Http\Controllers;

use App\Models\Cart_Item;
use App\Models\Category;
use App\Models\Comment;
use App\Models\DeliveryCenters;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdditionalController extends Controller
{
    public function index()
    {
        $centers = DeliveryCenters::latest()->take(3)->get();
        $products = Product::where('discount', '>', 0)->orderby('discount', 'desc')->take(8)->get();
        $categories = Category::all();
        $comments = Comment::all();
//seller
        if (auth()->check() && auth()->user()->roles()->first()->name === 'فروشنده') {
            $total = Cart_Item::withTrashed()
                ->whereHas('product', function ($query) {
                    $query->withTrashed()->where('user_id', Auth::id());
                })
                ->whereNotNull('deleted_at') // فقط آیتم‌های حذف‌شده
                ->sum(DB::raw('price * quantity'));
            $products_count = Product::where('user_id', Auth::id())->count();
        } else {
            $total = null;
            $products_count = null;
        }


        return view('index', compact('products', 'categories', 'centers', 'comments', 'total', 'products_count'));
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function feq()
    {
        return view('feq');
    }

    public function page()
    {
        return view('page');
    }
}
