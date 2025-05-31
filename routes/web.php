<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/free-apps', [UserDashboardController::class, 'freeApps'])->name('free-apps');
    Route::get('/premium-features', [UserDashboardController::class, 'premiumFeatures'])->name('premium-features');
    Route::get('/community', [UserDashboardController::class, 'community'])->name('community');
    Route::get('/support', [UserDashboardController::class, 'support'])->name('support');
    //Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::get('/settings', [UserDashboardController::class, 'settings'])->name('settings');
    Route::get('/subscription', [UserDashboardController::class, 'subscription'])->name('subscription');
});

//Route::middleware(['auth'])->group(function () {
//    Route::get('/user/dashboard', function () {
//        return view('user.dashboard');
//    })->name('user.dashboard');

//    Route::get('/admin/dashboard', function () {
//        return view('admin.dashboard');
//    })->middleware('role:admin')->name('admin.dashboard');
//});

// User Dashboard Route
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// Admin Dashboard Route
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});


require __DIR__.'/auth.php';
