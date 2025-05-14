<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        // سبد کاربر را بگیر یا ایجاد کن
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        // بررسی وجود محصول در سبد خرید از قبل
        $cart_item = Cart_Item::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cart_item) {
            // اگر تعداد کمتر از موجودی بود، افزایش بده
            if ($cart_item->quantity < $product->stock) {
                $cart_item->increment('quantity');
                return redirect()->route('cart.index')
                    ->with('success', 'تعداد محصول افزایش یافت.');
            } else {
                return redirect()->route('cart.index')
                    ->withErrors('موجودی این محصول کافی نیست.');
            }
        } else {
            if ($product->stock > 0) {
                Cart_Item::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);
                return redirect()->route('cart.index')
                    ->with('success', 'محصول به سبد اضافه شد.');
            } else {
                return redirect()->route('cart.index')
                    ->with('error', 'این محصول موجود نیست.');
            }
        }
    }

    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cart_items = Cart_Item::where('cart_id', $cart->id)->get();

        return view('cart', compact('cart_items'));
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
    public function store(Request $request)
    {
//
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $cartItem = Cart_Item::findOrFail($id);
        $cart = Cart::where('id', $cartItem->cart_id)->where('user_id', Auth::id())->firstOrFail();
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }
        return redirect()->route('cart.index');
    }
}
