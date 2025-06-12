<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, Notifiable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'verification_code',
        'verification_code_expires_at',
        'theme',
        'notifications',
        'language',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'verification_code_expires_at' => 'datetime',
        'password' => 'hashed',
        'notifications' => 'boolean',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
    
    //public function sendEmailVerificationNotification()
    //{
    //    $this->notify(new VerifyEmail);
    //}

    //public function hasVerifiedEmail(): bool
    //{
    //    return !is_null($this->email_verified_at);
    //}

    //public function markEmailAsVerified(): bool
    //{
    //    return $this->forceFill([
    //        'email_verified_at' => $this->freshTimestamp(),
    //        'status' => 'active',
    //        'verification_code' => null,
    //        'verification_code_expires_at' => null,
    //    ])->save();
    //}

    //public function getEmailForVerification(): string
    //{
    //    return $this->email;
    //}

    //public function purchasedItems(): BelongsToMany
    //{
    //    return $this->belongsToMany(MarketItem::class, 'market_item_user', 'user_id', 'market_item_id')
    //        ->withPivot('purchased_at');
    //}
    

}