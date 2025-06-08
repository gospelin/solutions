<?php

//namespace App\Http\Controllers\Auth;

//use App\Http\Controllers\Controller;
//use App\Models\User;
//use App\Models\Tool;
//use Illuminate\Http\Request;
//use Illuminate\Http\RedirectResponse;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Log;
//use Spatie\Permission\Models\Role;
//use Illuminate\View\View;

//class AdminUserController extends Controller
//{
//    public function dashboard(): View
//    {
//        return view('admin.dashboard');
//    }

//    public function userManagement(): View
//    {
//        $users = User::with('roles')->get();
//        return view('admin.user-management', compact('users'));
//    }

//    public function toolModeration(Request $request): View
//    {
//        $search = $request->query('search');
//        $query = Tool::query();
//        if ($search) {
//            $query->search($search);
//        }
//        $tools = $query->paginate(5);
//        return view('admin.tool-moderation', compact('tools'));
//    }

//    public function reports(): View
//    {
//        return view('admin.reports');
//    }

//    public function systemSettings(): View
//    {
//        return view('admin.system-settings');
//    }

//    public function updateSystemSettings(Request $request): RedirectResponse
//    {
//        // Implement system settings update logic
//        return redirect()->route('admin.system-settings')->with('success', 'Settings updated!');
//    }

//    public function profile(): View
//    {
//        return view('admin.profile');
//    }

//    public function updateProfile(Request $request): RedirectResponse
//    {
//        try {
//            $request->validate([
//                'name' => 'required|string|max:255',
//                'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
//                'password' => 'nullable|string|min:8|confirmed',
//            ]);

//            $user = Auth::user();
//            if (!$user) {
//                Log::error('No authenticated user found during profile update', [
//                    'ip' => $request->ip(),
//                ]);
//                return redirect()->route('admin.profile')->with('error', 'Authentication error. Please log in again.');
//            }

//            $user->name = $request->name;
//            $user->email = $request->email;
//            if ($user->email !== $user->getOriginal('email')) {
//                $user->email_verified_at = null;
//                $user->sendEmailVerificationNotification();
//            }
//            if ($request->filled('password')) {
//                $user->password = Hash::make($request->password);
//            }

//            if (!$user->save()) {
//                Log::error('Failed to save user profile', [
//                    'user_id' => Auth::id(),
//                    'data' => $request->only('name', 'email'),
//                    'ip' => $request->ip(),
//                ]);
//                return redirect()->route('admin.profile')->with('error', 'Failed to update profile. Please try again.');
//            }

//            Log::info('Admin profile updated successfully', [
//                'user_id' => Auth::id(),
//                'data' => $request->only('name', 'email'),
//                'ip' => $request->ip(),
//            ]);

//            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
//        } catch (\Illuminate\Database\QueryException $e) {
//            Log::error('Database error during profile update', [
//                'user_id' => Auth::id(),
//                'error' => $e->getMessage(),
//                'ip' => $request->ip(),
//            ]);
//            return redirect()->route('admin.profile')->with('error', 'Database error. Please contact support.');
//        } catch (\Exception $e) {
//            Log::error('Unexpected error during profile update', [
//                'user_id' => Auth::id(),
//                'error' => $e->getMessage(),
//                'ip' => $request->ip(),
//            ]);
//            return redirect()->route('admin.profile')->with('error', 'An unexpected error occurred. Please try again.');
//        }
//    }

//    public function settings(): View
//    {
//        return view('admin.settings');
//    }

//    public function updateSettings(Request $request): RedirectResponse
//    {
//        // Implement settings update logic
//        return redirect()->route('admin.settings')->with('success', 'Settings updated!');
//    }

//    public function banUser(Request $request, $id): RedirectResponse
//    {
//        $user = User::findOrFail($id);
//        $user->status = $user->status === 'Banned' ? 'Active' : 'Banned';
//        $user->save();

//        Log::info('User ban status updated', [
//            'user_id' => $id,
//            'status' => $user->status,
//            'admin_id' => Auth::id(),
//            'ip' => $request->ip(),
//        ]);

//        return redirect()->route('admin.user-management')->with('success', 'User ban status updated!');
//    }

