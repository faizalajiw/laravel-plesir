<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Slider;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // menampilkan di home
    public function index()
    {
        $sliders = Slider::all();
        // card category
        $categories = Category::all();
        return view('web.index', compact('categories', 'sliders'));
    }

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

        return view('web.category.showCategory', compact('categories', 'places', 'sliders'));
    }
}
