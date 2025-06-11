<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketItem;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ToolController extends Controller
{
    //public function __construct()
    //{
    //    $this->middleware(['auth', 'role:admin']);
    //}

    public function index(Request $request)
    {
        $searchQuery = $request->query('search');
        $marketItems = MarketItem::query()
            ->when($searchQuery, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orderBy('id')
            ->paginate(7);

        return view('admin.tools.index', compact('marketItems', 'searchQuery'));
    }

    public function create()
    {
        return view('admin.tools.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage tools');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $tool = MarketItem::create($validated);

        Log::info('Tool created', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function edit(MarketItem $tool)
    {
        $this->authorize('manage tools');

        return view('admin.tools.edit', compact('tool'));
    }

    public function update(Request $request, MarketItem $tool)
    {
        $this->authorize('manage tools');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $tool->update($validated);

        Log::info('Tool updated', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(MarketItem $tool): RedirectResponse
    {
        $this->authorize('manage tools');

        try {
            // Store tool name for notification
            $toolName = $tool->name;

            // Permanently delete the tool
            $tool->forceDelete();

            // Notify admins
            $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'Tool Deleted',
                    'message' => "Tool '{$toolName}' was permanently deleted by admin.",
                ]);
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
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'Tool Activated',
                'message' => "Tool '{$tool->name}' activated by admin.",
            ]);
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
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'Tool Deactivated',
                'message' => "Tool '{$tool->name}' deactivated by admin.",
            ]);
        }

        Log::info('Tool deactivated', ['tool_id' => $tool->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool deactivated successfully.');
    }
}