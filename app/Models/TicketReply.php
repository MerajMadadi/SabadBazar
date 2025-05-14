<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReply extends Model
{
    use HasFactory;use softDeletes;
    protected $fillable = ['ticket_id','user_id','message'];
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

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
