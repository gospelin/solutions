<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreeApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FreeAppController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->query('search');
        $freeApps = FreeApp::query()
            ->when($searchQuery, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('external_link', 'like', '%' . $search . '%');
            })
            ->orderBy('id')
            ->paginate(7);

        return view('admin.free_apps.index', compact('freeApps', 'searchQuery'));
    }

    public function create()
    {
        $categories = FreeApp::select('category')->distinct()->pluck('category');
        return view('admin.free_apps.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $filename, 'public');
            $validated['image'] = $filename;
        }

        $validated['status'] = FreeApp::STATUS_ACTIVE;
        $freeApp = FreeApp::create($validated);
        Log::info('Free app created', ['app_id' => $freeApp->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.free-apps.index')->with('success', 'Free app created successfully.');
    }

    public function edit(FreeApp $freeApp)
    {
        $categories = FreeApp::select('category')->distinct()->pluck('category');
        return view('admin.free_apps.edit', compact('freeApp', 'categories'));
    }

    public function update(Request $request, FreeApp $freeApp)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($freeApp->image) {
                Storage::disk('public')->delete('images/' . $freeApp->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $filename, 'public');
            $validated['image'] = $filename;
        }

        $freeApp->update($validated);
        Log::info('Free app updated', ['app_id' => $freeApp->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.free-apps.index')->with('success', 'Free app updated successfully.');
    }

    public function destroy(FreeApp $freeApp)
    {
        try {
            if ($freeApp->image) {
                Storage::disk('public')->delete('images/' . $freeApp->image);
            }

            $freeApp->delete();

            Log::info('Free app deleted', [
                'app_id' => $freeApp->id,
                'admin_id' => auth()->id(),
            ]);

            return redirect()->route('admin.free-apps.index')->with('success', 'Free app deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete free app', [
                'app_id' => $freeApp->id,
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('admin.free-apps.index')->with('error', 'Failed to delete free app.');
        }
    }

    public function activate(FreeApp $freeApp)
    {
        $freeApp->update(['status' => FreeApp::STATUS_ACTIVE]);
        Log::info('Free app activated', ['app_id' => $freeApp->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.free-apps.index')->with('success', 'Free app activated successfully.');
    }

    public function deactivate(FreeApp $freeApp)
    {
        $freeApp->update(['status' => FreeApp::STATUS_DEACTIVATED]);
        Log::info('Free app deactivated', ['app_id' => $freeApp->id, 'admin_id' => auth()->id()]);

        return redirect()->route('admin.free-apps.index')->with('success', 'Free app deactivated successfully.');
    }
}
