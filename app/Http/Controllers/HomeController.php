<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('dashboard.home', compact('penggunaCount', 'adminCount' , 'categoryCount', 'placeCount'));
    }

    /** profile user */
    public function userProfile()
    {
        return view('profile.index');
    }
}
