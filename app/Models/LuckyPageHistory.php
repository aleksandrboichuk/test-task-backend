<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LuckyPageHistory extends Model
{
    protected $table = 'lucky_page_history';

    protected $fillable = [
        'result',
        'number',
        'sum',
        'lucky_page_id',
    ];

    public function page(): HasOne
    {
        return $this->hasOne(LuckyPage::class, 'id', 'lucky_page_id');
    }
}
