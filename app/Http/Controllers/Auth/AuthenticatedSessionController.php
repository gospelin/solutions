<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        try {
            Log::info('Login page accessed', ['ip' => request()->ip()]);
            return view('auth.login');
        } catch (\Exception $e) {
            Log::error('Failed to display login page', [
                'error' => $e->getMessage(),
            ]);
            return view('auth.login')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            $user = Auth::user();

            // // Skip email verification for admins
            // if (!$user->hasRole(['admin', 'superAdmin']) && is_null($user->email_verified_at)) {
            //     Auth::logout();
            //     $request->session()->invalidate();
            //     $request->session()->regenerateToken();
            //     Log::warning('Login attempt by unverified user', [
            //         'email' => $request->email,
            //         'ip' => $request->ip(),
            //     ]);
            //     return redirect()->route('verification.otp')
            //         ->with('error', 'Please verify your email before logging in.');
            // }

            if ($user->status === 'Banned') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Log::warning('Login attempt by banned user', [
                    'email' => $request->email,
                    'ip' => $request->ip(),
                ]);
                return redirect()->route('login')
                    ->with('error', 'Your account is banned. Please contact support.');
            }

            $request->session()->regenerate();
            Log::info('User logged in successfully', [
                'email' => $user->email,
                'user_id' => $user->id,
                'ip' => $request->ip(),
            ]);

            if ($user->hasRole(['admin', 'superAdmin'])) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            Log::error('Login failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('login')
                ->with('error', 'Login failed. Please check your credentials and try again.');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            $userEmail = Auth::user()->email;
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Log::info('User logged out', [
                'email' => $userEmail,
                'ip' => $request->ip(),
            ]);
            return redirect('/');
        } catch (\Exception $e) {
            Log::error('Logout failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);
            return redirect('/')
                ->with('error', 'Logout failed. Please try again.');
        }
    }
}