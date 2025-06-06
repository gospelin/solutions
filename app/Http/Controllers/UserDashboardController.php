<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
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

    public function market(Request $request): View
    {
        $category = $request->query('category');

        $query = MarketItem::query();

        if ($category) {
            $query->where('category', $category);
        }

        $items = $query->paginate(9);

        $popularItems = MarketItem::orderBy('purchases_count', 'desc')
            ->take(5)
            ->get();

        $latestItems = MarketItem::latest()
            ->take(5)
            ->get();

        return view('user.market', compact('items', 'popularItems', 'latestItems'));
    }

    public function marketItem($id): View
    {
        $item = MarketItem::findOrFail($id);
        return view('user.market-item', compact('item'));
    }

    public function marketPurchase($id)
    {
        $item = MarketItem::findOrFail($id);
        // Add purchase logic here (e.g., payment processing, user authentication)
        // For now, we'll just redirect back with a success message
        return redirect()->route('market')->with('success', 'Item purchased successfully!');
    }

    public function profile(): View
    {
        return view('user.profile');
    }

    public function settings(): View
    {
        return view('user.settings');
    }

    public function subscription(): View
    {
        return view('user.subscription');
    }
}