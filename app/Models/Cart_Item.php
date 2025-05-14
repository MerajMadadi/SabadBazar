<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart_Item extends Model
{
    protected $table = 'cart_item';
    protected $fillable = ['cart_id','product_id', 'quantity', 'price', 'created_at'];
    use HasFactory, softDeletes;

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->BelongsTo(Product::class, 'product_id', 'id');
    }
}
