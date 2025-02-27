<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LuckyPage extends Model
{
    protected $table = 'lucky_pages';

    protected $fillable = [
      'hash',
      'user_id',
      'is_active',
      'expire_at'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function history(): HasMany
    {
        return $this->hasMany(LuckyPageHistory::class, 'id', 'lucky_page_id');
    }

    public function scopeRetrieveByHash($query, string $hash, $userId)
    {
        return $query
            ->where('hash', $hash)
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->where('expire_at', '<=', now());
    }
}
