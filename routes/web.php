<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/free-apps', [UserDashboardController::class, 'freeApps'])->name('free-apps');
    Route::get('/premium-features', [UserDashboardController::class, 'premiumFeatures'])->name('premium-features');
    Route::get('/community', [UserDashboardController::class, 'community'])->name('community');
    Route::get('/support', [UserDashboardController::class, 'support'])->name('support');
    Route::get('/settings', [UserDashboardController::class, 'settings'])->name('settings');
    Route::post('/settings', [UserDashboardController::class, 'updateSettings'])->name('settings.update');
    Route::get('/subscription', [UserDashboardController::class, 'subscription'])->name('subscription');
});

Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'check.status', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user-management', [AdminController::class, 'userManagement'])->name('admin.user-management');
    Route::get('/tool-moderation', [AdminController::class, 'toolModeration'])->name('admin.tool-moderation');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/system-settings', [AdminController::class, 'systemSettings'])->name('admin.system-settings');
    Route::post('/system-settings', [AdminController::class, 'updateSystemSettings'])->name('admin.system-settings.update');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::post('/users/ban/{id}', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/users/role/{id}', [AdminController::class, 'updateRole'])->name('admin.users.role');
    Route::post('/tools/approve/{id}', [AdminController::class, 'approveTool'])->name('admin.tools.approve');
    Route::post('/tools/reject/{id}', [AdminController::class, 'rejectTool'])->name('admin.tools.reject');
});

require __DIR__ . '/auth.php';
