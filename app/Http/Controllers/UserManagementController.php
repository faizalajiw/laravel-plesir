<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    // Index Page
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $users = User::all();

        // return response()->json($users);
        return view('usermanagement.index', compact('user', 'users'));
    }

    // Only show 1 role
    public function showPengguna()
    {
        $user = User::find(auth()->user()->id);
        $users = User::where('role_name', 'Pengguna')->get();
        // return response()->json($users);
        return view('usermanagement.pengguna.index', compact('user', 'users'));
    }

    public function showAdmin()
    {
        $user = User::find(auth()->user()->id);
        $users = User::where('role_name', 'Admin Wisata')->get();
        return view('usermanagement.admin_wisata.index', compact('user', 'users'));
    }

    public function showSuper()
    {
        $user = User::find(auth()->user()->id);
        $users = User::where('role_name', 'Super Admin')->get();
        return view('usermanagement.super_admin.index', compact('user', 'users'));
    }

    // Search
    public function search(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $users = User::query();

        if ($request->filled('users_id')) {
            $users->where('users_id', $request->input('users_id'));
        }

        if ($request->filled('name')) {
            $users->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->filled('username')) {
            $users->where('username', 'LIKE', '%' . $request->input('username') . '%');
        }

        $users = $users->get();

        return view('usermanagement.index', compact('user', 'users'));
    }

    /** User Create */
    public function create()
    {
        $user = User::find(auth()->user()->id);
        $role = DB::table('role_type_users')->get();
        return view('usermanagement.create', compact('user', 'role'));
    }
    /** User Create */

    /** User Store */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'username'      => ['required', 'max:50', 'regex:/^\S*$/', Rule::unique('users')->ignore($request->user()->id)],
            'email'         => ['nullable', 'email', 'regex:/^\S*$/', Rule::unique('users')->ignore($request->user()->id)],
            'new_password'  => ['required', 'min:8', 'regex:/^\S*$/'],
            'role_name'     => ['required', 'string'],
            'image'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Mengupload image jika ada file yang diunggah
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/users', $image->hashName());
            $imagePath = $image->hashName();
        } else {
            $imagePath = null;
        }

        //create category
        $user = User::create([
            'name'          => $request->name, //mengambil request name
            'username'      => $request->username, //mengambil request username
            'email'         => $request->email, //mengambil request email
            'role_name'     => $request->role_name, //mengambil request role_name
            'password'      => Hash::make($request->new_password), //mengambil request password
            'image'         => $imagePath, //mengambil request image
        ]);

        // Menghasilkan users_id sesuai dengan pola yang diinginkan
        if ($request->role_name === 'Super Admin') {
            $user->users_id = 'SUPER' . Str::upper(Str::random(5)); // contoh pola untuk super admin
        } elseif ($request->role_name === 'Admin Wisata') {
            $user->users_id = 'ADMIN' . Str::upper(Str::random(5)); // contoh pola untuk admin wisata
        } elseif ($request->role_name === 'Pengguna') {
            $user->users_id = 'USER' . Str::upper(Str::random(6)); // contoh pola untuk pengguna
        } else {
            $user->users_id = ''; // jika tidak ada pola khusus, biarkan kosong
        }

        $user->save();

        Toastr::success('User Berhasil Ditambahkan.');
        return redirect()->to('/list/users');
    }
    /** User Store */

    /** User Edit */
    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        $users = User::where('id', $id)->first();
        $role = DB::table('role_type_users')->get();
        // return response()->json($users);
        return view('usermanagement.edit', compact('user', 'users', 'role'));
    }
    /** User Edit */

    /** User Update */
    public function update(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'name'          => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'username'      => ['required', 'max:50', 'regex:/^\S*$/', Rule::unique('users')->ignore($request->id)],
            'email'         => ['nullable', 'email', 'regex:/^\S*$/', Rule::unique('users')->ignore($request->id)],
            'new_password'  => ['required', 'min:8', 'regex:/^\S*$/'],
            'role_name'     => ['required', 'string'],
            'image'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        $users = User::findOrFail($request->id);

        $user = Auth::user();
        if ($user->role_name !== 'Super Admin') {
            Toastr::error('User Gagal Diupdate');
            return redirect()->back();
        }

        if (!$users) {
            Toastr::error('User Tidak Ditemukan');
            return redirect()->back();
        }

        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role_name = $request->role_name;

        // Mengubah users_id sesuai dengan pola yang diinginkan berdasarkan role_name yang diperbarui
        if ($request->role_name === 'Super Admin') {
            $users->users_id = 'SUPER' . Str::upper(Str::random(5)); // contoh pola untuk super admin
        } elseif ($request->role_name === 'Admin Wisata') {
            $users->users_id = 'ADMIN' . Str::upper(Str::random(5)); // contoh pola untuk admin wisata
        } elseif ($request->role_name === 'Pengguna') {
            $users->users_id = 'USER' . Str::upper(Str::random(6)); // contoh pola untuk pengguna
        } else {
            $users->users_id = ''; // jika tidak ada pola khusus, biarkan kosong
        }

        // Update image
        if ($request->hasFile('image')) {
            $oldImagePath = $users->image;

            // Mengunggah gambar baru
            $image = $request->file('image');
            $newImagePath = $image->store('public/users');

            if ($oldImagePath) {
                // Menghapus gambar lama jika ada
                Storage::disk('local')->delete('public/users/' . basename($oldImagePath));
            }

            $users->image = basename($newImagePath);
        }

        $users->save();

        // Update password jika ada perubahan
        if ($request->new_password) {
            $users->password = Hash::make($request->new_password);
        }
        // Change password
        if ($request->current_password && $request->new_password && $request->new_confirm_password) {
            $request->validate([
                'current_password'     => ['required', new MatchOldPassword],
                'new_password'         => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);

            $users->password = Hash::make($request->new_password);
            $users->save();
        }

        Toastr::success('User Berhasil Diupdate');
        return redirect()->to('/list/users');
    }
    /** User Update */

    /** User Delete */
    public function delete(Request $request)
    {
        // Hapus image jika ada
        $userId = $request->id;
        $user = User::find($userId);

        if ($user) {
            Storage::disk('local')->delete('public/users/' . basename($user->image));
            $user->delete();

            Toastr::success('User Berhasil Dihapus');
            return redirect()->back();
        }
        if (!$user->image) {
            $user->delete();
            Toastr::success('User Berhasil Dihapus');
            return redirect()->back();
        } else {
            Toastr::error('User Gagal Dihapus');
            return redirect()->back();
        }
    }
    /** User Delete */
}
