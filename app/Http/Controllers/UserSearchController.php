<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserSearchController extends Controller
{
    public function search(Request $request): View
    {
        $query = $request->input('query', '');
        $category = $request->input('category');

        $items = MarketItem::query()
            ->when($query, fn($q) => $q->where('name', 'like', '%' . $query . '%'))
            ->when($category, fn($q) => $q->where('category', $category))
            ->paginate(10)
            ->appends(['query' => $query, 'category' => $category]);

        $categories = MarketItem::distinct()->pluck('category')->toArray();
        $popularItems = MarketItem::orderBy('purchases_count', 'desc')->take(5)->get();
        $latestItems = MarketItem::latest()->take(5)->get();

        return view('user.market', [
            'paginator' => $items,
            'categories' => $categories,
            'category' => $category,
            'popularItems' => $popularItems,
            'latestItems' => $latestItems,
            'searchQuery' => $query,
        ]);
    }
}
?>