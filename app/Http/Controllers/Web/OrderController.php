<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $places = Place::all();
        
        // return response()->json($places);
        return view('web.pesanTiket', compact('places'));
    }
    public function orderByAdmin()
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk

        $places = Place::with('user')->where('user_id', $userId)->get();
        // return response()->json($places);
        return view('web.pesanByAdmin', compact('places', 'user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user(); // Mengambil data pengguna yang sedang login
        $request->merge([
            'status' => 'Lunas',
            'user_id' => $user->id, // Menambahkan user_id ke request
        ]);
        Order::create($request->all());
        // return response()->json($places);
        return redirect()->route('list/order')->with('success', 'Pesanan tiket berhasil dibuat!');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user(); // Mengambil data pengguna yang sedang login
        $request->merge([
            'status' => 'Belum Dibayar',
            'user_id' => $user->id, // Menambahkan user_id ke request
        ]);
        $order = Order::create($request->all());

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $request->total,
            ),
            'ticket_details' => array(
                'place_title' => $request->place_title,
                'tanggal'   => $request->tanggal,
                'price'     => $request->price,
                'quantity'  => $request->quantity,
            ),
            'user_details' => array(
                'name'      => $request->name,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        // return response()->json($user);
        return view('web.checkout', compact('snapToken', 'order', 'user'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Lunas']);
            }
        }
    }

    public function invoice($id)
    {
        $order = Order::find($id);
        // return response()->json($order);
        return view('web.invoice', compact('order'));
    }
}
