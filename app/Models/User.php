<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login',
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
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->uuid = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        });
    }

    public function hasTier($tier){
        return $this->tier === $tier;
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'uuid', 'auth_user');
    }

    public function subs()
    {
        return $this->belongsTo(Subscription::class, 'uuid', 'user_uuid');
    }
}
