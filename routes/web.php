<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryOrderController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Web\FrontendController as FrontendController;
use App\Http\Controllers\Web\OrderController;
use App\Models\Category;
use App\Models\Slider;
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
    $sliders = Slider::all();
    // card category
    $categories = Category::oldest()->get();
    return view('web.index', compact('categories', 'sliders'));
})->name('/');

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
Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->middleware('auth', 'role:Super Admin')->name('dashboard');
    Route::get('dashboard/admin-wisata', 'indexAdminWisata')->middleware('auth', 'role:Admin Wisata')->name('dashboard/admin-wisata');
    Route::get('dashboard/user', 'indexUser')->middleware('auth', 'role:Pengguna')->name('dashboard/user');
    Route::get('dashboard/filter', 'search')->middleware(['auth', 'role:Admin Wisata'])->name('dashboard/filter');
});

// ----------------------------- profile controller -------------------------//
Route::controller(ProfileController::class)->group(function () {
    Route::get('profile/user', 'index')->middleware('auth')->name('profile/user');
    Route::post('change/detail', 'changeProfileDetail')->middleware('auth')->name('change/detail');
    Route::post('change/password', 'changeProfilePassword')->middleware('auth')->name('change/password');
    Route::post('change/image', 'changeProfileImage')->middleware('auth')->name('change/image');
});

// ----------------------------- user management controller -------------------------//
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('list/users', [UserManagementController::class, 'index'])->name('list/users');
    Route::get('users/search', [UserManagementController::class, 'search'])->name('users/search');
    Route::get('users/create', [UserManagementController::class, 'create'])->name('users/create');
    Route::post('users/store', [UserManagementController::class, 'store'])->name('users/store');
    Route::get('view/users/edit/{id}', [UserManagementController::class, 'edit'])->name('view/users/edit');
    Route::post('users/update', [UserManagementController::class, 'update'])->name('users/update');
    Route::post('users/delete', [UserManagementController::class, 'delete'])->name('users/delete');

    // ONLY 1 ROLE
    Route::get('list/users/admin', [UserManagementController::class, 'showAdmin'])->name('list/users/admin');
    Route::get('list/users/pengguna', [UserManagementController::class, 'showPengguna'])->name('list/users/pengguna');
    // ONLY 1 ROLE
});

// ----------------------------- category controller -------------------------//
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('list/categories', [CategoryController::class, 'index'])->name('list/categories');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories/create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories/store');
    Route::get('view/categories/edit/{id}', [CategoryController::class, 'edit'])->name('view/categories/edit');
    Route::post('categories/update', [CategoryController::class, 'update'])->name('categories/update');
    Route::post('categories/delete', [CategoryController::class, 'delete'])->name('categories/delete');
});

// ----------------------------- place controller -------------------------//
Route::controller(PlaceController::class)->group(function () {
    Route::get('list/places', 'index')->middleware(['auth', 'role:Super Admin'])->name('list/places');
    Route::get('list/my_places', 'myPlace')->middleware(['auth', 'role:Admin Wisata'])->name('list/my_places');
    Route::get('places/search', 'search')->middleware(['auth', 'role:Super Admin,Admin Wisata'])->name('places/search');
    Route::get('places/create', 'create')->middleware(['auth', 'role:Admin Wisata'])->name('places/create');
    Route::post('places/store', 'store')->middleware(['auth', 'role:Admin Wisata'])->name('places/store');
    Route::get('view/places/edit/{id}', 'edit')->middleware(['auth', 'role:Admin Wisata'])->name('view/places/edit');
    Route::post('places/update', 'update')->middleware(['auth', 'role:Admin Wisata'])->name('places/update');
    Route::post('places/delete', 'delete')->middleware(['auth', 'role:Super Admin,Admin Wisata'])->name('places/delete');
});

