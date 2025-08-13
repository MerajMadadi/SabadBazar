<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Cart_Item;
use App\Models\Category;
use App\Models\Comment;
use App\Models\DeliveryCenters;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\error;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Product $product)
    {
        Comment::create([
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
