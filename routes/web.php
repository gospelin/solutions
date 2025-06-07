<?php

use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Auth\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotifyReregisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->name('home');

Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return app(UserDashboardController::class)->index();
    })->name('user.dashboard');

    // User routes
    Route::get('/free-apps', [UserDashboardController::class, 'freeApps'])->name('free-apps');
    Route::get('/premium-features', [UserDashboardController::class, 'premiumFeatures'])->name('premium-features');
    Route::get('/community', [UserDashboardController::class, 'community'])->name('community');
    Route::get('/support', [UserDashboardController::class, 'support'])->name('support');
    Route::get('/market', [UserDashboardController::class, 'market'])->name('market');
    Route::get('/market/item/{id}', [UserDashboardController::class, 'marketItem'])->name('market.item');
    Route::post('/market/purchase/{id}', [UserDashboardController::class, 'marketPurchase'])->name('market.purchase');
    Route::get('/market/category/{category?}', [UserDashboardController::class, 'market'])->name('market.category');
    Route::get('/settings', [UserDashboardController::class, 'settings'])->name('user.settings');
    Route::post('/settings', [UserDashboardController::class, 'updateSettings'])->name('user.settings.update');
    Route::get('/subscription', [UserDashboardController::class, 'subscription'])->name('subscription');

    // Profile routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'check.status', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminUserController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'userManagement'])->name('user-management');
    Route::get('/tools', [AdminUserController::class, 'toolModeration'])->name('tool-moderation');
    Route::get('/reports', [AdminUserController::class, 'reports'])->name('reports');
    Route::get('/system-settings', [AdminUserController::class, 'systemSettings'])->name('system-settings');
    Route::post('/system-settings', [AdminUserController::class, 'updateSystemSettings'])->name('system-settings.update');
    Route::get('/profile', [AdminUserController::class, 'profile'])->name('admin-profile');
    Route::get('/settings', [AdminUserController::class, 'settings'])->name('admin-settings');
    Route::post('/settings', [AdminUserController::class, 'updateSettings'])->name('admin-settings.update');
    Route::post('/users/{id}/ban', [AdminUserController::class, 'banUser'])->name('user.ban');
    Route::post('/users/{id}/role', [AdminUserController::class, 'updateRole'])->name('user.role');
    Route::delete('/users/{id}/delete', [AdminUserController::class, 'deleteUser'])->name('user.delete');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('create');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('store');
    Route::post('/tools/{id}/approve', [AdminUserController::class, 'approveTool'])->name('tool.approve');
    Route::post('/tools/{id}/reject', [AdminUserController::class, 'rejectTool'])->name('tool.reject');
    Route::get('/logs', [LogController::class, 'index'])->name('logs');
});

Route::get('/notify-reregister', [NotifyReregisterController::class, 'notify'])->name('notify.reregister');

require __DIR__ . '/auth.php';
