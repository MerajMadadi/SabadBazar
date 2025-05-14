<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function showForm()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cart_items = Cart_Item::where('cart_id', $cart->id)->get();
        $total = $cart_items->sum(fn($item) => ($item->product->price - ($item->product->price * $item->product->discount / 100))
            * $item->quantity);


        return view('pay-form', compact('cart', 'cart_items', 'total'));
    }

    public function process(TransactionRequest $request)
    {
//        گرفتن سبد خرید
        $cart = Cart::where('user_id', Auth::id())->first();
//        گرفتن ایتم های سبد خرید
        $cart_items = Cart_Item::where('cart_id', $cart->id)->get();
//        محاسبه مبلغ کل بعد از تخفیف ها
        $total = $cart_items->sum(fn($item) => ($item->product->price - ($item->product->price * $item->product->discount / 100))
            * $item->quantity);
// ساخت کد تراکنش
        $transactionCode = strtoupper(Str::random(12));

// ذخیره در دیتابیس
        $transaction = Transaction::create([
            'transaction_code' => $transactionCode,
            'amount' => $total,
            'cart_id' => $cart->id,
            'user_id' => Auth::id(),
            'card_number' => $request->card_number,
            'paid_at' => now(),
            'created_at' => now()
        ]);
        if (!$transaction) {
            return redirect()->back()->withErrors("متاسفانه پرداخت با مشکل مواجه شده است");
        }
//        کم کردن موجودی محصولات خریداری شده
        foreach ($cart_items as $item) {
            $product = $item->product;
            $newStock = max(0, $product->stock - $item->quantity); // جلوگیری از منفی شدن
            $product->update([
                'stock' => $newStock,
            ]);
        }
//        حذف سبد خرید و اقلامش
        Cart_Item::where('cart_id', $cart->id)->delete();
        Cart::where('id', $cart->id)->delete();

        return view('pay-receipt', [
            'transaction' => $transaction,
            'total' => $total,
        ]);
    }
}
