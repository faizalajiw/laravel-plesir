<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
// use Hash;
// use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register()
    {
        $role = DB::table('role_type_users')->get();
        return view('auth.register', compact('role'));
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|string|email|max:150|unique:users',
            // 'role_name' => 'required|string|max:255',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        // $dt       = Carbon::now();
        // $todayDate = $dt->toDayDateTimeString();

        User::create([
            'name'      => $request->name,
            // 'avatar'    => $request->image,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_name' => 'Normal User',
            'avatar'    => 'photo_defaults.jpg',
            // 'join_date' => $todayDate,
            // 'role_name' => $request->role_name,
        ]);
        Toastr::success('Create new account successfully :)', 'Success');
        return redirect('login');
    }
}
