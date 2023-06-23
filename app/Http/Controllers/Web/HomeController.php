<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan Category di Home
    public function show($slug)
    {
        $sliders = Slider::all();
        // Get the category based on the slug
        $categories = Category::where('slug', $slug)->firstOrFail();

        // Get the places based on the category
        $places = Place::where('category_id', $categories->id)
            ->with('category', 'images')
            ->latest()
            ->get();

        // return response()->json($places);
        return view('web.jelajah_wisata.showPlace', compact('categories', 'places', 'sliders'));
    }

    public function showDetail($slug)
    {
        $sliders = Slider::all();

        // Get Detail Place
        $places = Place::with('category', 'images')->where('slug', $slug)->first();
        // return response()->json($places);
        return view('web.jelajah_wisata.showDetailPlace', compact('sliders', 'places'));
    }
}
