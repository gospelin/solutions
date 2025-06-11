<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use App\Models\MarketItem;
use App\Models\Transaction;
use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    use AuthorizesRequests;

    public function dashboard()
    {
        if (!Auth::check() || !Auth::user()->hasRole(['admin', 'superAdmin'])) {
            return redirect()->route('login')->with('error', 'You must be logged in as an admin to access this page.');
        }

        if (Auth::user()->status === 'Banned') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is suspended. Contact support.');
        }

        // Calculate total users (excluding admins and superAdmins)
        $totalUsers = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superAdmin']);
        })->count();

        // Calculate user growth trend (e.g., compared to last month)
        $previousUsers = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superAdmin']);
        })->where('created_at', '<', now()->subMonth())->count();
        $userTrend = $previousUsers > 0 ? (($totalUsers - $previousUsers) / $previousUsers * 100) : 0;
        $userTrendValue = $userTrend > 0 ? '+' . number_format($userTrend, 1) . '%' : number_format($userTrend, 1) . '%';
        $userTrendStatus = $userTrend > 0 ? 'up' : ($userTrend < 0 ? 'down' : 'neutral');

        // User growth data for the chart (last 6 months)
        $userGrowthData = [];
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            $count = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['admin', 'superAdmin']);
            })->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $userGrowthData[] = $count;
            $labels[] = now()->subMonths($i)->format('M');
        }

        // Total tools
        $totalTools = MarketItem::count();
        $previousTools = MarketItem::where('created_at', '<', now()->subMonth())->count();
        $toolTrend = $previousTools > 0 ? (($totalTools - $previousTools) / $previousTools * 100) : 0;
        $toolTrendValue = $toolTrend > 0 ? '+' . number_format($toolTrend, 1) . '%' : number_format($toolTrend, 1) . '%';
        $toolTrendStatus = $toolTrend > 0 ? 'up' : ($toolTrend < 0 ? 'down' : 'neutral');

        // Total revenue
        $totalRevenue = Transaction::where('status', 'Completed')->sum('amount');
        $previousRevenue = Transaction::where('status', 'Completed')->where('created_at', '<', now()->subMonth())->sum('amount');
        $revenueTrend = $previousRevenue > 0 ? (($totalRevenue - $previousRevenue) / $previousRevenue * 100) : 0;
        $revenueTrendValue = $revenueTrend > 0 ? '+' . number_format($revenueTrend, 1) . '%' : number_format($revenueTrend, 1) . '%';
        $revenueTrendStatus = $revenueTrend > 0 ? 'up' : ($revenueTrend < 0 ? 'down' : 'neutral');

        // Contact submissions
        $contactCount = Contact::count();
        $previousContacts = Contact::where('created_at', '<', now()->subMonth())->count();
        $contactTrend = $previousContacts > 0 ? (($contactCount - $previousContacts) / $previousContacts * 100) : 0;
        $contactTrendValue = $contactTrend > 0 ? '+' . number_format($contactTrend, 1) . '%' : number_format($contactTrend, 1) . '%';
        $contactTrendStatus = $contactTrend > 0 ? 'up' : ($contactTrend < 0 ? 'down' : 'neutral');

        // Recent activities
        $recentActivities = Notification::where('user_id', Auth::id())
            ->where('read', false)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'icon' => 'bi-bell',
                    'title' => $notification->type,
                    'description' => $notification->message,
                    'time' => $notification->created_at->diffForHumans(),
                ];
            })->toArray();

        return view('admin.dashboard', compact(
            'totalUsers',
            'userTrendValue',
            'userTrendStatus',
            'userGrowthData',
            'labels',
            'totalTools',
            'toolTrendValue',
            'toolTrendStatus',
            'totalRevenue',
            'revenueTrendValue',
            'revenueTrendStatus',
            'contactCount',
            'contactTrendValue',
            'contactTrendStatus',
            'recentActivities'
        ));
    }

    public function getDashboardStats()
    {
        $totalUsers = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superAdmin']);
        })->count();

        $previousUsers = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superAdmin']);
        })->where('created_at', '<', now()->subMonth())->count();
        $userTrend = $previousUsers > 0 ? (($totalUsers - $previousUsers) / $previousUsers * 100) : 0;
        $userTrendValue = $userTrend > 0 ? '+' . number_format($userTrend, 1) . '%' : number_format($userTrend, 1) . '%';
        $userTrendStatus = $userTrend > 0 ? 'up' : ($userTrend < 0 ? 'down' : 'neutral');

        // User growth data and labels for the chart (last 6 months)
        $userGrowthData = [];
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            $count = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['admin', 'superAdmin']);
            })->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $userGrowthData[] = $count;
            $labels[] = now()->subMonths($i)->format('M');
        }

        $totalTools = MarketItem::count();
        $previousTools = MarketItem::where('created_at', '<', now()->subMonth())->count();
        $toolTrend = $previousTools > 0 ? (($totalTools - $previousTools) / $previousTools * 100) : 0;
        $toolTrendValue = $toolTrend > 0 ? '+' . number_format($toolTrend, 1) . '%' : number_format($toolTrend, 1) . '%';
        $toolTrendStatus = $toolTrend > 0 ? 'up' : ($toolTrend < 0 ? 'down' : 'neutral');

        $totalRevenue = Transaction::where('status', 'Completed')->sum('amount');
        $previousRevenue = Transaction::where('status', 'Completed')->where('created_at', '<', now()->subMonth())->sum('amount');
        $revenueTrend = $previousRevenue > 0 ? (($totalRevenue - $previousRevenue) / $previousRevenue * 100) : 0;
        $revenueTrendValue = $revenueTrend > 0 ? '+' . number_format($revenueTrend, 1) . '%' : number_format($revenueTrend, 1) . '%';
        $revenueTrendStatus = $revenueTrend > 0 ? 'up' : ($revenueTrend < 0 ? 'down' : 'neutral');

        $contactCount = Contact::count();
        $previousContacts = Contact::where('created_at', '<', now()->subMonth())->count();
        $contactTrend = $previousContacts > 0 ? (($contactCount - $previousContacts) / $previousContacts * 100) : 0;
        $contactTrendValue = $contactTrend > 0 ? '+' . number_format($contactTrend, 1) . '%' : number_format($contactTrend, 1) . '%';
        $contactTrendStatus = $contactTrend > 0 ? 'up' : ($contactTrend < 0 ? 'down' : 'neutral');

        return response()->json([
            'totalUsers' => number_format($totalUsers),
            'userTrendValue' => $userTrendValue,
            'userTrendStatus' => $userTrendStatus,
            'userGrowthData' => $userGrowthData,
            'labels' => $labels,
            'totalTools' => number_format($totalTools),
            'toolTrendValue' => $toolTrendValue,
            'toolTrendStatus' => $toolTrendStatus,
            'totalRevenue' => '$' . number_format($totalRevenue, 2),
            'revenueTrendValue' => $revenueTrendValue,
            'contactCount' => number_format($contactCount),
            'contactTrendValue' => $contactTrendValue,
            'contactTrendStatus' => $contactTrendStatus,
        ]);
    }

    public function userManagement(Request $request)
    {
        $search = $request->query('search');
        $users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ?: $query->where('email', 'like', '%' . $search);
            })
            ->with('roles')
            ->orderBy('id')
            ->paginate(7);

        return view('admin.user-management', compact('users', 'search'));
    }

    public function adminUserManagement(Request $request)
    {
        $search = $request->query('search');
        $users = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin'); // Only admins, excludes superAdmin
            })
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ?: $query->where('email', 'like', '%' . $search);
            })
            ->with('roles')
            ->orderBy('id')
            ->paginate(7);

        return view('admin.admin-user-management', compact('users', 'search'));
    }

    public function banUser(Request $request, $id)
    {
        $this->authorize('manage users');
        $user = User::findOrFail($id);
        try {
            // Prevent admin from banning superAdmin
            if ($user->hasRole('superAdmin') && !Auth::user()->hasRole('superAdmin')) {
                Log::warning('Admin attempted to ban superAdmin', [
                    'target_user_id' => $user->id,
                    'target_email' => $user->email,
                    'admin_id' => Auth::id(),
                    'ip' => $request->ip(),
                ]);
                return redirect()->route('admin.user-management')
                    ->with('error', 'You do not have permission to ban a superAdmin.');
            }

            // Prevent banning self
            if ($user->id === Auth::id()) {
                return redirect()->route('admin.user-management')
                    ->with('error', 'You cannot ban yourself.');
            }

            $user->status = $user->status === 'Banned' ? 'Admin' : 'Banned';
            $user->save();

            // Notify admins
            $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => $user->status === 'Banned' ? 'User Banned' : 'User Unbanned',
                    'message' => "User '{$user->name}' (email: {$user->email}) has been " . ($user->status === 'Banned' ? 'banned' : 'unbanned') . ".",
                ]);
            }

            Log::info('User banned', [
                'user_id' => $user->id,
                'email' => $user->email,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
            ]);

            return redirect()->back()
                ->with('success', 'User Status: ' . $user->status);
        } catch (\Exception $e) {
            Log::error('Failed to ban user', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return redirect()->back()
                ->with('error', 'Failed to ban user. Please try again.');
        }
    }

    public function deleteUser(Request $request, $id)
    {
        $this->authorize('manage users');
        $user = User::findOrFail($id);

        try {
            // Prevent admin from deleting superAdmin
            if ($user->hasRole('superAdmin') && !Auth::user()->hasRole('superAdmin')) {
                Log::warning('Admin attempted to delete superAdmin', [
                    'target_user_id' => $user->id,
                    'target_email' => $user->email,
                    'admin_id' => Auth::id(),
                    'ip' => $request->ip(),
                ]);
                return redirect()->back()
                    ->with('error', 'You do not have permission to delete a superAdmin.');
            }

            // Prevent deleting self
            if ($user->id === Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You cannot delete yourself.');
            }

            // Detach roles
            $user->roles()->detach();

            // Delete related data
            if ($user->notifications) {
                $user->notifications()->delete();
            }

            // Permanent delete
            $user->forceDelete();

            // Notify admins
            $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'User Deleted',
                    'message' => "User '{$user->name}' (email: {$user->email}) has been permanently deleted.",
                ]);
            }

            Log::info('User permanently deleted', [
                'user_id' => $user->id,
                'email' => $user->email,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
            ]);

            return redirect()->back()
                ->with('success', 'User permanently deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete user', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return redirect()->back()
                ->with('error', 'Failed to delete user. Please try again.');
        }
    }

    public function profile(): \Illuminate\Contracts\View\View
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            $user = Auth::user();
            if (!$user) {
                Log::error('No authenticated user found during profile update', ['ip' => $request->ip()]);
                return redirect()->route('admin.admin-profile')->with('error', 'Authentication error. Please log in again.');
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if ($user->email !== $user->getOriginal('email')) {
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if (!$user->save()) {
                Log::error('Failed to save user profile', [
                    'user_id' => Auth::id(),
                    'data' => $request->only('name', 'email'),
                    'ip' => $request->ip(),
                ]);
                return redirect()->route('admin.admin-profile')->with('error', 'Failed to update profile. Please try again.');
            }

            Notification::create([
                'user_id' => $user->id,
                'type' => 'Profile Updated',
                'message' => 'Your profile has been updated.',
            ]);

            Log::info('Admin profile updated successfully', [
                'user_id' => $user->id,
                'data' => $request->only('name', 'email'),
                'ip' => $request->ip(),
            ]);

            return redirect()->route('admin.admin-profile')->with('success', 'Profile updated successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error during profile update', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('admin.admin-profile')->with('error', 'Database error. Please contact support.');
        } catch (\Exception $e) {
            Log::error('Unexpected error during profile update', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('admin.admin-profile')->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function systemSettings(): \Illuminate\Contracts\View\View
    {
        $this->authorize('manage settings');
        return view('admin.system-settings');
    }

    public function adminSettings(): \Illuminate\Contracts\View\View
    {
        $this->authorize('manage settings');
        return view('admin.admin-settings');
    }

    public function updateSettings(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('manage settings');

        try {
            $request->validate([
                'theme' => 'required|in:dark,light',
                'notifications' => 'required|boolean',
                'language' => 'required|in:en,es',
            ]);

            $user = Auth::user();
            if (!$user) {
                Log::error('No authenticated user found during settings update', ['ip' => $request->ip()]);
                return redirect()->route('admin.admin-settings')->with('error', 'Authentication error. Please log in again.');
            }

            $user->theme = $request->theme;
            $user->notifications = $request->notifications;
            $user->language = $request->language;
            $user->save();

            // Create a notification
            Notification::create([
                'user_id' => $user->id,
                'type' => 'Settings Updated',
                'message' => 'Your personal settings have been updated.',
            ]);

            Log::info('Admin settings updated', [
                'user_id' => $user->id,
                'data' => $request->only('theme', 'notifications', 'language'),
                'ip' => $request->ip(),
            ]);

            return redirect()->route('admin.admin-settings')->with('success', 'Settings updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error during settings update', [
                'user_id' => Auth::id(),
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('admin.admin-settings')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error during settings update', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('admin.admin-settings')->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function updateRole(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('manage users');

        $request->validate(['role' => 'required|in:user,admin']);

        $user = User::findOrFail($id);
        if ($user->hasRole('superAdmin') && !Auth::user()->hasRole('superAdmin')) {
            Log::warning('Admin attempted to update superAdmin role', [
                'user_id' => $id,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('admin.user-management')->with('error', 'You cannot update a superAdmin role.');
        }

        $user->syncRoles($request->role);

        Notification::create([
            'user_id' => $user->id,
            'type' => 'Role Updated',
            'message' => 'Your role has been updated to ' . $request->role . '.',
        ]);

        Log::info('User role updated', [
            'user_id' => $id,
            'role' => $request->role,
            'admin_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.user-management')->with('success', 'User role updated!');
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        $this->authorize('manage admins');
        return view('auth.admin-create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('manage admins');

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
                'status' => 'Active',
                'theme' => 'dark',
                'notifications' => true,
                'language' => 'en',
            ]);

            $user->assignRole('admin');

            Notification::create([
                'user_id' => $user->id,
                'type' => 'Account Created',
                'message' => 'A new admin account has been created',
            ]);

            Log::info('New admin created', [
                'user_id' => $user->id,
                'email' => $user->email,
                'admin_id' => Auth::id(),
                'ip' => $request->ip(),
            ]);

            return redirect()->route('admin.user-management')->with('success', 'Admin created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create admin', ['error' => $e->getMessage(), 'ip' => $request->ip()]);
            return redirect()->route('admin.users.create')->with('error', 'Failed to create admin. Please try again.');
        }
    }
}