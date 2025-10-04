<?php
include 'db.php';

$timeout_duration = 600;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?message=Session expired, please login again.");
    exit();
}

$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h2><strong>Welcome, <?php echo $_SESSION['username']; ?>!</strong></h2>
<p><em>Your role:</em> <strong><?php echo $_SESSION['role']; ?></strong></p>
<p><strong><em>Created by VEDANT : 24CE013</em></strong></p>
<a href="logout.php"><strong>Logout</strong></a>
    <footer style="margin-top: 50px; text-align: center; color: #666; font-size: 12px;">
        Created by VEDANT : 24CE013
    </footer>
</body>
</html>
