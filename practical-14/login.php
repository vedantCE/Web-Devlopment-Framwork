<?php
session_start();
include("db.php");
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email == '' || $password == '') {
        $msg = "All fields are required!";
    } else {
        $stmt = $conn->prepare("SELECT user_id, username, password, role FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $username, $hash, $role);
            $stmt->fetch();

            if (password_verify($password, $hash)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                if ($role == 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: welcome.php");
                }
                exit;
            } else {
                $msg = "Incorrect password!";
            }
        } else {
            $msg = "Email not found!";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
    <h2>Login</h2>
    <?php if($msg) echo "<p>$msg</p>"; ?>
    <form method="POST">
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>New user? <a href="register.php">Register here</a></p>
    <footer style="margin-top: 50px; text-align: center; color: #666; font-size: 12px;">
        Created by Vedant Bhatt-24ce013
    </footer>
</body>
</html>