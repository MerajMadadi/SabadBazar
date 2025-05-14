<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'transaction_code',
        'amount',
        'cart_id',
        'user_id',
        'card_number',
        'paid_at'
    ];
    public function getCreatedAtJalaliAttribute()
    {
        $formatter = new \IntlDateFormatter(
            'fa_IR@calendar=persian',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::SHORT,
            'Asia/Tehran',
            \IntlDateFormatter::TRADITIONAL,
            'yyyy/MM/dd - HH:mm'
        );

        $date = $this->created_at
            ->copy()          // از نمونه اصلی کپی می‌گیریم
            ->subHour();      // یک ساعت کم می‌کنیم

        return $formatter->format($date);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class)->withTrashed();
    }

}
