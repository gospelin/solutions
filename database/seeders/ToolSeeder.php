<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    public function run(): void
    {
        $tools = [
            [
                'name' => 'Network Analyzer',
                'category' => 'Network Tools',
                'submitted_by' => 'John Doe',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SQL Injector',
                'category' => 'Security Testing',
                'submitted_by' => 'Jane Smith',
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Password Auditor',
                'category' => 'Password Tools',
                'submitted_by' => 'Mike Johnson',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vulnerability Scanner',
                'category' => 'Security Testing',
                'submitted_by' => 'Alice Brown',
                'status' => 'Rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Packet Capture Tool',
                'category' => 'Network Tools',
                'submitted_by' => 'Bob Wilson',
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Exploit Framework',
                'category' => 'Penetration Testing',
                'submitted_by' => 'Sarah Davis',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Firewall Tester',
                'category' => 'Security Testing',
                'submitted_by' => 'Tom Clark',
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Web Scanner',
                'category' => 'Web Tools',
                'submitted_by' => 'Emily White',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brute Force Tool',
                'category' => 'Password Tools',
                'submitted_by' => 'David Lee',
                'status' => 'Rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Port Scanner',
                'category' => 'Network Tools',
                'submitted_by' => 'Lisa Taylor',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($tools as $tool) {
            Tool::create($tool);
        }
    }
}
