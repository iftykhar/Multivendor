<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard1', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard1');

Route::middleware('auth')->group(function (){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// User Route ///
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/update', [UserController::class, 'updateUser'])->name('dashboard.update');
    Route::get('/dashboard/logout', [UserController::class, 'userLogout'])->name('dashboard.logout');
});


///////////
/////////Admin Route/////////
/////////////
Route::middleware('auth','role:admin')->group(function(){
    Route::get('admin/dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/logout',[AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/profile',[AdminController::class, 'profile'])->name('admin.profile');
    Route::get('admin/change/password',[AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::post('admin/update/profile',[AdminController::class, 'updateProfile'])->name('admin.update.profile');
    Route::post('admin/update/password',[AdminController::class, 'updatePassword'])->name('admin.update.password');
});
Route::get('admin/login',[AdminController::class, 'login'])->name('admin.login');
////////////////////////
//////////vendor route////////
///////////// 
Route::middleware('auth','role:vendor')->group(function(){
    Route::get('vendor/dashboard',[VendorController::class, 'index'])->name('vendor.dashboard');
    Route::post('vendor/logout',[VendorController::class, 'logout'])->name('vendor.logout');
    Route::get('vendor/profile',[VendorController::class, 'profile'])->name('vendor.profile');
    Route::get('vendor/change/password',[VendorController::class, 'changePassword'])->name('vendor.change.password');
    Route::post('vendor/update/profile',[VendorController::class, 'updateProfile'])->name('vendor.update.profile');
    Route::post('vendor/update/password',[VendorController::class, 'updatePassword'])->name('vendor.update.password');
});
Route::get('vendor/login',[VendorController::class, 'login'])->name('vendor.login');

require __DIR__.'/auth.php';
