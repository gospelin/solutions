<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\AdminNotification;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'message', 'read'];

    protected $casts = [
        'read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::created(function ($notification) {
            event(new AdminNotification($notification));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}