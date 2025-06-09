<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FreeApp extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_PENDING = 'pending';
    const STATUS_DEACTIVATED = 'deactivated';

    protected $table = 'free_apps';

    protected $fillable = [
        'name',
        'description',
        'category',
        'image',
        'downloads_count',
        'external_link',
        'status',
        'slug',
    ];

    protected $casts = [
        'downloads_count' => 'integer',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'free_app_user', 'free_app_id', 'user_id')
            ->withPivot('downloaded_at');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/images/' . $this->image) : null;
    }

    // Scope for active apps
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    // Scope for slug-based filtering
    public function scopeCategory($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    // Check if app is active
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
