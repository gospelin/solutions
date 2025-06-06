-- Creating the tools table
CREATE TABLE IF NOT EXISTS tools (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    submitted_by VARCHAR(255) NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Inserting demo data
INSERT INTO tools (name, category, submitted_by, status, created_at, updated_at) VALUES
('Network Analyzer', 'Network Tools', 'John Doe', 'Pending', NOW(), NOW()),
('SQL Injector', 'Security Testing', 'Jane Smith', 'Approved', NOW(), NOW()),
('Password Auditor', 'Password Tools', 'Mike Johnson', 'Pending', NOW(), NOW()),
('Vulnerability Scanner', 'Security Testing', 'Alice Brown', 'Rejected', NOW(), NOW()),
('Packet Capture Tool', 'Network Tools', 'Bob Wilson', 'Approved', NOW(), NOW()),
('Exploit Framework', 'Penetration Testing', 'Sarah Davis', 'Pending', NOW(), NOW()),
('Firewall Tester', 'Security Testing', 'Tom Clark', 'Approved', NOW(), NOW()),
('Web Scanner', 'Web Tools', 'Emily White', 'Pending', NOW(), NOW()),
('Brute Force Tool', 'Password Tools', 'David Lee', 'Rejected', NOW(), NOW()),
('Port Scanner', 'Network Tools', 'Lisa Taylor', 'Pending', NOW(), NOW());