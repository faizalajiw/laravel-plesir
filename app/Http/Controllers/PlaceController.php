<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // Index Page
    public function index()
    {
        $places = Place::with('category')->when(request()->q, function ($places) {
            $places = $places->where('title', 'like', '%' . request()->q . '%');
        })->latest();
        return view('place.index', compact('places'));
    }
}
