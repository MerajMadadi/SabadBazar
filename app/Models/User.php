<?php

namespace App\Models;

// use Illuminate\Contracts\AuthController\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'store_name',
        'store_phone',
        'store_address',
        'license_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function getUpdatedAtJalaliAttribute()
    {
        $formatter = new \IntlDateFormatter(
            'fa_IR@calendar=persian',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::SHORT,
            'Asia/Tehran',
            \IntlDateFormatter::TRADITIONAL,
            'yyyy/MM/dd - HH:mm'
        );

        $date = $this->updated_at
            ->copy()          // از نمونه اصلی کپی می‌گیریم
            ->subHour();      // یک ساعت کم می‌کنیم

        return $formatter->format($date);
    }
    public function getDeletedAtJalaliAttribute()
    {
        $formatter = new \IntlDateFormatter(
            'fa_IR@calendar=persian',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::SHORT,
            'Asia/Tehran',
            \IntlDateFormatter::TRADITIONAL,
            'yyyy/MM/dd - HH:mm'
        );

        $date = $this->deleted_at
            ->copy()          // از نمونه اصلی کپی می‌گیریم
            ->subHour();      // یک ساعت کم می‌کنیم

        return $formatter->format($date);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
