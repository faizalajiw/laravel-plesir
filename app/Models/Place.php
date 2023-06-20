<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title', 
        'slug', 
        'category_id', 
        'user_id', 
        'description',  
        'day',
        'address', 
        'operational_hours', 
        'website', 
        'social_media',
        'longitude', 
        'latitude'
    ];

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PlaceImage::class);
    }
    
    public function visitor()
    {
        return $this->hasOne(Visitor::class);
    }

    public function review()
    {
        return $this->hasMany(Place::class);
    }
}
