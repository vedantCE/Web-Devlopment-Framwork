<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; text-align: center; }
        h2 { color: #003366; }
        p { color: #003366; font-weight: bold; font-size: 18px; }
        a { background: #003366; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; }
        a:hover { background: #001a33; }
    </style>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <p>You are logged in as a user.</p>
    <a href="logout.php">Logout</a>
    <footer style="margin-top: 50px; text-align: center; color: #666; font-size: 12px;">
        Created by Vedant Bhatt-24ce013
    </footer>
</body>
</html>