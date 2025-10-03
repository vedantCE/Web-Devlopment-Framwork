<?php
session_start();

if ($_POST) {
    $username = $_POST['txtuname'];
    
    // Store username in session
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    
    // Redirect to dashboard
    header("Location: dashboard.php");
    exit();
}
?>