<?php
include("db.php");
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? 'user'; // default user

    if ($username == '' || $email == '' || $password == '') {
        $msg = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $msg = "Password must be at least 6 characters!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username,email,password,role) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $username,$email,$hash,$role);

        if ($stmt->execute()) {
            $msg = " Registration successful!";
        } else {
            $msg = " Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; text-align: center; }
        h2 { color: #003366; }
        input, select { padding: 10px; margin: 5px; border: 1px solid #003366; border-radius: 4px; width: 200px; }
        button { background: #003366; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #001a33; }
        p { color: #003366; font-weight: bold; }
        a { color: #003366; }
        a:hover { color: #001a33; }
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
        Role: 
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="login.php">Login here</a></p>
    <footer style="margin-top: 50px; text-align: center; color: #666; font-size: 12px;">
        Created by Vedant Bhatt-24ce013
    </footer>
</body>
</html>