<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use App\Models\Visitor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    // List Data Pengunjung
    public function index()
    {
        $user = User::find(auth()->user()->id);

        // $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $visitor = Visitor::with('user', 'place')->get();
        // return response()->json($visitor);
        return view('visitor.index', compact('user', 'visitor'));
    }

    // Riwayat Pengunjung 
    public function history()
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $visitor = Visitor::with('user')->where('user_id', $userId)->get();
        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('visitor.history.index', compact('user', 'places', 'visitor'));
    }
    
    // Form Create
    public function create()
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('visitor.create', compact('user', 'places'));
    }

    public function store(Request $request, Visitor $visitor)
    {
        $request->validate([
            'place_id' => 'required|unique:visitors,place_id,' . $visitor->id,
        ]);

        $visitor = Visitor::create([
            'place_id'    => $request->place_id,
            'user_id'     => auth()->id(),
            'senin'       => $request->senin,
            'selasa'      => $request->selasa,
            'rabu'        => $request->rabu,
            'kamis'       => $request->kamis,
            'jumat'       => $request->jumat,
            'sabtu'       => $request->sabtu,
            'minggu'      => $request->minggu,
        ]);

        $visitor->save();
        Toastr::success('Data Pengunjung berhasil ditambahkan :)', 'Success');
        return redirect()->to('list/history');
    }

    // Form Edit 
    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $visitor = Visitor::findOrFail($id);
        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('visitor.edit', compact('user', 'visitor', 'places'));
    }

    public function update(Request $request, Visitor $visitor)
    {
        // Validasi data
        $request->validate([
            'place_id' => 'required',
        ]);

        // Cari visitor berdasarkan ID
        $visitor = Visitor::findOrFail($request->id);

        // Update data visitor dan hitung total nilai
        $visitor->place_id = $request->place_id;
        $totalSenin = $visitor->senin + $request->senin;
        $totalSelasa = $visitor->selasa + $request->selasa;
        $totalRabu = $visitor->rabu + $request->rabu;
        $totalKamis = $visitor->kamis + $request->kamis;
        $totalJumat = $visitor->jumat + $request->jumat;
        $totalSabtu = $visitor->sabtu + $request->sabtu;
        $totalMinggu = $visitor->minggu + $request->minggu;
        // Hitung total semua hari
        $totalHari = $totalSenin + $totalSelasa + $totalRabu + $totalKamis + $totalJumat + $totalSabtu + $totalMinggu;
        
        // Simpan perubahan
        $visitor->senin = $totalSenin;
        $visitor->selasa = $totalSelasa;
        $visitor->rabu = $totalRabu;
        $visitor->kamis = $totalKamis;
        $visitor->jumat = $totalJumat;
        $visitor->sabtu = $totalSabtu;
        $visitor->minggu = $totalMinggu;
        $visitor->total_hari = $totalHari;
        $visitor->save();

        Toastr::success('Data Pengunjung berhasil diperbarui :)', 'Success');
        return redirect()->to('list/history');
    }

    public function delete(Request $request)
    {
        // Hapus  
        if ($request->id) {
            $PlaceId = $request->id;
            $visitor = Visitor::find($PlaceId);

            $visitor->delete();

            Toastr::success('Berhasil dihapus');
            return redirect()->back();
        } else {
            Toastr::error('Gagal dihapus');
            return redirect()->back();
        }
    }
}
