<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    // Index Page
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $places = Place::all();
        return view('place.index', compact('user', 'places'));
    }

    public function myPlace()
    {
        $user = User::find(auth()->user()->id);
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk

        $places = Place::with('user')->where('user_id', $userId)->get();
        // return response()->json($places);
        return view('place.my_place.index', compact('user', 'places'));
    }

    // Search
    public function search(Request $request)
    {
        $user = User::find(auth()->user()->id);

        // Ambil nilai dari input form
        $category = $request->input('category_id');
        $title = $request->input('title');
        $user = $request->input('user_id');

        // Query untuk mencari tempat berdasarkan kriteria pencarian
        $query = Place::with('category', 'user');
        if ($category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', 'like', '%' . $category . '%');
            });
        }

        if ($title) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if ($user) {
            $query->whereHas('user', function ($query) use ($user) {
                $query->where('name', 'like', '%' . $user . '%');
            });
        }

        $places = $query->get();

        return view('place.index', compact('user', 'places'));
    }

    // Form Create
    public function create()
    {
        $user = User::find(auth()->user()->id);
        $places = Place::with('category', 'user')->get();
        $categories = Category::all();
        return view('place.create', compact('user', 'places', 'categories'));
    }

    // Store Place
    public function store(Request $request, Place $places)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'title'             => 'required|unique:places,title,' . $places->id,
            'image'             => 'required|array',
            'image.*'           => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image.*.place_id'  => 'required|exists:places,id',
            'category_id'       => 'required',
            'address'           => 'required',
            'day'               => 'required|array',
            'day.*'             => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'hours_start'       => 'required',
            'hours_end'         => 'required',
            'description'       => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required',
        ]);

        try {
            //create place
            $place = Place::create([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title, '-'),
                'user_id'           => auth()->id(),
                'category_id'       => $request->category_id,
                'address'           => $request->address,
                // 'day'               => $request->day,
                'hours_start'       => $request->hours_start,
                'hours_end'         => $request->hours_end,
                'description'       => $request->description,
                'website'           => $request->website,
                'social_media'      => $request->social_media,
                'latitude'          => $request->latitude,
                'longitude'         => $request->longitude,
            ]);

            // Simpan hari terpilih dalam bentuk array
            $days = $request->day;

            // Ubah array hari menjadi string terpisah dengan koma
            $daysString = implode(', ', $days);

            // Simpan nilai day ke dalam kolom day pada tabel places
            $place->day = $daysString;
            $place->save();

            //upload image
            if ($request->hasFile('image')) {
                //get request file image 
                $images = $request->file('image');

                //loop file image
                foreach ($images as $image) {
                    //disimpan ke storage folder di server
                    $image->storeAs('public/places', $image->hashName());

                    //insert ke database
                    $place->images()->create([
                        'image'     => $image->hashName(),
                        'place_id'  => $place->id
                    ]);
                }
            }

            Toastr::success('Tempat berhasil ditambahkan :)', 'Success');
            return redirect()->to('list/places');
        } catch (\Exception $e) {
            Toastr::error('Terjadi kesalahan saat menyimpan data.', 'Error');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Form Edit 
    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        $places = Place::with('category', 'user', 'images')->find($id);
        $categories = Category::all();
        return view('place.edit', compact('user', 'places', 'categories'));
    }

    // Update Place
    public function update(Request $request, Place $places)
    {
        $places = Place::findOrFail($request->id);

        $request->validate([
            'title'             => 'required|unique:places,title,' . $places->id,
            'image'             => 'array',
            'image.*'           => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image.*.place_id'  => 'required|exists:places,id',
            'category_id'       => 'required',
            'address'           => 'required',
            'day'               => 'required',
            'hours_start'       => 'required',
            'hours_end'         => 'required',
            'description'       => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required',
        ]);

        // Update place data
        $places->title = $request->title;
        $places->slug = Str::slug($request->title, '-');
        $places->category_id = $request->category_id;
        $places->address = $request->address;
        // Simpan hari terpilih dalam bentuk array
        $days = $request->day;
        // Ubah array hari menjadi string terpisah dengan koma
        $daysString = implode(', ', $days);
        // Simpan nilai day ke dalam kolom day pada tabel places
        $places->day = $daysString;
        $places->hours_start = $request->hours_start;
        $places->hours_end = $request->hours_end;
        $places->description = $request->description;
        $places->website = $request->website;
        $places->social_media = $request->social_media;
        $places->latitude = $request->latitude;
        $places->longitude = $request->longitude;
        $places->save();

        //upload image
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari penyimpanan
            $images = $places->images;

            foreach ($images as $image) {
                Storage::disk('local')->delete('public/places/' . basename($image->image));
                $image->delete();
            }

            // Mendapatkan file gambar yang diunggah
            $images = $request->file('image');

            //loop file image
            foreach ($images as $image) {
                //disimpan ke storage folder di server
                $image->storeAs('public/places', $image->hashName());

                //insert ke database
                $places->images()->create([
                    'image'     => $image->hashName(),
                    'place_id'  => $places->id
                ]);
            }
        }

        Toastr::success('Tempat berhasil diubah');
        return redirect()->to('list/places');
    }

    public function delete(Request $request)
    {
        $PlaceId = $request->id;
        $place = Place::find($PlaceId);

        // Hapus image 
        if ($place) {
            $images = $place->images; // Anggaplah ini adalah relasi untuk mendapatkan daftar gambar

            foreach ($images as $image) {
                Storage::disk('local')->delete('public/places/' . basename($image->image));
                $image->delete();
            }

            $place->delete();

            Toastr::success('Berhasil dihapus');
            return redirect()->back();
        } else {
            Toastr::error('Gagal dihapus');
            return redirect()->back();
        }
    }
}
