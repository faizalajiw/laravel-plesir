<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Visitor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    // List Data Pengunjung
    public function history()
    {
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $visitor = Visitor::with('user')->where('user_id', $userId)->get();
        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('visitor.index', compact('places', 'visitor'));
    }

    // Form Create
    public function create()
    {
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('visitor.create', compact('places'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'place_id'     => 'required',
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
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk
        $visitor = Visitor::findOrFail($id);
        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('visitor.edit', compact('visitor', 'places'));
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

        // // Update data visitor
        // $visitor->place_id = $request->place_id;
        // $visitor->senin = $request->senin;
        // $visitor->selasa = $request->selasa;
        // $visitor->rabu =  $request->rabu;
        // $visitor->kamis =  $request->kamis;
        // $visitor->jumat =  $request->jumat;
        // $visitor->sabtu =  $request->sabtu;
        // $visitor->minggu =  $request->minggu;


        // // Simpan perubahan
        // $visitor->save();

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
