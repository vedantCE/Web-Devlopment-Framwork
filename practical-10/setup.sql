CREATE DATABASE IF NOT EXISTS user_auth_system;
USE user_auth_system;

CREATE TABLE IF NOT EXISTS users_info (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user'
);

INSERT INTO users_info (username, password, role) VALUES 
('admin', 'admin123', 'admin'),
('user', 'user123', 'user');