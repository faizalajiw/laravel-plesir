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

class UserManagementController extends Controller
{
    // Index Page
    public function index()
    {
        $users = User::all();
        return view('usermanagement.list_users', compact('users'));
    }

    /** User View */
    public function usersView($id)
    {
        $users = User::where('id', $id)->first();
        $role = DB::table('role_type_users')->get();
        return view('usermanagement.user_update', compact('users', 'role'));
    }
    /** User View */

    /** User Form Create */
    public function usersFormCreate()
    {
        $role = DB::table('role_type_users')->get();
        return view('usermanagement.user_create', compact('role'));
    }
    /** User Form Create */

    /** User Create */
    public function usersCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => ['required', 'string', Rule::unique('users')->ignore($request->user()->id)],
            'email' => ['nullable', 'string', 'email', Rule::unique('users')->ignore($request->user()->id)],
            'role_name' => 'required|string',
            'new_password' => 'required|string|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_name = $request->role_name;
        $user->password = Hash::make($request->new_password);

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

    /** User Update */
    public function usersUpdate(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'name'          => ['required','regex:/^[A-Za-z\s]+$/'],
            'username'      => ['required','regex:/^\S*$/',Rule::unique('users')->ignore($request->id)],
            'email'         => ['required','email','regex:/^\S*$/',Rule::unique('users')->ignore($request->id)],
            'new_password'  => ['required','min:8','regex:/^\S*$/'],
            'role_name'     => ['required','string'],
            'avatar'        => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'],
        ]);

        $user = Auth::user();
        if ($user->role_name !== 'Super Admin') {
            Toastr::error('User Gagal Diupdate :)', 'Error');
            return redirect()->back();
        }

        $userToUpdate = User::find($request->id);
        if (!$userToUpdate) {
            Toastr::error('User Tidak Ditemukan :)', 'Error');
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

        Toastr::success('User Berhasil Diupdate :)', 'Success');
        return redirect()->to('/list/users');
    }
    /** User Update */

    /** User Delete */
    public function usersDelete(Request $request)
    {
        try {
            $userId = $request->id;
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
    /** User Delete */
}
