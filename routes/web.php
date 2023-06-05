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
use App\Http\Controllers\PlaceController;
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
    Route::get('profile/user', 'userProfile')->middleware('auth')->name('profile/user');
    Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
    Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
});

// ----------------------------- profile controller -------------------------//
Route::controller(ProfileController::class)->group(function () {
    Route::post('change/detail', 'changeProfileDetail')->middleware('auth')->name('change/detail');
    Route::post('change/password', 'changeProfilePassword')->middleware('auth')->name('change/password');
    Route::post('change/avatar', 'changeProfileAvatar')->middleware('auth')->name('change/avatar');
});

// ----------------------------- user management controller -------------------------//
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    // SEMUA PENGGUNA
    Route::get('list/users', [UserManagementController::class, 'index'])->name('list/users');
    Route::get('users/search', [UserManagementController::class, 'search'])->name('users/search');
    Route::get('users/create', [UserManagementController::class, 'create'])->name('users/create');
    Route::post('users/store', [UserManagementController::class, 'store'])->name('users/store');
    Route::get('view/users/edit/{id}', [UserManagementController::class, 'edit'])->name('view/users/edit');
    Route::post('users/update', [UserManagementController::class, 'update'])->name('users/update');
    Route::post('users/delete', [UserManagementController::class, 'delete'])->name('users/delete');
    // SEMUA PENGGUNA

    // ONLY 1 ROLE
    Route::get('list/users/super', [UserManagementController::class, 'showSuper'])->name('list/users/super');
    Route::get('list/users/admin', [UserManagementController::class, 'showAdmin'])->name('list/users/admin');
    Route::get('list/users/pengguna', [UserManagementController::class, 'showPengguna'])->name('list/users/pengguna');
    // ONLY 1 ROLE
});

// ----------------------------- category controller -------------------------//
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('list/categories', [CategoryController::class, 'index'])->name('list/categories');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories/create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories/store');
    Route::post('categories/delete', [CategoryController::class, 'delete'])->name('categories/delete');
});

// ----------------------------- place controller -------------------------//
Route::controller(PlaceController::class)->group(function () {
    Route::get('list/places', 'index')->middleware('auth')->name('list/places');
    Route::get('places/create', 'create')->middleware('auth')->name('places/create');
    Route::post('places/store', 'store')->middleware('auth')->name('places/store');
});

// ------------------------ setting -------------------------------//
Route::controller(Setting::class)->group(function () {
    Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
});

// ----------------------- department -----------------------------//
Route::controller(DepartmentController::class)->group(function () {
    Route::get('department/add/page', 'indexDepartment')->middleware('auth')->name('department/add/page'); // page add department
});
