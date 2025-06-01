<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    public function userManagement(): View
    {
        $users = User::with('roles')->get();
        return view('admin.user-management', compact('users'));
    }

    public function toolModeration(): View
    {
        $tools = Tool::all();
        return view('admin.tool-moderation', compact('tools'));
    }

    public function reports(): View
    {
        return view('admin.reports');
    }

    public function systemSettings(): View
    {
        return view('admin.system-settings');
    }

    public function updateSystemSettings(Request $request): RedirectResponse
    {
        $request->validate([
            'maintenance_mode' => 'required|boolean',
            'api_key' => 'nullable|string',
            'max_users' => 'nullable|integer',
        ]);

        return redirect()->route('admin.system-settings')->with('success', 'Settings updated!');
    }

    public function profile(): View
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated!');
    }

    public function settings(): View
    {
        return view('admin.settings');
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $request->validate([
            'theme' => 'required|in:dark,light',
            'notifications' => 'required|boolean',
            'language' => 'required|in:en,es',
        ]);

        return redirect()->route('admin.settings')->with('success', 'Settings updated!');
    }

    public function banUser($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->status = ($user->status ?? 'Active') === 'Banned' ? 'Active' : 'Banned';
        $user->save();

        return redirect()->route('admin.user-management')->with('success', 'User status updated!');
    }

    public function updateRole(Request $request, $id): RedirectResponse
    {
        $request->validate(['role' => 'required|in:user,admin']);
        $user = User::findOrFail($id);
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.user-management')->with('success', 'User role updated!');
    }

    public function approveTool($id): RedirectResponse
    {
        $tool = Tool::findOrFail($id);
        $tool->status = 'Approved';
        $tool->save();

        return redirect()->route('admin.tool-moderation')->with('success', 'Tool approved!');
    }

    public function rejectTool($id): RedirectResponse
    {
        $tool = Tool::findOrFail($id);
        $tool->status = 'Rejected';
        $tool->save();

        return redirect()->route('admin.tool-moderation')->with('success', 'Tool rejected!');
    }
}
