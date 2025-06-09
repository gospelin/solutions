<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use App\Models\FreeApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{
    public function index(): View
    {
        return view('user.dashboard');
    }

    /**
     * Display the free apps marketplace with paginated items and category filtering.
     */
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

        // Fetch distinct, non-null categories
        $categories = FreeApp::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values()
            ->toArray();

        \Log::info('FreeApps data', [
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

    /**
     * Handle free apps category filtering.
     */
    public function freeAppsCategory($category): View
    {
        // Validate category against existing slugs
        $slugs = FreeApp::whereNotNull('slug')
            ->where('slug', '!=', '')
            ->distinct()
            ->pluck('slug')
            ->map(fn($slug) => strtolower($slug))
            ->unique()
            ->toArray();

        if ($category && !in_array(strtolower($category), $slugs)) {
            \Log::warning('Invalid category selected', ['category' => $category]);
            return redirect()->route('free-apps')->with('error', 'Invalid category selected.');
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

    public function updateSettings(Request $request): RedirectResponse
    {
        // Placeholder for settings update logic
        return redirect()->route('user.settings')->with('success', 'Settings updated.');
    }

    public function subscription(): View
    {
        return view('user.subscription');
    }

    /**
     * Display the main marketplace with paginated items and category filtering.
     */
    public function market(Request $request, $category = null): View
    {
        $query = MarketItem::query();

        if ($search = $request->query('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($category) {
            // Convert slug back to database category format
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

        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }

    /**
     * Display a single market item.
     */
    public function marketItem($id): View
    {
        // Validate ID
        Validator::make(['id' => $id], ['id' => 'required|numeric'])->validate();

        // Fetch item or fail
        $item = MarketItem::findOrFail($id);

        return view('user.market-item', compact('item'));
    }
}