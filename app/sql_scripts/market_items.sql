-- Creating the market_items table
CREATE TABLE IF NOT EXISTS market_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    purchases_count INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Inserting demo data
INSERT INTO market_items (name, description, price, category, purchases_count, created_at, updated_at) VALUES
('Network Scanner', 'Advanced network scanning tool for identifying vulnerabilities', 29.99, 'tools', 150, NOW(), NOW()),
('Packet Sniffer', 'Real-time packet analysis software with detailed reporting', 49.99, 'tools', 100, NOW(), NOW()),
('Exploit Framework', 'Comprehensive framework for penetration testing', 99.99, 'tools', 75, NOW(), NOW()),
('Password Cracker', 'High-speed password recovery tool', 39.99, 'tools', 200, NOW(), NOW()),
('SQL Injection Script', 'Automated SQL injection testing script', 19.99, 'scripts', 50, NOW(), NOW()),
('XSS Scanner Script', 'Cross-site scripting vulnerability scanner', 24.99, 'scripts', 80, NOW(), NOW()),
('Penetration Testing Guide', 'Comprehensive guide for ethical hacking', 15.99, 'resources', 120, NOW(), NOW()),
('Network Security Course', 'Video course on network security fundamentals', 59.99, 'resources', 90, NOW(), NOW()),
('Malware Analysis Toolkit', 'Tools for analyzing and reverse-engineering malware', 79.99, 'tools', 60, NOW(), NOW()),
('Bot Framework', 'Customizable bot creation framework', 44.99, 'scripts', 110, NOW(), NOW());



php artisan tinker
DB::statement('SET FOREIGN_KEY_CHECKS=0;');
DB::table('market_item_user')->truncate();
DB::table('market_items')->truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
exit