<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $sliders = Slider::all();
        return view('slider.index', compact('user', 'sliders'));
    }
    
    public function create()
    {
        $user = User::find(auth()->user()->id);
        return view('slider.create', compact('user'));
    }

    public function store(Request $request, Slider $sliders)
    {
        $request->validate([
            'title' => 'required|unique:sliders,title,' . $sliders->id,
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/sliders', $image->hashName());

            //create category
            Slider::create([
                'title' => $request->title, //mengambil request name 
                'image' => $image->hashName(), //mengambil request gambar
            ]);

            Toastr::success('Kategori berhasil ditambahkan :)', 'Success');
            return redirect()->to('/list/sliders');
        } catch (\Exception $e) {
            Toastr::error('Terjadi kesalahan saat menyimpan kategori.', 'Error');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        $sliders = Slider::where('id', $id)->first();
        return view('slider.edit', compact('user', 'sliders'));
    }

    public function update(Request $request, Slider $sliders)
    {
        $sliders = Slider::findOrFail($request->id);

        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update name
        $sliders->title = $request->title;

        // Update image
        if ($request->hasFile('image')) {
            $oldImagePath = $sliders->image;

            // Mengunggah gambar baru
            $image = $request->file('image');
            $newImagePath = $image->store('public/sliders');

            if ($oldImagePath) {
                // Menghapus gambar lama jika ada
                Storage::disk('local')->delete('public/sliders/' . basename($oldImagePath));
            }

            $sliders->image = basename($newImagePath);
        }

        $sliders->save();

        Toastr::success('Kategori berhasil diubah');
        return redirect()->to('/list/sliders');
    }


    public function delete(Request $request)
    {
        $SlidersId = $request->id;
        $sliders = Slider::find($SlidersId);

        // Hapus image 
        if ($sliders) {
            Storage::disk('local')->delete('public/sliders/' . basename($sliders->image));
            $sliders->delete();

            Toastr::success('Kategori berhasil dihapus', 'Berhasil');
            return redirect()->back();
        } else {
            Toastr::error('Kategori gagal dihapus', 'Gagal');
            return redirect()->back();
        }
    }
}
