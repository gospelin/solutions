<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;

class VerifyEmailController extends Controller
{
    public function showOtpForm(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            Log::warning('Attempt to access OTP form without authenticated user', [
                'ip' => $request->ip(),
            ]);
            return redirect()->route('login')->with('error', 'Please log in to verify your email.');
        }

        if ($user->hasRole(['admin', 'superAdmin']) || $user->hasVerifiedEmail()) {
            return redirect()->intended(route($user->hasRole(['admin', 'superAdmin']) ? 'admin.dashboard' : 'user.dashboard', absolute: false))
                ->with('message', 'Email already verified.');
        }

        return view('auth.verify-email', ['email' => $user->email]);
    }

    public function verifySignedLink(Request $request): RedirectResponse
    {
        try {
            $id = $request->route('id');
            $hash = $request->route('hash');

            if (!$request->hasValidSignature() || !$id || !$hash) {
                Log::warning('Invalid or missing signature for email verification link', [
                    'id' => $id,
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl(),
                    'expires' => $request->query('expires'),
                    'signature' => $request->query('signature'),
                    'app_url' => config('app.url'),
                ]);
                return redirect()->route('verification.signup')
                    ->with('error', 'Invalid or expired verification link. Please use the OTP or request a new link.');
            }

            $user = User::where('id', $id)->firstOrFail();

            if ($user->hasRole(['admin', 'superAdmin'])) {
                Auth::login($user);
                return redirect()->intended(route('admin.dashboard', absolute: false))
                    ->with('message', 'Admin email verified.');
            }

            if (sha1($user->getEmailForVerification()) !== $hash) {
                Log::warning('Hash mismatch in email verification link', [
                    'email' => $user->email,
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                    'received_hash' => $hash,
                ]);
                return redirect()->route('verification.signup')
                    ->with('error', 'Invalid verification link.');
            }

            if ($user->hasVerifiedEmail()) {
                Auth::login($user);
                return redirect()->intended(route('user.dashboard', absolute: false))
                    ->with('message', 'Email already verified. You are logged in.');
            }

            if ($user->markEmailAsVerified()) {
                $user->status = 'Active';
                $user->verification_code = null;
                $user->verification_code_expires_at = null;
                $user->save();

                event(new Verified($user));
                Auth::login($user);

                Log::info('Email verified successfully via signed link', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'ip' => $request->ip(),
                ]);

                return redirect()->intended(route('user.dashboard', absolute: false))
                    ->with('message', 'Email verified successfully!');
            }

            Log::error('Failed to mark email as verified', [
                'email' => $user->email,
                'user_id' => $user->id,
                'ip' => $request->ip(),
            ]);
            return redirect()->route('verification.signup')
                ->with('error', 'Verification failed. Please try again.');
        } catch (\Exception $e) {
            Log::error('Signed link verification failed', [
                'id' => $id,
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
            ]);
            return redirect()->route('verification.signup')
                ->with('error', 'Verification failed. Please try again.');
        }
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'otp' => ['required', 'string', 'size:6', 'digits:6'],
            ]);

            $user = Auth::user();

            if (!$user) {
                Log::warning('OTP verification attempt with no user', [
                    'ip' => $request->ip(),
                ]);
                return redirect()->route('login')
                    ->with('error', 'Session expired. Please log in again.');
            }

            if ($user->hasRole(['admin', 'superAdmin']) || $user->hasVerifiedEmail()) {
                return redirect()->intended(route($user->hasRole(['admin', 'superAdmin']) ? 'admin.dashboard' : 'user.dashboard', absolute: false))
                    ->with('message', 'Email already verified.');
            }

            if ($user->verification_code_expires_at && $user->verification_code_expires_at->isPast()) {
                Log::warning('Expired OTP attempt', [
                    'email' => $user->email,
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                ]);
                return redirect()->route('verification.otp')
                    ->with('error', 'OTP has expired. Please request a new one.');
            }

            if ($user->verification_code === $request->otp) {
                if ($user->markEmailAsVerified()) {
                    $user->status = 'Active';
                    $user->verification_code = null;
                    $user->verification_code_expires_at = null;
                    $user->save();

                    event(new Verified($user));

                    Log::info('Email verified successfully via OTP', [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'ip' => $request->ip(),
                    ]);

                    return redirect()->intended(route($user->hasRole(['admin', 'superAdmin']) ? 'admin.dashboard' : 'user.dashboard', absolute: false))
                        ->with('message', 'Email verified successfully!');
                }

                Log::error('Failed to mark email as verified via OTP', [
                    'email' => $user->email,
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                ]);
                return redirect()->route('verification.otp')
                    ->with('error', 'Verification failed. Please try again.');
            }

            Log::warning('Invalid OTP attempt', [
                'email' => $user->email,
                'user_id' => $user->id,
                'otp' => $request->otp,
                'ip' => $request->ip(),
            ]);
            return redirect()->route('verification.otp')
                ->with('error', 'Invalid OTP. Please try again.');
        } catch (\Exception $e) {
            Log::error('OTP verification failed', [
                'email' => $user->email ?? 'unknown',
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('verification.otp')
                ->with('error', 'OTP verification failed. Please try again.');
        }
    }
}