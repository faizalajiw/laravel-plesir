<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    // Index Page
    public function index()
    {
        $places = Place::all();
        return view('place.index', compact('places'));
    }

    public function myPlace()
    {
        $userId = auth()->id(); // Mengambil ID pengguna yang sedang masuk

        $places = Place::with('user')->where('user_id', $userId)->get();
        return view('place.my_place.index', compact('places'));
    }

    // Search
    public function search(Request $request)
    {
        // Ambil nilai dari input form
        $category = $request->input('category_id');
        $title = $request->input('title');
        $user = $request->input('user_id');

        // Query untuk mencari tempat berdasarkan kriteria pencarian
        $places = Place::with('category', 'user')
            ->when($category, function ($query) use ($category) {
                // Filter berdasarkan kategori jika ada nilai
                return $query->whereHas('category', function ($query) use ($category) {
                    $query->where('name', 'like', '%' . $category . '%');
                });
            })
            ->when($title, function ($query) use ($title) {
                // Filter berdasarkan nama tempat jika ada nilai
                return $query->where('title', 'like', '%' . $title . '%');
            })
            // ->when($user, function ($query) use ($user) {
            //     // Filter berdasarkan pengelola jika ada nilai
            //     return $query->whereHas('user', function ($query) use ($user) {
            //         $query->where('name', 'like', '%' . $user . '%');
            //     });
            // })            
            ->get();

        return view('place.index', compact('places'));
    }


    // Form Create
    public function create()
    {
        $places = Place::with('category', 'user')->get();
        $categories = Category::all();
        return view('place.create', compact('places', 'categories'));
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
            'description'       => 'required',
            'operational_hours' => 'required',
            'address'           => 'required',
            'website'           => 'nullable',
            'social_media'      => 'nullable',
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
                'operational_hours' => $request->operational_hours,
                'description'       => $request->description,
                'address'           => $request->address,
                'website'           => $request->website,
                'social_media'      => $request->social_media,
                'latitude'          => $request->latitude,
                'longitude'         => $request->longitude,
            ]);

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
            return redirect()->to('list/my_places');
        } catch (\Exception $e) {
            Toastr::error('Terjadi kesalahan saat menyimpan data.', 'Error');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
