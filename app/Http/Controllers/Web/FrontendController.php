<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Visitor;

class FrontendController extends Controller
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

        // Get Review Place group by place id
        $review  = Review::with('user', 'place')->get();
        $groupedReviews = $review->groupBy('place_id');

        // return response()->json($groupedReviews);
        return view('web.jelajah_wisata.showPlace', compact('categories', 'places', 'sliders', 'groupedReviews'));
    }

    // Menampilkan Detail Tempat
    public function showDetail($slug)
    {
        $sliders = Slider::all();

        // Get Detail Place
        $places = Place::with('category', 'images')->where('slug', $slug)->first();
        // Get Review Place
        $reviews = Review::where('place_id', $places->id)->with('user')->get();
        // Hitung Review
        $average = $reviews->avg('rating'); // Menghitung rata-rata rating
        $averageRating = round($average, 1); // Bulatkan rata-rata rating menjadi 1 angka desimal
        $wholeStars = floor($averageRating); // Bagian integer dari rata-rata rating
        $fractionStar = $averageRating - $wholeStars; // Bagian pecahan dari rata-rata rating
        // Hitung Jumlah Ulasan
        $reviewCount = $reviews->count();

        // Get Visitor for Specific Place ID
        $visitor = Visitor::where('place_id', $places->id)->get();

        // return response()->json($visitor);
        return view('web.jelajah_wisata.showDetailPlace', compact('sliders', 'places', 'reviews', 'visitor', 'averageRating', 'wholeStars', 'fractionStar', 'reviewCount'));
    }

    // Menampilkan Rute Tempat
    public function showDirection($slug)
    {
        $sliders = Slider::all();

        // Get Detail Place
        $places = Place::with('category', 'images')->where('slug', $slug)->first();

        // return response()->json($places);
        return view('web.jelajah_wisata.showDirection', compact('sliders', 'places'));
    }
}
