<?php
session_start();
require_once 'includes/db.php';
header("Location: order_success.php");
exit;
$page_title = "Service Order";
$error = '';
$success = '';

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize_input($_POST['servicename']);
    $phone = sanitize_input($_POST['phone']);
    $role = sanitize_input($_POST['role']);
    $price = sanitize_input($_POST['price']);
    $description = sanitize_input($_POST['Description']);

    // Basic validations
    if (empty($name) || empty($phone) || empty($role) || empty($price) || empty($description)) {
        $error = "All fields are required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error = "Invalid phone number format.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO orders (customer_name, phone, service_type, price, description, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$name, $phone, $role, preg_replace('/[^0-9]/', '', $price), $description]);

            if ($stmt->rowCount() > 0) {
                $success = "Your order has been placed successfully!";
                $_POST = []; // clear form
            } else {
                $error = "Failed to place order. Please try again.";
            }
        } catch (PDOException $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation - Washtag</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Order Status</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
        <a href="index.php" class="btn btn-success mt-3">Back to Home</a>
    <?php else: ?>
        <a href="javascript:history.back()" class="btn btn-secondary mt-3">Go Back</a>
    <?php endif; ?>
</div>
</body>
</html>
