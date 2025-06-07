<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        // Build query for market items
        $query = MarketItem::query();

        // Apply category filter if provided
        if ($category) {
            $query->where('category', $category);
        }

        // Paginate items (9 per page)
        $items = $query->paginate(9)->appends(['category' => $category]);

        // Get popular items (top 5 by purchases_count)
        $popularItems = MarketItem::orderBy('purchases_count', 'desc')->take(5)->get();

        // Get latest items (top 5 by creation date)
        $latestItems = MarketItem::latest()->take(5)->get();

        // Get all categories for filter
        $categories = MarketItem::select('category')->distinct()->pluck('category');

        return view('user.market', compact('items', 'popularItems', 'latestItems', 'categories', 'category'));
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
    public function marketPurchase(Request $request, $id): RedirectResponse
    {
        try {
            // Validate ID
            Validator::make(['id' => $id], ['id' => 'required|numeric'])->validate();

            // Fetch item
            $item = MarketItem::findOrFail($id);
            $user = Auth::user();

            // Check if user can purchase
            if (!$user->canPurchase($item)) {
                return redirect()->route('market')->with('error', 'Purchase failed: Insufficient balance or item already purchased.');
            }

            // Placeholder for payment processing
            $paymentSuccessful = $this->processPayment($user, $item->price);

            if ($paymentSuccessful) {
                // Record purchase in pivot table
                $user->purchasedItems()->attach($item->id, ['purchased_at' => now()]);

                // Increment purchases_count
                $item->increment('purchases_count');

                // Deduct balance (for demo purposes)
                $user->balance -= $item->price;
                $user->save();

                return redirect()->route('market')->with('success', 'Item purchased successfully!');
            }

            return redirect()->route('market')->with('error', 'Payment processing failed.');
        } catch (\Exception $e) {
            return redirect()->route('market')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Placeholder for payment processing.
     */
    private function processPayment($user, $amount): bool
    {
        // TODO: Implement actual payment processing (e.g., Stripe, PayPal)
        // For now, assume payment is successful if user has enough balance
        return $user->balance >= $amount;
    }
}