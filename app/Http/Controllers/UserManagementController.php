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
        try {
            $user = Auth::user();
            $request->validate([
                'user_id' => 'required',
                'name' => 'required|string',
                'email' => 'required|string|email',
                'role_name' => 'required|string',
                'new_password' => 'nullable|string|min:8',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($user->role_name !== 'Super Admin') {
                Toastr::error('User update failed :)', 'Error');
                return redirect()->back();
            }

            $userToUpdate = User::find($request->user_id);
            if (!$userToUpdate) {
                Toastr::error('User not found :)', 'Error');
                return redirect()->back();
            }

            $userToUpdate->name = $request->name;
            $userToUpdate->email = $request->email;
            $userToUpdate->role_name = $request->role_name;

            // Update password jika ada perubahan
            if ($request->new_password) {
                $userToUpdate->password = Hash::make($request->new_password);
            }

            // Menghapus avatar lama dan menyimpan avatar baru jika ada file avatar yang diunggah
            if ($request->hasFile('avatar')) {
                if ($userToUpdate->avatar) {
                    Storage::disk('public')->delete($userToUpdate->avatar);
                }

                $avatarPath = $request->file('avatar')->store('avatar', 'public');
                $userToUpdate->avatar = $avatarPath;
            }

            $userToUpdate->save();

            Toastr::success('User updated successfully :)', 'Success');
            return redirect()->to('/list/users');
        } catch (\Exception $e) {
            // Tangani pengecualian di sini
            Toastr::error('An error occurred during user update.', 'Error');
            return redirect()->back();
        }
    }


    /** User Delete */
    public function userDelete(Request $request)
    {
        try {
            $userId = $request->user_id;
            $user = User::find($userId);

            if (!$user) {
                Toastr::error('User not found :)', 'Error');
                return redirect()->back();
            }

            $user->forceDelete();

            Toastr::success('User deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('User delete failed :)', 'Error');
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
