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
        'id',
        'name',
        'username',
        'email',
        'password',
        'role_name',
        'status',
        'image',
        'users_id',
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


    // RELASI
    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function place()
    {
        return $this->hasMany(Place::class);
    }

    public function visitor()
    {
        return $this->hasMany(Visitor::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function getImageAttribute($image)
    {
        return asset('storage/users/' . $image);
    }
}
