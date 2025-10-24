<?php
session_start();
require_once 'includes/db.php';
$conn = connectdb();

if (!isset($_SESSION['USER'])) {
    header("Location: login.php");
    exit;
}

$user_email = $_SESSION['USER_EMAIL'];
$user_name = "";

// Fetch user name
$stmt = mysqli_prepare($conn, "SELECT name FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $user_email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_name);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Get latest order
$order_result = mysqli_query($conn, "SELECT * FROM orders2 WHERE user_email = '$user_email' ORDER BY id DESC LIMIT 1");
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    echo "<div class='container mt-5'><h4>No recent order found.</h4></div>";
    exit;
}

$order_id = $order['id'];
$pickup_date = $order['pickup_date'];
$address = $order['address'];
$payment_method = $order['payment_method'];
$total = $order['total'];

// Get associated services
$services_result = mysqli_query($conn, "
    SELECT s.name, s.price, oi.quantity 
    FROM orders oi
    JOIN services s ON oi.service_id = s.id
    WHERE oi.order_id = $order_id
");

$services = [];
while ($row = mysqli_fetch_assoc($services_result)) {
    $row['subtotal'] = $row['price'] * $row['quantity'];
    $services[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Summary - WashTag</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .receipt-container {
            background: #fff;
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .receipt-header h2 {
            color: #28a745;
        }
        .order-info {
            margin-bottom: 20px;
        }
        .service-list {
            border-top: 2px solid #eee;
            margin-top: 20px;
            padding-top: 20px;
        }
        .service-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 15px;
        }
        .btn-dashboard {
            background: #28a745;
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: block;
            text-align: center;
            margin: 30px auto 0;
            width: 250px;
        }
        .btn-dashboard:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="header-left">
                <div class="logo">
                    <a href="index.php"><img style="width: 80px;" src="assets/img/logo/logo.ico" alt=""></a>
                </div>
            </div>
            <div class="header-right d-none d-lg-block">
                <a href="logout.php" class="header-btn2">Logout</a>
            </div>
        </div>
    </div>
</header>

<div class="receipt-container">
    <div class="receipt-header">
        <h2>Order Placed Successfully!</h2>
        <p>Thank you, <strong><?= htmlspecialchars($user_name) ?></strong> for choosing WashTag</p>
    </div>

    <div class="order-info">
        <p><strong>Name:</strong> <?= $user_email ?></p>
        <p><strong>Order ID:</strong> <?= $order_id ?></p>
        <p><strong>Pickup Date:</strong> <?= $pickup_date ?></p>
        <p><strong>Delivery Address:</strong> <?= htmlspecialchars($address) ?></p>
        <p><strong>Payment Method:</strong> <?= $payment_method ?></p>
    </div>

    <div class="service-list">
        <h4>Services Summary</h4>
        <?php foreach ($services as $service): ?>
            <div class="service-item">
                <span><?= htmlspecialchars($service['name']) ?> × <?= $service['quantity'] ?></span>
                <span>₹<?= $service['subtotal'] ?></span>
            </div>
        <?php endforeach; ?>
        <div class="total">Grand Total: ₹<?= $total ?></div>
    </div>

    <a href="dashboard.php" class="btn-dashboard">Go to Dashboard</a>
</div>

<footer class="footer-area footer-padding">
    <div class="container text-center mt-5">
        <p>© <?= date('Y') ?> WashTag - All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>
