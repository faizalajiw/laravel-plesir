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
        $penggunaCount = User::where('role_name', 'Pengguna')->count();
        $adminCount = User::where('role_name', 'Admin Wisata')->count();
        $categoryCount = Category::count();
        $placeCount = Place::count();

        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $visitor = Visitor::with('user')->where('user_id', $userId)->get();
        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('dashboard.index', compact('visitor', 'places', 'penggunaCount', 'adminCount' , 'categoryCount', 'placeCount'));
        // return view('dashboard.index', compact('penggunaCount', 'adminCount' , 'categoryCount', 'placeCount'));
    }
}
