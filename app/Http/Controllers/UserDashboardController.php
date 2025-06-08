<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;


class UserDashboardController extends Controller
{
    // Placeholder for other methods
    public function index(): View
    {
        return view('user.dashboard');
    }

    public function freeApps(): View
    {
        return view('user.free-apps');
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
            $query->where('category', $category);
        }

        $paginator = $query->paginate(10)->appends([
            'category' => $category,
            'search' => $search,
        ]);

        $categories = MarketItem::distinct()->pluck('category')->toArray();

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