<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketItem extends Model
{
    protected $table = 'market_items';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'purchases_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'purchases_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