// ----------------------------- visitor controller -------------------------//
Route::controller(VisitorController::class)->group(function () {
    Route::get('list/visitor', 'index')->middleware(['auth', 'role:Super Admin'])->name('list/visitor');
    Route::get('list/history', 'history')->middleware(['auth', 'role:Admin Wisata'])->name('list/history');
    Route::get('visitor/create', 'create')->middleware(['auth', 'role:Admin Wisata'])->name('visitor/create');
    Route::post('visitor/store', 'store')->middleware(['auth', 'role:Admin Wisata'])->name('visitor/store');
    Route::get('view/visitor/edit/{id}', 'edit')->middleware(['auth', 'role:Admin Wisata'])->name('view/visitor/edit');
    Route::post('visitor/update', 'update')->middleware(['auth', 'role:Admin Wisata'])->name('visitor/update');
    Route::post('visitor/delete', 'delete')->middleware(['auth', 'role:Admin Wisata'])->name('visitor/delete');
});

// ----------------------------- review controller -------------------------//
Route::controller(ReviewController::class)->group(function () {
    // Only Admin Wisata
    Route::get('list/my_review_tempat', 'myReviewTempat')->middleware(['auth', 'role:Admin Wisata'])->name('list/my_review_tempat');
    Route::get('my_review_tempat/detail/{id}', 'detail')->middleware(['auth', 'role:Admin Wisata'])->name('my_review_tempat/detail');
    
    Route::get('list/my_review', 'myReview')->middleware(['auth', 'role:Pengguna'])->name('list/my_review');
    Route::get('review/create', 'create')->middleware(['auth', 'role:Pengguna'])->name('review/create');
    Route::post('review/store', 'store')->middleware(['auth', 'role:Pengguna'])->name('review/store');
    // Route::get('view/review/edit/{id}', 'edit')->middleware(['auth', 'role:Super Admin,Admin Wisata'])->name('view/review/edit');
    // Route::post('review/update', 'update')->middleware(['auth', 'role:Super Admin,Admin Wisata'])->name('review/update');
    Route::post('review/delete/{id}', 'delete')->middleware(['auth'])->name('review/delete');
});

// ----------------------------- history order controller -------------------------//
Route::controller(HistoryOrderController::class)->group(function () {
    Route::get('list/history-order', 'index')->middleware(['auth', 'role:Pengguna'])->name('list/history-order');
});

// ----------------------------- slider banner controller -------------------------//
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('list/sliders', [SliderController::class, 'index'])->name('list/sliders');
    Route::get('sliders/create', [SliderController::class, 'create'])->name('sliders/create');
    Route::post('sliders/store', [SliderController::class, 'store'])->name('sliders/store');
    Route::get('view/sliders/edit/{id}', [SliderController::class, 'edit'])->name('view/sliders/edit');
    Route::post('sliders/update', [SliderController::class, 'update'])->name('sliders/update');
    Route::post('sliders/delete', [SliderController::class, 'delete'])->name('sliders/delete');
});

// ------------------------ LANDING PAGE -------------------------------//
Route::prefix('web')->group(function () {
    Route::get('jelajah-wisata/{slug?}', [FrontendController::class, 'allPlace'])->name('jelajah-wisata');    
    Route::get('kategori/{slug?}', [FrontendController::class, 'showByCategory'])->name('kategori');    
    Route::get('detail-wisata/{slug?}', [FrontendController::class, 'showDetail'])->name('detail-wisata'); 
    Route::get('rute-wisata/{slug}', [FrontendController::class, 'showDirection'])->name('rute-wisata');   
    Route::get('cari-wisata/{slug?}', [FrontendController::class, 'searchPlace'])->name('cari-wisata'); 
    Route::get('kerjasama', [FrontendController::class, 'partnership'])->name('kerjasama'); 
    Route::get('pesan-tiket', [OrderController::class, 'index'])->name('pesan-tiket'); 
    Route::post('checkout/{id}', [OrderController::class, 'checkout'])->name('checkout'); 
    Route::get('checkout/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');
});