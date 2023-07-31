<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\AuthenticationRequest;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     */
    public function authenticate(AuthenticationRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect('login')->withErrors([
                'username' => 'Username yang Anda masukkan salah.',
            ]);
        }

        // Memeriksa status akun sebelum proses otentikasi
        if ($user->status === 'Pending') {
            Toastr::warning('Harap Tunggu Persetujuan, Kami Akan Meninjau Anda Terlebih Dahulu');
            return redirect('login');
        }
        // Memeriksa status akun sebelum proses otentikasi
        if ($user->status === 'Nonaktif') {
            Toastr::error('Akun Anda Belum Diaktifkan');
            return redirect('login');
        }

        if (Auth::attempt($credentials)) {
            session([
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'role_name' => $user->role_name,
                'status' => $user->status,  
                'image' => $user->image,
                'users_id' => $user->users_id,
            ]);

            Toastr::success('Login berhasil.');
            return redirect()->intended('/');
        }

        Toastr::error('Username atau Password salah.');
        return redirect('login');
    }


    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Toastr::success('Logout Berhasil');
        return redirect('/');
    }
}
