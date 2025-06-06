<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotifyReregisterController extends Controller
{
    public function notify(Request $request)
    {
        $secret = $request->query('secret');

        if ($secret !== env('NOTIFY_SECRET')) {
            Log::warning('Unauthorized attempt to notify for re-registration', [
                'ip' => $request->ip(),
            ]);
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            // Load users from CSV or users_backup table
            $users = $this->getUsersForNotification();

            foreach ($users as $user) {
                try {
                    $notifiable = new \stdClass();
                    $notifiable->name = $user->name ?? null;
                    $notifiable->email = $user->email;

                    (new \App\Notifications\ReregisterNotification())->toMail($notifiable)->sendNow();

                    Log::info('Re-registration email sent', [
                        'email' => $user->email,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to send re-registration email', [
                        'email' => $user->email,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            return response()->json(['message' => 'Notified users for re-registration.']);
        } catch (\Exception $e) {
            Log::error('Re-registration notification failed', [
                'error' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'Failed to notify users.'], 500);
        }
    }

    protected function getUsersForNotification()
    {
        // Option 1: Use users_backup table
        if (\Schema::hasTable('users_backup')) {
            return \DB::table('users_backup')->select('name', 'email')->get();
        }

        // Option 2: Hardcode or load from CSV (manually parsed)
        // Example: Replace with your CSV data
        return collect([
            (object) ['name' => 'User1', 'email' => 'user1@example.com'],
            (object) ['name' => 'User2', 'email' => 'user2@example.com'],
        ]);
    }
}