<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
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
        'image',
    ];

    // RELASI
    public function place()
    {
        return $this->hasMany(Place::class);
    }

    public function getImageAttribute($image)
    {
        return asset('storage/sliders/' . $image);
    }
}
