<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function orders_index()
    {
        $orders = Transaction::where('user_id', Auth::id())->get();
        $customer = Auth::user();
        return view('orders', compact('orders', 'customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function order_show($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->with(['cart.cartItems' => function ($query) {
            $query->withTrashed();
        }, 'cart.cartItems.product'])
            ->where('id', $id)
            ->firstOrFail();

        return view('information-order', compact('transaction'));
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
    public function destroy(string $id)
    {
        //
    }
}
