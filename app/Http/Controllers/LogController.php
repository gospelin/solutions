<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use Illuminate\Routing\Controller;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin', 'verified']);
    }

    public function index(Request $request)
    {
        try {
            $logPath = storage_path('logs');
            $logFiles = array_reverse(glob($logPath . '/laravel-*.log'));
            $logs = [];
            $maxSize = 10 * 1024 * 1024; // 10MB
            $perPage = $request->input('per_page', 50);
            $level = $request->input('level', null);
            $date = $request->input('date', null);

            foreach ($logFiles as $file) {
                if ($date && !str_contains(basename($file), $date)) {
                    continue;
                }

                if (File::size($file) > $maxSize) {
                    $content = File::get($file);
                } else {
                    $content = File::get($file);
                }

                $lines = explode("\n", $content);
                foreach ($lines as $line) {
                    if (empty($line)) {
                        continue;
                    }

                    preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]\s+([^\.]+)\.(\w+):(.+)$/', $line, $matches);
                    if (count($matches) >= 4) {
                        $timestamp = $matches[1];
                        $env = $matches[2];
                        $logLevel = $matches[3];
                        $message = trim($matches[4]);

                        if ($level && $logLevel !== strtoupper($level)) {
                            continue;
                        }

                        $logs[] = [
                            'timestamp' => $timestamp,
                            'level' => $logLevel,
                            'message' => $message,
                            'file' => basename($file),
                        ];
                    }
                }
            }

            usort($logs, function ($lineA, $lineB) {
                return strtotime($lineB['timestamp']) - strtotime($lineA['timestamp']);
            });

            $currentPage = $request->input('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $pagedLogs = array_slice($logs, $offset, $perPage);
            $total = count($logs);
            $lastPage = ceil($total / $perPage);

            $dates = array_unique(array_map(function ($file) {
                return substr(basename($file, '.log'), 8, 10);
            }, glob($logPath . '/laravel-*.log')));

            Log::info('Log viewer accessed', [
                'user_id' => Auth::id(),
                'filters' => ['level' => $level, 'date' => $date, 'per_page' => $perPage],
                'ip' => $request->ip(),
            ]);

            return view('admin.logs', [
                'logs' => $pagedLogs,
                'currentPage' => $currentPage,
                'lastPage' => $lastPage,
                'perPage' => $perPage,
                'total' => $total,
                'level' => $level,
                'date' => $date,
                'dates' => $dates,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to load logs', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'ip' => $request->ip(),
            ]);
            return view('admin.logs', [
                'logs' => [],
                'error' => 'Failed to load logs. Please try again.',
                'currentPage' => 1,
                'lastPage' => 1,
                'perPage' => $perPage,
                'total' => 0,
                'level' => $level,
                'date' => $date,
                'dates' => [],
            ]);
        }
    }
}