<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'pending',
                'verification_code' => sprintf("%06d", mt_rand(100000, 999999)),
                'verification_code_expires_at' => now()->addMinutes(10),
                'theme' => 'dark',
                'notifications' => true,
                'language' => 'en',
            ]);

            $user->assignRole('user');

            // Notify admins
            $admins = User::role(['admin', 'superAdmin'])->where('notifications', true)->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'New User',
                    'message' => "New user '{$user->name}' registered with email '{$user->email}'.",
                ]);
                \Mail::to($admin->email)->send(new \App\Mail\NewUserNotification($user));
            }

            event(new Registered($user));

            Auth::login($user);

            Log::info('User registered', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            return redirect()->route('verification.otp')
                ->with('status', 'Please enter the OTP sent to your email.');
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);
            return redirect()->route('register')
                ->with('error', 'Registration failed. Please try again.');
        }
    }
}