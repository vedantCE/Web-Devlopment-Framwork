<?php
session_start();

$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 4px; margin-bottom: 20px; }
        .content { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 4px; }
        .logout-btn { background: #dc3545; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard</h1>
        
        <?php if ($isLoggedIn): ?>
            <p>Hello, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> (<?= htmlspecialchars($_SESSION['role']) ?>)</p>
            <p>User ID: <?= $_SESSION['user_id'] ?></p>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <p>Please login to access dashboard features.</p>
            <a href="login.php" class="logout-btn" style="background: #007bff;">Login</a>
        <?php endif; ?>
    </div>
    
    <div class="content">
        <?php if ($isLoggedIn): ?>
            <h2>Protected Content</h2>
            <p>This is a secure area that can only be accessed by logged-in users.</p>
            <p>Session ID: <?= session_id() ?></p>
            <p>Login Time: <?= date('Y-m-d H:i:s') ?></p>
            
            <h3>Available Actions:</h3>
            <ul>
                <li>View user profile</li>
                <li>Manage settings</li>
                <li>Access reports</li>
            </ul>
        <?php else: ?>
            <h2>Public Content</h2>
            <p>This is public content visible to all users.</p>
            <p>Login to access more features and protected content.</p>
        <?php endif; ?>
    </div>
</body>
</html>