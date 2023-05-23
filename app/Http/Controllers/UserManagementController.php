<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
// use Auth;
// use Session;
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
use Illuminate\Support\Facades\Storage;


class UserManagementController extends Controller
{
    // index page
    public function index()
    {
        $users = User::all();
        return view('usermanagement.list_users', compact('users'));
    }

    /** user view */
    public function userView($id)
    {
        $users = User::where('user_id', $id)->first();
        return view('usermanagement.user_update', compact('users'));
    }

    /** User Update */
    public function userUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            if (Session::get('role_name') === 'Admin' || Session::get('role_name') === 'Super Admin') {
                $user_id      = $request->user_id;
                $name         = $request->name;
                $email        = $request->email;
                $role_name    = $request->role_name;
                $new_password = $request->new_password;

                // Mengambil file avatar yang diunggah (jika ada)
                $avatarFile = $request->file('avatar');

                // Hapus avatar lama jika ada dan ada file avatar yang diunggah
                $user = User::find($user_id);
                if ($user->avatar && $avatarFile) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // Menyimpan file avatar ke dalam storage link (jika ada file avatar yang diunggah)
                $avatarPath = $user->avatar;
                if ($avatarFile) {
                    $avatarPath = $avatarFile->store('avatars', 'public'); // Menyimpan dalam direktori 'avatars' di storage link 'public'
                }

                $update = [
                    'name'      => $name,
                    'role_name' => $role_name,
                    'email'     => $email,
                    'avatar'    => $avatarPath,
                ];
                
                // Update password jika ada perubahan
                if (!empty($new_password)) {
                    $update['password'] = Hash::make($new_password);
                }

                User::where('user_id', $user_id)->update($update);

                DB::commit();
                Toastr::success('User updated successfully :)', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('User update failed :)', 'Error');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User update failed :)', 'Error');
            return redirect()->back();
        }
    }

    /** user delete */
    public function userDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            if (Session::get('role_name') === 'Super Admin') {
                if ($request->avatar == 'photo_defaults.jpg') {
                    User::destroy($request->user_id);
                } else {
                    User::destroy($request->user_id);
                    unlink('images/' . $request->avatar);
                }
            } else {
                Toastr::error('User deleted fail :)', 'Error');
            }

            DB::commit();
            Toastr::success('User deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User deleted fail :)', 'Error');
            return redirect()->back();
        }
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
}
