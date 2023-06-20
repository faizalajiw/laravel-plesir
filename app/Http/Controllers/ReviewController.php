<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\PlaceImage;
use App\Models\Review;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk

        $reviews = Review::with('user', 'place')->where('user_id', $userId)->get();
        // return response()->json($reviews);
        return view('review.index', compact('reviews'));
    }

    public function create()
    {
        $users = User::find(auth()->user()->id);
        $places = Place::all();

        return view('review.create', compact('users', 'places'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'place_id'  => 'required',
            'rating'    => 'required',
            'ulasan'    => 'required',
        ]);

        Review::create([
            'place_id'  => $request->place_id,
            'user_id'   => auth()->id(),
            'rating'    => $request->rating,
            'ulasan'    => $request->ulasan,
        ]);

        Toastr::success('Terima kasih atas ulasannya :)');
        return redirect()->to('list/review');
    }
}