//    public function updateRole(Request $request, $id): RedirectResponse
//    {
//        $request->validate(['role' => 'required|in:user,admin']);
//        $user = User::findOrFail($id);
//        $user->syncRoles($request->role);

//        Log::info('User role updated', [
//            'user_id' => $id,
//            'role' => $request->role,
//            'admin_id' => Auth::id(),
//            'ip' => $request->ip(),
//        ]);

//        return redirect()->route('admin.user-management')->with('success', 'User role updated!');
//    }

//    public function deleteUser(Request $request, $id): RedirectResponse
//    {
//        if ($id == Auth::id()) {
//            Log::warning('Admin attempted to delete own account', [
//                'user_id' => $id,
//                'ip' => $request->ip(),
//            ]);
//            return redirect()->route('admin.user-management')->with('error', 'You cannot delete your own account.');
//        }

//        $user = User::findOrFail($id);

//        // Explicitly remove all roles assigned to the user
//        $user->roles()->detach();

//        $user->forceDelete();

//        Log::info('User permanently deleted', [
//            'user_id' => $id,
//            'user_email' => $user->email,
//            'user_name' => $user->name,
//            'admin_id' => Auth::id(),
//            'ip' => $request->ip(),
//        ]);

//        return redirect()->route('admin.user-management')->with('success', 'User permanently deleted!');
//    }

//    public function create(): View
//    {
//        return view('auth.admin-create');
//    }

//    public function store(Request $request): RedirectResponse
//    {
//        try {
//            $request->validate([
//                'name' => ['required', 'string', 'max:255'],
//                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
//                'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
//            ]);

//            $user = User::create([
//                'name' => $request->name,
//                'email' => $request->email,
//                'password' => Hash::make($request->password),
//                'email_verified_at' => now(),
//                'status' => 'Active',
//            ]);

//            $user->assignRole('admin');

//            Log::info('New admin created', [
//                'user_id' => $user->id,
//                'email' => $user->email,
//                'admin_id' => Auth::id(),
//                'ip' => $request->ip(),
//            ]);

//            return redirect()->route('admin.dashboard')->with('message', 'Admin created successfully!');
//        } catch (\Exception $e) {
//            Log::error('Failed to create admin', [
//                'error' => $e->getMessage(),
//                'ip' => $request->ip(),
//            ]);
//            return redirect()->route('admin.create')->with('error', 'Failed to create admin. Please try again.');
//        }
//    }

//    public function approveTool(Request $request, $id): RedirectResponse
//    {
//        $tool = Tool::findOrFail($id);
//        $tool->status = 'Approved';
//        $tool->save();

//        Log::info('Tool approved', [
//            'tool_id' => $id,
//            'tool_name' => $tool->name,
//            'admin_id' => Auth::id(),
//            'ip' => $request->ip(),
//        ]);

//        return redirect()->route('admin.tool-moderation')->with('success', 'Tool approved successfully!');
//    }

//    public function rejectTool(Request $request, $id): RedirectResponse
//    {
//        $tool = Tool::findOrFail($id);
//        $tool->status = 'Rejected';
//        $tool->save();

//        Log::info('Tool rejected', [
//            'tool_id' => $id,
//            'tool_name' => $tool->name,
//            'admin_id' => Auth::id(),
//            'ip' => $request->ip(),
//        ]);

