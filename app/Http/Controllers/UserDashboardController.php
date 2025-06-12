<?php

namespace App\Http\Controllers;

use App\Events\UserNotification;
use App\Models\MarketItem;
use App\Models\FreeApp;
use App\Models\Notification;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $stats = $this->getUserStats();
        $activities = $this->getRecentActivities($user);
        $unreadNotificationsCount = \App\Models\Notification::where('user_id', $user->id)->where('read', false)->count();
        $unreadNotifications = \App\Models\Notification::where('user_id', $user->id)->where('read', false)->latest()->take(5)->get();

        return view('user.dashboard', compact('stats', 'activities', 'unreadNotificationsCount', 'unreadNotifications'));
    }

    public function stats(Request $request)
    {
        $stats = $this->getUserStats();
        return response()->json(['toolsUsed' => $stats['toolsUsed']]);
    }

    protected function getUserStats(): array
    {
        $toolsUsed = MarketItem::count();
        return ['toolsUsed' => $toolsUsed];
    }

    protected function getRecentActivities($user): array
    {
        return Notification::where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($notification) {
                return [
                    'icon' => 'bi-bell',
                    'title' => $notification->type,
                    'description' => $notification->message,
                    'time' => $notification->created_at->diffForHumans(),
                ];
            })
            ->toArray();
    }

    public function markAllRead(Request $request)
    {
        Notification::where('user_id', Auth::id())->where('read', false)->update(['read' => true]);
        return response()->json(['success' => true]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $profileUpdated = false;
        if ($user->name !== $validated['name'] || $user->email !== $validated['email']) {
            $profileUpdated = true;
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'Profile Updated',
                'message' => 'Your profile has been updated.',
                'read' => false,
            ]);
            event(new UserNotification($notification));
        }

        if ($validated['password']) {
            $user->update(['password' => Hash::make($validated['password'])]);
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'Password Updated',
                'message' => 'Your password has been changed.',
                'read' => false,
            ]);
            event(new UserNotification($notification));
        }

        return redirect()->route('user.settings')->with('success', 'Settings updated.');
    }

    public function triggerTestNotification(Request $request)
    {
        $user = Auth::user();
        $notification = Notification::create([
            'user_id' => $user->id,
            'type' => 'Test',
            'message' => 'This is a test notification.',
            'read' => false,
        ]);
        event(new UserNotification($notification));
        return redirect()->route('user.dashboard')->with('success', 'Test notification sent.');
    }

    // Other methods unchanged
    public function freeApps(Request $request, $category = null): View
    {
        $query = FreeApp::query()->active();
        if ($search = $request->query('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        if ($category) {
            $query->category($category);
        }
        $paginator = $query->orderBy('id')->paginate(7)->appends([
            'category' => $category,
            'search' => $search,
        ]);
        $categories = FreeApp::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values()
            ->toArray();
        Log::info('FreeApps data', [
            'category' => $category,
            'categories' => $categories,
            'paginator_count' => $paginator->count(),
        ]);
        return view('user.FreeApps', [
            'paginator' => $paginator,
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    public function freeAppsCategory($category): View
    {
        $slugs = FreeApp::whereNotNull('slug')
            ->where('slug', '!=', '')
            ->distinct()
            ->pluck('slug')
            ->map(fn($slug) => strtolower($slug))
            ->unique()
            ->toArray();
        if ($category && !in_array(strtolower($category), $slugs)) {
            Log::warning('Invalid category selected', ['category' => $category]);
            $query = FreeApp::query()->active();
            $paginator = $query->orderBy('id')->paginate(7);
            $categories = FreeApp::whereNotNull('category')
                ->where('category', '!=', '')
                ->distinct()
                ->pluck('category')
                ->sort()
                ->values()
                ->toArray();
            return view('user.FreeApps', [
                'paginator' => $paginator,
                'categories' => $categories,
                'category' => null,
                'error' => 'Invalid category selected.',
            ]);
        }
        return $this->freeApps(request()->merge(['category' => $category]));
    }

    public function premiumFeatures(): View
    {
        return view('user.premium-features');
    }

    public function community(): View
    {
        return view('user.community');
    }

    public function support(): View
    {
        return view('user.support');
    }

    public function settings(): View
    {
        return view('user.settings');
    }

    public function subscription(): View
    {
        return view('user.subscription');
    }

    public function market(Request $request, $category = null): View
    {
        $query = MarketItem::query();
        if ($search = $request->query('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        if ($category) {
            $dbCategory = Str::title(str_replace('-', ' ', $category));
            $query->where('category', $dbCategory);
        }
        $paginator = $query->orderBy('id')->paginate(10)->appends([
            'category' => $category,
            'search' => $search,
        ]);
        $categories = MarketItem::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values()
            ->toArray();
        return view('user.market', [
            'paginator' => $paginator,
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    public function contact(): View
    {
        return view('user.contact');
    }

    public function contactSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'user_id' => auth()->id(),
        ]);
        $notification = Notification::create([
            'user_id' => auth()->id(),
            'type' => 'Contact',
            'message' => 'Your support message has been sent.',
            'read' => false,
        ]);
        event(new UserNotification($notification));
        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }

    public function marketItem(int $id): View
    {
        Validator::make(['id' => $id], ['id' => 'required|numeric'])->validate();
        $item = MarketItem::findOrFail($id);
        return view('user.market', ['item' => $item]);
    }

    public function notifications(): View
    {
        $notifications = Notification::where('user_id', Auth::id())->latest()->paginate(10);
        return view('user.notifications', compact('notifications'));
    }

    public function markNotificationRead(Request $request, $id): RedirectResponse
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
        $notification->update(['read' => true]);
        return redirect()->route('notifications')->with('success', 'Notification marked as read.');
    }
}
