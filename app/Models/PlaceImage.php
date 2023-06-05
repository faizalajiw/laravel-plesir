<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceImage extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'place_id', 
        'image'
    ];

    public function getImageAttribute($image)
    {
        return asset('storage/places/' . $image);
    }
}
