<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'market_item_user', 'market_item_id', 'user_id')
                    ->withPivot('purchased_at');
    }
}
