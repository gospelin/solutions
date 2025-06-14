<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user is soft-deleted
            if ($user->trashed()) {
                Log::warning('Soft-deleted user attempted access', [
                    'email' => $user->email,
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                ]);
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account has been deleted. Contact support.');
            }

            // Bypass verification for users with admin role
            if ($user->hasRole('admin')) {
                return $next($request);
            }

            // Check status and ban for other users
            if ($user->status === 'Banned') {
                Log::warning('Banned user attempted access', [
                    'email' => $user->email,
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                ]);
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is suspended. Contact support.');
            }

            // Check email verification for non-admin users
            if (!$user->hasVerifiedEmail() && $user->status === 'pending') {
                Log::warning('Unverified user redirected to OTP page', [
                    'email' => $user->email,
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                ]);
                return redirect()->route('verification.otp')->with('error', 'Please verify your email with the OTP sent.');
            }
        }

        return $next($request);
    }
}