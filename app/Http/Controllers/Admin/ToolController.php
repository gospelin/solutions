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
        return view('admin.tools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_ngn' => ['required', 'numeric', 'min:0'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('images', $filename, 'public');
        }

        $marketItem = MarketItem::create($validated);
        Log::info('Market item created', ['item_id' => $marketItem->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Market item created successfully.');

    }

    public function edit(MarketItem $tool)
    {
        return view('admin.tools.edit', compact('tool'));
    }

    public function update(Request $request, MarketItem $tool)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_ngn' => ['required', 'numeric', 'min:0'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($tool->image) {
                Storage::disk('public')->delete($tool->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $validated['image'] = $request->file('image')->storeAs('images', $filename, 'public');
        }

        $tool->update($validated);
        Log::info('Market item updated', ['item_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Market item updated successfully.');
    }

    public function destroy(MarketItem $tool)
    {
        if ($tool->image) {
            Storage::disk('public')->delete($tool->image);
        }
        $tool->delete();
        Log::info('Market item deleted', ['item_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Market item deleted successfully.');
    }
}
