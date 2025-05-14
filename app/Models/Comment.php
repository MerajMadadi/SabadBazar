<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use IntlDateFormatter;


class Comment extends Model
{
    protected $fillable = ['user_id', 'product_id', 'content', 'rate'];
    use HasFactory, softDeletes;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
