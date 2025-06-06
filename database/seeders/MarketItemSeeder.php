<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarketItem;

class MarketItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Network Scanner',
                'description' => 'Advanced network scanning tool for identifying vulnerabilities',
                'price' => 29.99,
                'category' => 'tools',
                'purchases_count' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Packet Sniffer',
                'description' => 'Real-time packet analysis software with detailed reporting',
                'price' => 49.99,
                'category' => 'tools',
                'purchases_count' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Exploit Framework',
                'description' => 'Comprehensive framework for penetration testing',
                'price' => 99.99,
                'category' => 'tools',
                'purchases_count' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Password Cracker',
                'description' => 'High-speed password recovery tool',
                'price' => 39.99,
                'category' => 'tools',
                'purchases_count' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SQL Injection Script',
                'description' => 'Automated SQL injection testing script',
                'price' => 19.99,
                'category' => 'scripts',
                'purchases_count' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'XSS Scanner Script',
                'description' => 'Cross-site scripting vulnerability scanner',
                'price' => 24.99,
                'category' => 'scripts',
                'purchases_count' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penetration Testing Guide',
                'description' => 'Comprehensive guide for ethical hacking',
                'price' => 15.99,
                'category' => 'resources',
                'purchases_count' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Network Security Course',
                'description' => 'Video course on network security fundamentals',
                'price' => 59.99,
                'category' => 'resources',
                'purchases_count' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Malware Analysis Toolkit',
                'description' => 'Tools for analyzing and reverse-engineering malware',
                'price' => 79.99,
                'category' => 'tools',
                'purchases_count' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bot Framework',
                'description' => 'Customizable bot creation framework',
                'price' => 44.99,
                'category' => 'scripts',
                'purchases_count' => 110,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($items as $item) {
            MarketItem::create($item);
        }
    }
}
