<?php

namespace App\Http\Controllers;

use App\Models\FreeApp;
use Illuminate\Http\Request;

class UserFreeAppController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $categories = FreeApp::select('category')->distinct()->pluck('category');

        $query = FreeApp::query()
            ->when($category, function ($query, $cat) {
                return $query->where('category', $cat);
            });

        $paginator = $query->latest()->paginate(12);

        return view('freeApps', compact('paginator', 'categories', 'category'));
    }

    public function category($category)
    {
        return $this->index(request()->merge(['category' => $category]));
    }
}