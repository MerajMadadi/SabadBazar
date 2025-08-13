<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ticket extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['ticket_id', 'user_id', 'subject', 'message', 'status'];

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

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticket_replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket_id');
    }
}
