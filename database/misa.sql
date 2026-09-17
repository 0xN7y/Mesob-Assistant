CREATE DATABASE IF NOT EXISTS misa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE misa_db;

DROP TABLE IF EXISTS service_documents;
DROP TABLE IF EXISTS documents;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('employee','admin') NOT NULL DEFAULT 'employee',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(180) NOT NULL,
    description TEXT NOT NULL,
    procedure TEXT NOT NULL,
    fee VARCHAR(80) NOT NULL,
    processing_time VARCHAR(100) NOT NULL,
    source VARCHAR(255) NOT NULL
);

CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(180) NOT NULL UNIQUE
);

CREATE TABLE service_documents (
    service_id INT NOT NULL,
    document_id INT NOT NULL,
    PRIMARY KEY(service_id, document_id),
    FOREIGN KEY(service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY(document_id) REFERENCES documents(id) ON DELETE CASCADE
);

INSERT INTO users(name,email,password,role) VALUES
('MISA Administrator','admin@misa.local','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC6YkQh8x3V2d4oQ1r5e','admin');

INSERT INTO services(service_name,description,procedure,fee,processing_time,source) VALUES
('Passport Renewal','Demo information for passport renewal. Replace with verified MESOB information.','Submit the required application information, supporting documents and complete the applicable verification process.','Demo / verify officially','Demo time','MESOB official service information (demo)'),
('Driver''s License Renewal','Demo information for driver''s license renewal. Replace with verified MESOB information.','Prepare the required documents, submit the renewal request and complete applicable checks.','Demo / verify officially','Demo time','MESOB official service information (demo)'),
('Business Registration','Demo information for business registration. Replace with verified MESOB information.','Prepare the required registration information, submit the application and follow the applicable review process.','Demo / verify officially','Demo time','MESOB official service information (demo)');

INSERT INTO documents(name) VALUES
('Valid identification document'),
('Previous passport or service document'),
('Completed application form'),
('Supporting documents');

INSERT INTO service_documents(service_id,document_id) VALUES
(1,1),(1,2),(1,3),
(2,1),(2,3),
(3,1),(3,3),(3,4);

-- IMPORTANT:
-- The password hash above is a demo hash. If login does not work after import,
-- create an admin through register.php and change that user's role to admin:
-- UPDATE users SET role='admin' WHERE email='your-email@example.com';
