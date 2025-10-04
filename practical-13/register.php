<?php
include("db.php");

$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize & validate inputs
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $captcha  = $_POST['captcha'] ?? '';

    // simple validation
    if ($username == '' || $email == '' || $password == '' || $captcha == '') {
        $msg = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $msg = "Password must be at least 6 characters!";
    } elseif ($captcha != '1234') {  // placeholder captcha
        $msg = "Incorrect CAPTCHA!";
    } else {
        // 2. Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // 3. Prepare SQL to prevent injection
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $passwordHash);

        if ($stmt->execute()) {
            $msg = "Registration successful!";
        } else {
            $msg = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Registration</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        h2 { color: #003366; text-align: center; }
        input { padding: 10px; margin: 5px; border: 1px solid #003366; border-radius: 4px; width: 200px; }
        button { background: #003366; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #001a33; }
        p { color: #003366; font-weight: bold; }
        form { text-align: center; margin: 20px 0; }
    </style>
</head>
<body>
    <h2>Register</h2>
    <p>Vedant Bhatt-24ce013</p>
    <?php if($msg) echo "<p>$msg</p>"; ?>

    <form method="POST">
        Username: <input type="text" name="username" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        CAPTCHA (enter 1234): <input type="text" name="captcha" required><br><br>
        <button type="submit">Register</button>
    </form>
    <footer style="margin-top: 50px; text-align: center; color: #666; font-size: 12px;">
        Created by Vedant Bhatt-24ce013
    </footer>
</body>
</html>