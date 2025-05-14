<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    protected $fillable = ['user_id'];
    use HasFactory, softDeletes;

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart_Item::class);
    }
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
