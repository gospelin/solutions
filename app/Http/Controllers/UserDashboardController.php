<?php

namespace App\Http\Controllers;

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
