<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['name', 'code', 'description'];

    public function PaymentMethod(): BelongsTo
    {
        return $this->belongsTo(Payment_Method::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
