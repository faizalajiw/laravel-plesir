<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    /** home dashboard */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $penggunaCount = User::where('role_name', 'Pengguna')->count();
        $adminCount = User::where('role_name', 'Admin Wisata')->count();
        $categoryCount = Category::count();
        $placeCount = Place::count();

        $visitor = Visitor::with('user', 'place')->get();
        // return response()->json($visitor);
        return view('dashboard.index', compact('user', 'visitor', 'penggunaCount', 'adminCount', 'categoryCount', 'placeCount'));
    }

    /** home dashboard */
    public function indexAdminWisata()
    {
        $user = User::find(auth()->user()->id);

        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $visitor = Visitor::with('user')->where('user_id', $userId)->get();
        $places = Place::with('user')->where('user_id', $userId)->get();
        // return response()->json($visitor);
        return view('dashboard.index', compact('user', 'visitor', 'places'));
    }

    public function indexUser()
    {
        $user = User::find(auth()->user()->id);
        // return response()->json($visitor);
        return view('dashboard.index', compact('user'));
    }

    // Search
    public function search(Request $request)
    {
        $user = User::find(auth()->user()->id);

        // Ambil nilai dari input form
        $place = $request->input('place_id');

        // Query untuk mencari tempat berdasarkan kriteria pencarian
        $visitor = Visitor::with('user', 'place')
            ->when($place, function ($query) use ($place) {
                // Filter berdasarkan tempat jika ada nilai
                return $query->whereHas('place', function ($query) use ($place) {
                    $query->where('title', 'like', '%' . $place . '%');
                });
            })
            ->get();

        // return response()->json($visitor);
        return view('dashboard.index', compact('user', 'visitor'));
    }
}
