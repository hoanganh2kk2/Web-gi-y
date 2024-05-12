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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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


    public function getStatusAttribute(): array
    {
        return BaseModel::getStatus($this->attributes['status'], true);
    }

    function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    function districts(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Districts::class, 'id', 'district_id');
    }

    function ward(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Wards::class, 'id', 'ward_id');
    }
}
