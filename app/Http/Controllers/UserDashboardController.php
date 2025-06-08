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

        //$popularItems = MarketItem::orderBy('purchases_count', 'desc')->take(5)->get();
        //$latestItems = MarketItem::latest()->take(5)->get();
        $categories = MarketItem::distinct()->pluck('category')->toArray();

        return view('user.market', [
            'paginator' => $paginator,
            //'popularItems' => $popularItems,
            //'latestItems' => $latestItems,
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    //public function marketItem($id): View
    //{
    //    $item = MarketItem::findOrFail($id);
    //    return view('user.market-item', compact('item'));
    //}

    //public function marketPurchase(Request $request, $id): RedirectResponse
    //{
    //    $item = MarketItem::findOrFail($id);
    //    $user = auth()->user();

    //    if ($item->status === 'pending') {
    //        return redirect()->back()->with('error', 'This item is pending and cannot be purchased.');
    //    }

    //    if (!$user->canPurchase($item)) {
    //        return redirect()->back()->with('error', 'Unable to purchase: insufficient balance or item already purchased.');
    //    }

    //    DB::transaction(function () use ($user, $item) {
    //        $user->balance -= $item->price; // Uses USD
    //        $user->save();
    //        $item->purchases_count++;
    //        $item->save();
    //        $user->purchasedItems()->attach($item->id, ['purchased_at' => now()]);
    //    });

    //    return redirect()->route('market')->with('success', 'Purchase successful!');
    //}

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

    /**
     * Process a purchase for a market item.
     */
    //public function marketPurchase(Request $request, $id): RedirectResponse
    //{
    //    try {
    //        // Validate ID
    //        Validator::make(['id' => $id], ['id' => 'required|numeric'])->validate();

    //        // Fetch item
    //        $item = MarketItem::findOrFail($id);
    //        $user = Auth::user();

    //        // Check if user can purchase
    //        if (!$user->canPurchase($item)) {
    //            return redirect()->route('market')->with('error', 'Purchase failed: Insufficient balance or item already purchased.');
    //        }

    //        // Placeholder for payment processing
    //        $paymentSuccessful = $this->processPayment($user, $item->price);

    //        if ($paymentSuccessful) {
    //            // Record purchase in pivot table
    //            $user->purchasedItems()->attach($item->id, ['purchased_at' => now()]);

    //            // Increment purchases_count
    //            $item->increment('purchases_count');

    //            // Deduct balance (for demo purposes)
    //            $user->balance -= $item->price;
    //            $user->save();

    //            return redirect()->route('market')->with('success', 'Item purchased successfully!');
    //        }

    //        return redirect()->route('market')->with('error', 'Payment processing failed.');
    //    } catch (\Exception $e) {
    //        return redirect()->route('market')->with('error', 'An error occurred: ' . $e->getMessage());
    //    }
    //}

    /**
     * Placeholder for payment processing.
     */
    //private function processPayment($user, $amount): bool
    //{
    //    // TODO: Implement actual payment processing (e.g., Stripe, PayPal)
    //    // For now, assume payment is successful if user has enough balance
    //    return $user->balance >= $amount;
    //}
}