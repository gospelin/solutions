<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketItem;
use App\Models\Notification;
use App\Models\User;
use App\Events\MarketItemCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Events\UserNotification;

class ToolController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->query('search');
        $tools = MarketItem::query()
            ->when($searchQuery, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orderBy('id')
            ->paginate(7);

        return view('admin.tools.index', compact('tools', 'searchQuery'));
    }

    public function create()
    {
        // Fetch distinct categories
        $categories = MarketItem::distinct()->pluck('category')->filter()->sort();
        return view('admin.tools.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('manage tools');

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

        //$tool = MarketItem::create($validated);
        $validated['status'] = MarketItem::STATUS_ACTIVE; // Default to Active
        $tool = MarketItem::create($validated);

        // Trigger MarketItemCreated event to notify all users
        event(new MarketItemCreated($tool));

        Log::info('Tool created', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function edit(MarketItem $tool)
    {
        $this->authorize('manage tools');

        // Fetch distinct categories for edit form
        $categories = MarketItem::distinct()->pluck('category')->filter()->sort();
        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, MarketItem $tool)
    {
        $this->authorize('manage tools');

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

        Log::info('Tool updated', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(MarketItem $tool): RedirectResponse
    {
        $this->authorize('manage tools');

        try {
            // Delete associated image
            if ($tool->image) {
                Storage::disk('public')->delete('images/' . $tool->image);
            }
            $toolName = $tool->name;
            $tool->forceDelete();

            // Notify admins
            $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
            foreach ($admins as $admin) {
                $notification = Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'Tool Deleted',
                    'message' => "Tool '{$toolName}' was permanently deleted by admin.",
                    'read' => false,
                ]);
                event(new UserNotification($notification));
            }

            Log::info('Tool permanently deleted', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

            return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete tool', ['tool_id' => $tool->id, 'message' => $e->getMessage()]);
            return redirect()->route('admin.tools.index')->with('error', 'Failed to delete tool.');
        }
    }

    public function activate(MarketItem $tool): RedirectResponse
    {
        $this->authorize('manage tools');

        $tool->update(['status' => MarketItem::STATUS_ACTIVE]);

        // Notify admins
        $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
        foreach ($admins as $admin) {
            $notification = Notification::create([
                'user_id' => $admin->id,
                'type' => 'Tool Activated',
                'message' => "Tool '{$tool->name}' activated by admin.",
                'read' => false,
            ]);
            event(new UserNotification($notification));
        }

        Log::info('Tool activated', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool activated successfully.');
    }

    public function deactivate(MarketItem $tool): RedirectResponse
    {
        $this->authorize('manage tools');

        $tool->update(['status' => MarketItem::STATUS_DEACTIVATED]);

        // Notify admins
        $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
        foreach ($admins as $admin) {
            $notification = Notification::create([
                'user_id' => $admin->id,
                'type' => 'Tool Deactivated',
                'message' => "Tool '{$tool->name}' deactivated by admin.",
                'read' => false,
            ]);
            event(new UserNotification($notification));
        }

        Log::info('Tool deactivated', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool deactivated successfully.');
    }
}
