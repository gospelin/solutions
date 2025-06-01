<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    public function run(): void
    {
        Tool::create([
            'name' => 'SQL Injector',
            'category' => 'Security',
            'submitted_by' => 'John Doe',
            'status' => 'Pending',
        ]);

        Tool::create([
            'name' => 'Password Cracker',
            'category' => 'Hacking',
            'submitted_by' => 'Jane Smith',
            'status' => 'Approved',
        ]);

        Tool::create([
            'name' => 'Network Scanner',
            'category' => 'Networking',
            'submitted_by' => 'Bob Johnson',
            'status' => 'Rejected',
        ]);
    }
}
