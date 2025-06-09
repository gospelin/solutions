<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SearchController extends Controller
{
    /**
     * Handle admin search for market items.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        try {
            // Validate search input
            $validated = $request->validate([
                'search' => ['required', 'string', 'max:255'],
            ]);

            $searchQuery = $validated['search'];

            // Search market items
            $marketItems = MarketItem::query()
                ->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('category', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%')
                ->latest()
                ->paginate(7)
                ->appends(['search' => $searchQuery]); // Preserve search query in pagination links

            // Log the search action
            Log::info('Admin performed search', [
                'admin_id' => auth()->id(),
                'query' => $searchQuery,
                'results_count' => $marketItems->total(),
            ]);

            return view('admin.tools.index', compact('marketItems', 'searchQuery'));
        } catch (ValidationException $e) {
            return redirect()->route('admin.tools.index')->with('error', 'Please enter a valid search term.');
        } catch (\Exception $e) {
            Log::error('Admin search failed', [
                'admin_id' => auth()->id(),
                'query' => $request->query('search'),
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('admin.tools.index')->with('error', 'An error occurred while searching.');
        }
    }
}