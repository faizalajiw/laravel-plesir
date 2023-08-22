<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Place;
use App\Models\User;

class HistoryOrderController extends Controller
{
    public function historyPengguna()
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $order = Order::with('user')->where('user_id', $userId)->get();
        // return response()->json($order);
        return view('history.pengguna', compact('user', 'order'));
    }

    public function historyAdmin()
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id();
        // Mengambil semua pesanan yang terkait dengan place_id yang dimiliki oleh pengguna
        $order = Order::with('user', 'place') // Pastikan Anda memiliki relasi 'place' di model Order
            ->whereHas('place', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
        // return response()->json($order);
        return view('history.adminWisata', compact('user', 'order'));
    }

    // public function create()
    // {
    //     $user = User::find(auth()->user()->id);
    //     $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk

    //     $places = Place::with('user')->where('user_id', $userId)->get();
    //     // Mengambil semua pesanan yang terkait dengan place_id yang dimiliki oleh pengguna
    //     $order = Order::with('user', 'place') // Pastikan Anda memiliki relasi 'place' di model Order
    //         ->whereHas('place', function ($query) use ($userId) {
    //             $query->where('user_id', $userId);
    //         })
    //         ->get();

    //     // return response()->json($places);
    //     return view('pemesanan.create', compact('user', 'order', 'places'));
    // }
}
