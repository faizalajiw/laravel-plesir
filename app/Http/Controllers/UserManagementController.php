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
        $users = User::all();
        return view('usermanagement.index', compact('users'));
    }

    /** User Create */
    public function create()
    {
        $role = DB::table('role_type_users')->get();
        return view('usermanagement.create', compact('role'));
    }
    /** User Create */

    /** User Create */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'username'      => ['required', 'max:50', 'regex:/^\S*$/', Rule::unique('users')->ignore($request->user()->id)],
            'email'         => ['nullable', 'email', 'regex:/^\S*$/', Rule::unique('users')->ignore($request->user()->id)],
            'new_password'  => ['required', 'min:8', 'regex:/^\S*$/'],
            'role_name'     => ['required', 'string'],
            'avatar'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_name = $request->role_name;
        $user->password = Hash::make($request->new_password);

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

        // Mengupload avatar jika ada file yang diunggah
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        Toastr::success('User berhasil ditambahkan :)', 'Success');
        return redirect()->to('/list/users');
    }
    /** User Create */

    /** User Edit */
    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        $role = DB::table('role_type_users')->get();
        return view('usermanagement.update', compact('users', 'role'));
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
            'avatar'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();
        if ($user->role_name !== 'Super Admin') {
            Toastr::error('Gagal Diupdate');
            return redirect()->back();
        }

        $userToUpdate = User::find($request->id);
        if (!$userToUpdate) {
            Toastr::error('User Tidak Ditemukan');
            return redirect()->back();
        }

        $userToUpdate->name = $request->name;
        $userToUpdate->username = $request->username;
        $userToUpdate->email = $request->email;
        $userToUpdate->role_name = $request->role_name;

        // Menghapus avatar lama dan menyimpan avatar baru jika ada file avatar yang diunggah
        if ($request->hasFile('avatar')) {
            if ($userToUpdate->avatar) {
                Storage::disk('public')->delete($userToUpdate->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatar', 'public');
            $userToUpdate->avatar = $avatarPath;
        }

        $userToUpdate->save();

        // Update password jika ada perubahan
        if ($request->new_password) {
            $userToUpdate->password = Hash::make($request->new_password);
        }
        // Change password
        if ($request->current_password && $request->new_password && $request->new_confirm_password) {
            $request->validate([
                'current_password'     => ['required', new MatchOldPassword],
                'new_password'         => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);

            $userToUpdate->password = Hash::make($request->new_password);
            $userToUpdate->save();
        }

        Toastr::success('Berhasil Diupdate');
        return redirect()->to('/list/users');
    }
    /** User Update */

    /** User Delete */
    public function delete(Request $request)
    {
        // Hapus avatar jika ada
        $userId = $request->id;
        $user = User::find($userId);

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->delete();

            Toastr::success('Berhasil dihapus');
            return redirect()->back();
        } else {
            Toastr::error('Gagal dihapus');
            return redirect()->back();
        }
    }
    /** User Delete */
}
