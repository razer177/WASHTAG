<?php
session_start();
require_once 'includes/db.php';
$conn = connectdb();

// Ensure admin is logged in
if (!isset($_SESSION['ADMIN_EMAIL'])) {
    echo "Access denied.";
    exit;
}

// Handle feedback deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_feedback'])) {
    $feedback_id = intval($_POST['feedback_id']);
    $stmt = mysqli_prepare($conn, "DELETE FROM feedback WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $feedback_id);
    mysqli_stmt_execute($stmt);
}

// Fetch all feedback
$result = mysqli_query($conn, "SELECT * FROM feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Feedback - Admin | WashTag</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body { background: #f4f6f9; padding: 30px; font-family: Arial, sans-serif; }
        .feedback-card { background: #fff; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .feedback-card h5 { margin: 0 0 10px 0; }
        .feedback-details p { margin: 4px 0; }
        .delete-btn { margin-top: 10px; }
    </style>
</head>
<body>

    <h2 class="text-center mb-4">Manage Feedback</h2>

    <div class="container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="feedback-card">
                    <h5><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['email']) ?>)</h5>
                    <div class="feedback-details">
                        <p><strong>User ID:</strong> <?= htmlspecialchars($row['user_id']) ?></p>
                        <p><strong>Service:</strong> <?= htmlspecialchars($row['service']) ?></p>
                        <p><strong>Rating:</strong> <?= htmlspecialchars($row['rating']) ?> / 5</p>
                        <p><strong>Comments:</strong> <?= nl2br(htmlspecialchars($row['comments'])) ?></p>
                        <p><small class="text-muted">Submitted on <?= htmlspecialchars($row['created_at']) ?></small></p>
                    </div>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');" class="delete-btn">
                        <input type="hidden" name="feedback_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_feedback" class="btn btn-danger btn-sm">Delete Feedback</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-muted">No feedback entries found.</p>
        <?php endif; ?>
    </div>

</body>
</html>
