<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register()
    {
        $users = User::all();
        return view('auth.register', compact('users'));
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'              => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'username'          => ['required', 'max:50', 'regex:/^\S*$/', Rule::unique('users')->ignore(auth()->id(), 'id')],
            'email'             => ['required', 'email', 'regex:/^\S*$/', Rule::unique('users')->ignore(auth()->id(), 'id')],
            'password'          => ['required', 'min:8', 'regex:/^\S*$/'],
            'confirm_password'  => ['same:password'],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_name' => 'Pengguna',
        ]);

        // Menghasilkan users_id sesuai dengan pola yang diinginkan
        $user->users_id = 'USER' . Str::upper(Str::random(6)); // contoh pola untuk pengguna
        $user->save();

        Toastr::success('Create new account successfully :)', 'Success');
        return redirect('login');
    }
}
