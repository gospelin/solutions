<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchQuery = $request->query('search');
        if (!$searchQuery) {
            return redirect()->route('admin.tools.index')->with('error', 'Please enter a search term.');
        }

        $marketItems = MarketItem::query()
            ->where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('category', 'like', '%' . $searchQuery . '%')
            ->orWhere('description', 'like', '%' . $searchQuery . '%')
            ->latest()
            ->paginate(10);

        return view('admin.tools.index', compact('marketItems', 'searchQuery'));
    }
}