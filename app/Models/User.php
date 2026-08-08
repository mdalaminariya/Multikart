<?php

namespace App\Models;

use App\Models\Physical\Product\Product;
use App\Models\Digital\Product\Product as DigitalProduct;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function physicalProducts()
{
    return $this->hasMany(Product::class, 'user_id');
}

public function digitalProducts()
{
    return $this->hasMany(DigitalProduct::class, 'user_id');
}
public function addresses()
{
    return $this->hasMany(Address::class);
}
}
