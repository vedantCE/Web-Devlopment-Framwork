<?php
session_start();
include("db.php");

// Only admin can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($id != $_SESSION['user_id']) { // cannot delete self
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Toggle status
if (isset($_GET['toggle'])) {
    $id = $_GET['toggle'];
    $stmt = $conn->prepare("SELECT status FROM users WHERE user_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($status);
    $stmt->fetch();
    $stmt->close();

    $newStatus = ($status == 'active') ? 'inactive' : 'active';
    $stmt = $conn->prepare("UPDATE users SET status=? WHERE user_id=?");
    $stmt->bind_param("si", $newStatus, $id);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        h2 { color: #003366; text-align: center; }
        p { color: #003366; font-weight: bold; }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; }
        th { background: #003366; color: white; padding: 10px; }
        td { padding: 8px; border: 1px solid #003366; }
        a { color: #003366; text-decoration: none; }
        a:hover { color: #001a33; }
    </style>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <p>Vedant Bhatt-24ce013</p>
    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> | <a href="logout.php">Logout</a></p>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Actions</th>
        </tr>

        <?php
        $result = $conn->query("SELECT user_id, username, email, role, status FROM users ORDER BY user_id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['role']}</td>
                <td>{$row['status']}</td>
                <td>
                    <a href='admin.php?delete={$row['user_id']}'>Delete</a> | 
                    <a href='admin.php?toggle={$row['user_id']}'>Toggle Status</a>
                </td>
            </tr>";
        }
        ?>
    </table>
    <footer style="margin-top: 50px; text-align: center; color: #666; font-size: 12px;">
        Created by Vedant Bhatt-24ce013
    </footer>
</body>
</html>