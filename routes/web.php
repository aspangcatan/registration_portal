<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Redirect '/' based on auth
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('admin.pending-users.index')
        : redirect()->route('login.form');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration
Route::get('/registration', function () {
    return view('registration');
})->name('registration.form');
Route::post('/register', [ApplicationController::class, 'storePendingUser'])->name('storePendingUser');

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pending-users', [AdminController::class, 'index'])->name('pending-users.index');
    Route::patch('/pending-users/{id}/approve', [AdminController::class, 'approve'])->name('pending-users.approve');
    Route::patch('/pending-users/{id}/reject', [AdminController::class, 'reject'])->name('pending-users.reject');

    // Dropdown data
    Route::get('/get_master_lists', [ApplicationController::class, 'getDropdownData'])->name('getDropDownData');
    Route::get('/address/provinces', [ApplicationController::class, 'getProvinces'])->name('getProvinces');
    Route::get('/address/cities/{provCode}', [ApplicationController::class, 'getCities'])->name('getCities');
    Route::get('/address/barangays/{citymunCode}', [ApplicationController::class, 'getBarangays'])->name('getBarangays');
});
