<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MarketItem extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVATED = 'deactivated';

    protected $table = 'market_items';

    protected $fillable = [
        'name', 'description', 'category', 'price', 'price_ngn', 'image',
        'purchases_count', 'external_link', 'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'price_ngn' => 'decimal:2',
        'purchases_count' => 'integer',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'market_item_user', 'market_item_id', 'user_id')
                    ->withPivot('purchased_at');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/images/' . $this->image) : null;
    }

    // Scope for active items
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    // Check if item is active
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

}
