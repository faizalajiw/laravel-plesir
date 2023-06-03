<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeFormController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** for side bar menu active */
if (!function_exists('set_active')) {
    function set_active($route)
    {
        if (is_array($route)) {
            return in_array(Request::path(), $route) ? 'active' : '';
        }
        return Request::path() == $route ? 'active' : '';
    }
}

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();

// ----------------------------login ------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

// ----------------------------- forgot password -------------------------//
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
    Route::post('password/new-password', 'newPassword')->name('password.update');
});

// ----------------------------- register -------------------------//
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeUser')->name('register.store');
});

// -------------------------- main dashboard ----------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->middleware('auth')->name('home');
    Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
    Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
    Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
});

// ----------------------------- profile controller -------------------------//
Route::controller(ProfileController::class)->group(function () {
    Route::post('change/detail', 'changeProfileDetail')->name('change/detail');
    Route::post('change/password', 'changeProfilePassword')->name('change/password');
    Route::post('change/avatar', 'changeProfileAvatar')->name('change/avatar');
});

// ----------------------------- user controller -------------------------//
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('list/users', [UserManagementController::class, 'index'])->name('list/users');
    Route::get('view/users/edit/{id}', [UserManagementController::class, 'usersView'])->name('view/users/edit');
    Route::get('users/create/request', [UserManagementController::class, 'usersFormCreate'])->name('users/create/request');
    Route::post('users/create', [UserManagementController::class, 'usersCreate'])->name('users/create');
    Route::post('users/update', [UserManagementController::class, 'usersUpdate'])->name('users/update');
    Route::post('users/delete', [UserManagementController::class, 'usersDelete'])->name('users/delete');
});

// ----------------------------- category controller -------------------------//
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('list/categories', [CategoryController::class, 'index'])->name('list/categories');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories/create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories/store');
});

// ------------------------ setting -------------------------------//
Route::controller(Setting::class)->group(function () {
    Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
});

// ----------------------- department -----------------------------//
Route::controller(DepartmentController::class)->group(function () {
    Route::get('department/add/page', 'indexDepartment')->middleware('auth')->name('department/add/page'); // page add department
});
