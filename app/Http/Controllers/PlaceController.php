<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use App\Models\PlaceImage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    // Index Page
    public function index()
    {
        $places = Place::all();
        return view('place.index', compact('places'));
    }

    // Form Create
    public function create()
    {
        $places = Place::with('category', 'user')->get();
        return view('place.create', compact('places'));
    }

    // Store Place
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'title'       => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'address'     => 'required',
            'latitude'    => 'required',
            'longitude'   => 'required',
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
            return redirect()->to('/list/places');
        } catch (\Exception $e) {
            Toastr::error('Terjadi kesalahan saat menyimpan data.', 'Error');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
