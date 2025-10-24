<?php
session_start();
require_once 'includes/db.php';
$conn = connectdb();

// Ensure admin is logged in
if (!isset($_SESSION['ADMIN_EMAIL'])) {
    echo "Access denied.";
    exit;
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = intval($_POST['user_id']);
    $stmt = mysqli_prepare($conn, "DELETE FROM register WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
}

// Fetch all users
$result = mysqli_query($conn, "SELECT * FROM register ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Admin | WashTag</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body { background: #f4f6f9; padding: 30px; font-family: Arial, sans-serif; }
        .user-card { background: #fff; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .user-card h5 { margin: 0 0 10px 0; }
        .user-details p { margin: 4px 0; }
        .delete-btn { margin-top: 10px; }
    </style>
</head>
<body>

    <h2 class="text-center mb-4">Manage  Users</h2>

    <div class="container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="user-card">
                    <h5><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['email']) ?>)</h5>
                    <div class="user-details">
                        <p><strong>Username:</strong> <?= htmlspecialchars($row['username']) ?></p>
                        <p><strong>State:</strong> <?= htmlspecialchars($row['state']) ?></p>
                        <p><strong>City:</strong> <?= htmlspecialchars($row['city']) ?></p>
                        <p><strong>Pincode:</strong> <?= htmlspecialchars($row['pincode']) ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
                    </div>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="delete-btn">
                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete User</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-muted">No users found.</p>
        <?php endif; ?>
    </div>

</body>
</html>
