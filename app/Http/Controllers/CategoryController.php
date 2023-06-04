<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
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

    // public function edit(Category $category)
    // {
    //     return view('category.edit', compact('category'));
    // }

    // public function update(Request $request, Category $category)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'slug' => 'required|unique:categories,slug,' . $category->id,
    //         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->storeAs('public/categories', $imageName);
    //         $category->image = $imageName;
    //     }

    //     $category->name = $request->name;
    //     $category->slug = $request->slug;
    //     $category->save();

    //     return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    // }

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
