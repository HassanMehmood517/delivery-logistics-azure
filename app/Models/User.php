<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE_ID = 1;
    const STORE_ROLE_ID = 2;
    const DELIVERY_BOY_ROLE_ID = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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

    public function isAdmin(): bool
    {
        if ($this->role_id == self::ADMIN_ROLE_ID) {
            return true;
        }
        return false;
    }

    public function isStore(): bool
    {
        if ($this->role_id == self::STORE_ROLE_ID) {
            return true;
        }
        return false;
    }

    public function isDeliveryBoy(): bool
    {
        if ($this->role_id == self::DELIVERY_BOY_ROLE_ID) {
            return true;
        }
        return false;
    }

    public function deliveryboyRequests()
    {
        return $this->hasMany(DeliveryRequest::class, 'delivery_boy_id', 'id');
    }

    public function storeRequests()
    {
        return $this->hasMany(DeliveryRequest::class, 'store_id', 'id');
    }
}
