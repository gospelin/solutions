<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ToolController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->query('search');
        $marketItems = MarketItem::query()
            ->when($searchQuery, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);

        return view('admin.tools.index', compact('marketItems', 'searchQuery'));
    }

    public function create()
    {
        // Fetch distinct categories
        $categories = MarketItem::distinct()->pluck('category')->filter()->sort();
        return view('admin.tools.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255', 'in:' . implode(',', MarketItem::distinct()->pluck('category')->toArray())],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_ngn' => ['required', 'numeric', 'min:0'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $filename, 'public');
            $validated['image'] = $filename;
        }

        $marketItem = MarketItem::create($validated);
        Log::info('New Tool created', ['item_id' => $marketItem->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'New Tool created successfully.');

    }

    public function edit(MarketItem $tool)
    {
        // Fetch distinct categories for edit form
        $categories = MarketItem::distinct()->pluck('category')->filter()->sort();
        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, MarketItem $tool)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255', 'in:' . implode(',', MarketItem::distinct()->pluck('category')->toArray())],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_ngn' => ['required', 'numeric', 'min:0'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($tool->image) {
                Storage::disk('public')->delete('images/' . $tool->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            // Save to storage/app/public/images, but store only filename
            $request->file('image')->storeAs('images', $filename, 'public');
            $validated['image'] = $filename;
        }

        $tool->update($validated);
        Log::info('Tool updated', ['item_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(MarketItem $tool)
    {
        try {
            // Delete associated image
            if ($tool->image) {
                Storage::disk('public')->delete('images/' . $tool->image);
            }

            // Delete the market item (cascades to related records via DB constraints)
            $tool->delete();

            Log::info('Tool and related records deleted', [
                'item_id' => $tool->id,
                'admin_id' => auth()->id(),
            ]);

            return redirect()->route('admin.tools.index')->with('success', 'Tool and related records deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete tool', [
                'item_id' => $tool->id,
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('admin.tools.index')->with('error', 'Failed to delete tool.');
        }
    }
}
