<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    const VALID_NAMES = ['admin', 'user', 'seller'];

    protected $fillable=['name','label'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
