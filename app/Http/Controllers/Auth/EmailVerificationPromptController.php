<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request): View
    {
        try {
            if (Auth::check() && Auth::user()->hasRole(['admin', 'superAdmin'])) {
                return view('admin.dashboard'); // Redirect admins and superAdmins to dashboard
            }
            return view('auth.verify-email');
        } catch (\Exception $e) {
            Log::error('Failed to display email verification prompt', [
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return view('auth.verify-email')->with('error', 'An error occurred. Please try again.');
        }
    }
}