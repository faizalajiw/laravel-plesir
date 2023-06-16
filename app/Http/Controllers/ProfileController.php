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

    /** change detail akun */
    public function changeProfileDetail(Request $request)
    {
        $request->validate([
            'name'      => ['required','regex:/^[A-Za-z\s]+$/'],
            'username'  => ['required','max:50','regex:/^\S*$/', Rule::unique('users')->ignore(auth()->user()->id),],
            'email'     => ['required','email','regex:/^\S*$/', Rule::unique('users')->ignore(auth()->user()->id),],
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
            'new_password'         => ['required','min:8','regex:/^\S*$/'],
            'new_confirm_password' => ['required','same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('Password berhasil diupdate', 'Success');
        return redirect()->intended('profile/user');
    }

    /** change avatar */
    public function changeProfileAvatar(Request $request)
    {
        // Validasi request
        $request->validate([
            'avatar' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'], // Sesuaikan dengan kebutuhan Anda
        ]);

        // Mengambil file avatar yang diunggah
        $avatarFile = $request->file('avatar');

        // Menyimpan file avatar ke dalam storage link
        $avatarPath = $avatarFile->store('avatar', 'public'); // Menyimpan dalam direktori 'avatars' di storage link 'public'

        // Update avatar path pada model user (misalnya)
        $user = User::where('id', auth()->user()->id)->first();

        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = $avatarPath;
        $user->save();

        // Update data avatar dalam variabel Session
        Session::put('avatar', $avatarPath);

        // Berhasil mengubah avatar, lakukan sesuatu (misalnya, kembalikan response atau redirect)
        Toastr::success('Avatar berhasil diupdate', 'Success');
        return redirect()->intended('profile/user');
    }
}
