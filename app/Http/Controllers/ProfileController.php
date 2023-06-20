<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** profile user */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        // return response()->json($user);

        return view('profile.index', compact('user'));
    }

    /** change detail akun */
    public function changeProfileDetail(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'username'  => ['required', 'max:50', 'regex:/^\S*$/', Rule::unique('users')->ignore(auth()->user()->id),],
            'email'     => ['required', 'email', 'regex:/^\S*$/', Rule::unique('users')->ignore(auth()->user()->id),],
        ]);

        // Simpan request
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        // Update data name dan email dalam variabel Session
        Session::put('name', $request->name);
        Session::put('username', $request->username);
        Session::put('email', $request->email);

        Toastr::success('Data berhasil diupdate', 'Success');
        return redirect()->intended('profile/user');
    }

    /** change password */
    public function changeProfilePassword(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required', 'min:8', 'regex:/^\S*$/'],
            'new_confirm_password' => ['required', 'same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('Password berhasil diupdate', 'Success');
        return redirect()->intended('profile/user');
    }

    /** change avatar */
    public function changeProfileImage(Request $request)
    {
        $user = User::find(auth()->user()->id);
        // Validasi request
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Sesuaikan dengan kebutuhan Anda
        ]);

        // Update image
        if ($request->hasFile('image')) {
            $oldImagePath = $user->image;

            // Mengunggah gambar baru
            $image = $request->file('image');
            $newImagePath = $image->store('public/users');

            if ($oldImagePath) {
                // Menghapus gambar lama jika ada
                Storage::disk('local')->delete('public/users/' . basename($oldImagePath));
            }

            $user->image = basename($newImagePath);
        }

        $user->save();

        // Berhasil mengubah avatar, lakukan sesuatu (misalnya, kembalikan response atau redirect)
        Toastr::success('Foto berhasil diupdate', 'Success');
        return redirect()->intended('profile/user');
    }
}
