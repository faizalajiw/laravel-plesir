<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id); // Mengambil ID pengguna yang sedang masuk
        
        $reviews = Review::with('user', 'place')->get();
        $review  = Review::with('user', 'place')->get();
        $groupedReviews = $review->groupBy('place_id');
        // return response()->json($groupedReviews);
        return view('review.index', compact('user', 'reviews', 'groupedReviews'));
    }
    
    public function myReviewTempat()
    {
        $user = User::find(auth()->user()->id);
        
        $reviews = Review::whereHas('place', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->with('user', 'place')->get();

        $review = Review::whereHas('place', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->with('user', 'place')->get();
        $groupedReviews = $review->groupBy('place_id');
            
        return view('review.my_review_tempat.index', compact('user', 'reviews', 'groupedReviews'));
    }
    
    public function myReview()
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        
        $reviews = Review::with('user', 'place')->where('user_id', $userId)->get();
        // return response()->json($reviews);
        return view('review.my_review.index', compact('user', 'reviews'));
    }

    public function create()
    {
        $user = User::find(auth()->user()->id);
        $places = Place::all();

        return view('review.create', compact('user', 'places'));
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
        return redirect()->to('list/my_review');
    }

    public function delete($id)
    {
        // Cek apakah pengguna terautentikasi
        if (!Auth::check()) {
            Toastr::error('Anda harus login untuk menghapus ulasan.');
            return redirect()->back();
        }

        // Temukan review berdasarkan ID
        $review = Review::find($id);

        // Cek apakah review ditemukan
        if (!$review) {
            Toastr::error('Ulasan tidak ditemukan.');
            return redirect()->back();
        }

        // // Cek apakah pengguna memiliki izin untuk menghapus ulasan
        // if ($review->user_id !== Auth::user()->id) {
        //     Toastr::error('Anda tidak memiliki izin untuk menghapus ulasan ini');
        //     return redirect()->back();
        // }

        // Hapus review
        $review->delete();

        Toastr::success('Berhasil dihapus');
        return redirect()->back();
    }
}
