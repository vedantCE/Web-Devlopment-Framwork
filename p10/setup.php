<?php
require_once 'db.php';

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
)";

if ($conn->query($sql) === TRUE) {
    echo "Users table created successfully<br>";
    
    // Insert sample users
    $users = [
        ['admin', 'admin@123', 'admin'],
        ['student1', 'stud123', 'user'],
        ['student2', 'pass321', 'user']
    ];
    
    $stmt = $conn->prepare("INSERT IGNORE INTO users (username, password, role) VALUES (?, ?, ?)");
    
    foreach ($users as $user) {
        $stmt->bind_param("sss", $user[0], $user[1], $user[2]);
        $stmt->execute();
    }
    
    echo "Sample users inserted successfully<br>";
    echo "<a href='login.php'>Go to Login</a>";
    
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>