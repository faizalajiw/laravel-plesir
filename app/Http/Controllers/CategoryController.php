<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request, Category $categories)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $categories->id,
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            //create category
            Category::create([
                'image' => $image->hashName(), //mengambil request gambar
                'name' => $request->name, //mengambil request name 
                'slug' => Str::slug($request->name, '-'),
            ]);

            Toastr::success('Kategori berhasil ditambahkan :)', 'Success');
            return redirect()->to('/list/categories');
        } catch (\Exception $e) {
            Toastr::error('Terjadi kesalahan saat menyimpan kategori.', 'Error');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $categories = Category::where('id', $id)->first();
        return view('category.edit', compact('categories'));
    }

    public function update(Request $request, Category $categories)
    {
        $categories = Category::findOrFail($request->id);

        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update name
        $categories->name = $request->name;
        $categories->slug = Str::slug($request->name, '-');

        // Update image
        if ($request->hasFile('image')) {
            $oldImagePath = $categories->image;

            // Mengunggah gambar baru
            $image = $request->file('image');
            $newImagePath = $image->store('public/categories');

            if ($oldImagePath) {
                // Menghapus gambar lama jika ada
                Storage::disk('local')->delete('public/categories/' . basename($oldImagePath));
            }

            $categories->image = basename($newImagePath);
        }

        $categories->save();

        Toastr::success('Kategori berhasil diubah');
        return redirect()->to('/list/categories');
    }


    public function delete(Request $request)
    {
        $CategoryId = $request->id;
        $category = Category::find($CategoryId);

        // Hapus image 
        if ($category) {
            Storage::disk('local')->delete('public/categories/' . basename($category->image));
            $category->delete();

            Toastr::success('Kategori berhasil dihapus', 'Berhasil');
            return redirect()->back();
        } else {
            Toastr::error('Kategori gagal dihapus', 'Gagal');
            return redirect()->back();
        }
    }
}
