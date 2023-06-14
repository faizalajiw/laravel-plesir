<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Slider;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // list data place by kategori
    public function index()
    {
        $places = Place::with('category', 'images')->latest()->get();
        return view('web.cardPlace', compact('places'));
    }    

    // show detail place
    public function show($slug)
    {
        $places = Place::with('category', 'images')->where('slug', $slug)->first();
        return view('web.place-detail', compact('places'));
    }
}
