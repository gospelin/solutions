<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotifyReregisterController;
use App\Http\Controllers\SelarWebhookController;
use App\Http\Controllers\UserSearchController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\GuestContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\FreeAppController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->hasRole(['admin', 'superAdmin'])) {
            return redirect()->route('admin.dashboard');
        }
        return app(UserDashboardController::class)->index();
    })->name('user.dashboard');

    // User routes
    Route::get('/free-apps', [UserDashboardController::class, 'freeApps'])->name('free-apps');
    Route::get('/free-apps/{category}', [UserDashboardController::class, 'freeAppsCategory'])->name('free-apps.category');
    Route::get('/premium-features', [UserDashboardController::class, 'premiumFeatures'])->name('premium-features');
    Route::get('/community', [UserDashboardController::class, 'community'])->name('community');
    Route::get('/support', [UserDashboardController::class, 'support'])->name('support');
    Route::get('/market', [UserDashboardController::class, 'market'])->name('market');
    Route::get('/market/item/{id}', [UserDashboardController::class, 'marketItem'])->name('market.item');
    Route::get('/market/category/{category?}', [UserDashboardController::class, 'market'])->name('market.category');
    Route::get('/contact', [UserDashboardController::class, 'contact'])->name('contact');
    Route::post('/contact/submit', [UserDashboardController::class, 'contactSubmit'])->name('contact.submit');
    Route::get('/search', [UserSearchController::class, 'search'])->name('search');
    Route::get('/settings', [UserDashboardController::class, 'settings'])->name('user.settings');
    Route::post('/settings', [UserDashboardController::class, 'updateSettings'])->name('user.settings.update');
    Route::get('/subscription', [UserDashboardController::class, 'subscription'])->name('subscription');
    Route::get('/notifications', [UserDashboardController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{id}/read', [UserDashboardController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [UserDashboardController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::get('/user/dashboard/stats', [UserDashboardController::class, 'stats'])->name('user.dashboard.stats');
    Route::get('/user/test-notification', [UserDashboardController::class, 'triggerTestNotification'])->name('user.test-notification');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'check.status', 'role:admin|superAdmin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminUserController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/stats', [AdminUserController::class, 'getDashboardStats'])->name('dashboard.stats');
    Route::get('/settings', [AdminUserController::class, 'adminSettings'])->name('admin-settings');
    Route::post('/settings', [AdminUserController::class, 'updateSettings'])->name('admin-settings.update');
    Route::get('/system-settings', [AdminUserController::class, 'systemSettings'])->name('system-settings');

    // User management routes
    Route::get('/user-management', [AdminUserController::class, 'userManagement'])->name('user-management');
    Route::get('/admin-management', [AdminUserController::class, 'adminUserManagement'])->name('admin-management');
    Route::post('/users/{id}/ban', [AdminUserController::class, 'banUser'])->name('users.ban');
    Route::post('/users/{id}/role', [AdminUserController::class, 'updateRole'])->name('users.role');
    Route::delete('/users/{id}/delete', [AdminUserController::class, 'deleteUser'])->name('users.delete');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');

    // Profile routes
    Route::get('/profile', [AdminUserController::class, 'profile'])->name('admin-profile');
    Route::post('/profile', [AdminUserController::class, 'updateProfile'])->name('admin-profile.update');

    // Tool routes
    Route::post('/tools/{tool}/activate', [ToolController::class, 'activate'])->name('tools.activate');
    Route::post('/tools/{tool}/deactivate', [ToolController::class, 'deactivate'])->name('tools.deactivate');
    Route::resource('tools', ToolController::class)->except(['show']);
    Route::get('/tools/search', [SearchController::class, 'search'])->name('tools.search');

    // Free App routes
    Route::post('/free-apps/{freeApp}/activate', [FreeAppController::class, 'activate'])->name('free-apps.activate');
    Route::post('/free-apps/{freeApp}/deactivate', [FreeAppController::class, 'deactivate'])->name('free-apps.deactivate');
    Route::resource('free-apps', FreeAppController::class)->except(['show']);
    Route::get('/free-apps/search', [SearchController::class, 'searchFreeApps'])->name('free-apps.search');

    // Other admin routes
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
    Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
    Route::get('/logs', [LogController::class, 'index'])->name('logs');
    Route::post('/logs/clear', [LogController::class, 'clear'])->name('logs.clear');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::get('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
});

Route::get('/notify-reregister', [NotifyReregisterController::class, 'notify'])->name('notify.reregister');
Route::post('/webhook/selar', [SelarWebhookController::class, 'handle'])->name('webhook.selar');
Route::post('/contact', [GuestContactController::class, 'submit'])->name('guest-contact.submit');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

require __DIR__ . '/auth.php';