//        return redirect()->route('admin.tool-moderation')->with('success', 'Tool rejected successfully!');
//    }
//}


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MarketItem;
use App\Models\Tool;
use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function dashboard(): View
    {
        $totalUsers = User::count();
        $activeTools = Tool::where('status', 'Approved')->count();
        $totalRevenue = Transaction::where('status', 'Completed')->sum('amount');
        $contactCount = Contact::count();
        $recentActivities = [
            // Fetch real activities (e.g., from a logs table or recent actions)
            ['icon' => 'bi-person-x', 'title' => 'User Banned', 'description' => 'Recent user ban action.', 'time' => '1h ago'],
            ['icon' => 'bi-tools', 'title' => 'Tool Approved', 'description' => 'New tool approved.', 'time' => '3h ago'],
        ];

        return view('admin.dashboard', compact('totalUsers', 'activeTools', 'totalRevenue', 'contactCount', 'recentActivities'));
    }

    public function userManagement(): View
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.user-management', compact('users'));
    }

    public function toolModeration(Request $request): View
    {
        $search = $request->query('search');
        $query = Tool::query();
        if ($search) {
            $query->search($search);
        }
        $tools = $query->paginate(10);
        return view('admin.tool-moderation', compact('tools', 'search'));
    }

    public function systemSettings(): View
    {
        return view('admin.system-settings');
    }

    public function updateSystemSettings(Request $request): RedirectResponse
    {
        // Placeholder for system settings (e.g., site name, API keys)
        $request->validate([
            'site_name' => 'required|string|max:255',
        ]);
        // Update settings in config or database
        Log::info('System settings updated', ['admin_id' => Auth::id(), 'ip' => $request->ip()]);
        return redirect()->route('admin.system-settings')->with('success', 'Settings updated!');
    }

    public function profile(): View
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request): RedirectResponse
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

            Log::info('Admin profile updated successfully', [
                'user_id' => Auth::id(),
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

    public function banUser(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'Banned' ? 'Active' : 'Banned';
        $user->save();

        Log::info('User ban status updated', [
            'user_id' => $id,
            'status' => $user->status,
            'admin_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.user-management')->with('success', 'User ban status updated!');
    }

    public function updateRole(Request $request, $id): RedirectResponse
    {
        $request->validate(['role' => 'required|in:user,admin']);
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);

        Log::info('User role updated', [
            'user_id' => $id,
            'role' => $request->role,
            'admin_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.user-management')->with('success', 'User role updated!');
    }

    public function deleteUser(Request $request, $id): RedirectResponse
    {
        if ($id == Auth::id()) {
            Log::warning('Admin attempted to delete own account', ['user_id' => $id, 'ip' => $request->ip()]);
            return redirect()->route('admin.user-management')->with('error', 'You cannot delete your own account.');
        }

        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->forceDelete();

        Log::info('User permanently deleted', [
            'user_id' => $id,
            'user_email' => $user->email,
            'user_name' => $user->name,
            'admin_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.user-management')->with('success', 'User permanently deleted!');
    }

    public function create(): View
    {
        return view('auth.admin-create');
    }

    //public function store(Request $request): RedirectResponse
    //{
    //    try {
    //        $request->validate([
    //            'name' => ['required', 'string', 'max:255'],
    //            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    //            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
    //        ]);

    //        $user = User::create([
    //            'name' => $request->name,
    //            'email' => $request->email,
    //            'password' => Hash::make($request->password),
    //            'email_verified_at' => now(),
    //            'status' => 'Active',
    //        ]);

    //        $user->assignRole('admin');

    //        Log::info('New admin created', [
    //            'user_id' => $user->id,
    //            'email' => $user->email,
    //            'admin_id' => Auth::id(),
    //            'ip' => $request->ip(),
    //        ]);

    //        return redirect()->route('admin.user-management')->with('success', 'Admin created successfully!');
    //    } catch (\Exception $e) {
    //        Log::error('Failed to create admin', ['error' => $e->getMessage(), 'ip' => $request->ip()]);
    //        return redirect()->route('admin.users.create')->with('error', 'Failed to create admin. Please try again.');
    //    }
    //}

    public function store(Request $request): RedirectResponse
    {
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
            ]);

            $user->assignRole('admin');

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

    public function approveTool(Request $request, $id): RedirectResponse
    {
        $marketItem = MarketItem::findOrFail($id);
        $marketItem->status = 'Approved';
        $marketItem->save();
        Log::info('Market item approved', [
            'item_id' => $id,
            'item_name' => $marketItem->name,
            'admin_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);
        return redirect()->route('admin.tools.index')->with('success', 'Market item approved successfully!');
    }

    public function rejectTool(Request $request, $id): RedirectResponse
    {
        $marketItem = MarketItem::findOrFail($id);
        $marketItem->status = 'Rejected';
        $marketItem->save();
        Log::info('Market item rejected', [
            'item_id' => $id,
            'item_name' => $marketItem->name,
            'admin_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);
        return redirect()->route('admin.tools.index')->with('success', 'Market item rejected successfully!');
    }
}
