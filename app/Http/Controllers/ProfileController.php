<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /** change email */
    public function changeEmail(Request $request)
    {
        $request->validate([
            'name'  => ['required'],
            'email' => ['required', 'email'],
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Toastr::success('User updated successfully', 'Success');
        Auth::logout(); // Logout the user
        return redirect()->route('logout'); // Redirect to the logout route
    }
    /** change password */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User change successfully :)', 'Success');
        return redirect()->intended('home');
    }

    /** change avatar */
    public function changeAvatar(Request $request)
    {
        // Validasi request
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Mengambil file avatar yang diunggah
        $avatarFile = $request->file('avatar');

        // Menyimpan file avatar ke dalam storage link
        $avatarPath = $avatarFile->store('avatar', 'public'); // Menyimpan dalam direktori 'avatars' di storage link 'public'

        // Update avatar path pada model user (misalnya)
        $user = User::where('id', auth()->user()->id)->first();
        $user->avatar = $avatarPath;
        $user->save();

        // Berhasil mengubah avatar, lakukan sesuatu (misalnya, kembalikan response atau redirect)

        return redirect()->back()->with('success', 'Avatar updated successfully.');
    }
}
