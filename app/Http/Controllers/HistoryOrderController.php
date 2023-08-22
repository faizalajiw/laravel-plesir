<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoryOrderController extends Controller
{
    public function index()
    {        
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $order = Order::with('user')->where('user_id', $userId)->get();
        // return response()->json($order);
        return view('history.index', compact('user', 'order'));
    }
}
