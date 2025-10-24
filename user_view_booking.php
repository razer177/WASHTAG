<?php
session_start();
require_once 'includes/db.php';
$conn = connectdb();

if (!isset($_SESSION['USER'])) {
    echo "Please log in to view your bookings.";
    exit;
}

$user_email = $_SESSION['USER_EMAIL'];

// Cancel order if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
    $order_id = intval($_POST['order_id']);
    $check_sql = "SELECT * FROM orders2 WHERE id = ? AND user_email = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "is", $order_id, $user_email);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        $cancel_stmt = mysqli_prepare($conn, "UPDATE orders2 SET status = 'cancelled' WHERE id = ?");
        mysqli_stmt_bind_param($cancel_stmt, "i", $order_id);
        mysqli_stmt_execute($cancel_stmt);
    }
}

// Fetch user's non-cancelled orders
$sql = "SELECT o.id AS order_id, o.pickup_date, o.status, o.address, o.payment_method, o.total,
               oi.service_id, oi.quantity, oi.subtotal,
               s.name AS service_name, s.image AS service_image
        FROM orders2 o
        JOIN orders oi ON o.id = oi.order_id
        JOIN services s ON oi.service_id = s.id
        WHERE o.user_email = ? AND LOWER(o.status) != 'cancelled'
        ORDER BY o.id DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $user_email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orderId = $row['order_id'];

    if (!isset($orders[$orderId])) {
        $orders[$orderId]['info'] = [
            'pickup_date' => $row['pickup_date'],
            'status' => $row['status'],
            'address' => $row['address'],
            'payment_method' => $row['payment_method'],
            'total' => $row['total']
        ];
        $orders[$orderId]['items'] = [];
    }

    $orders[$orderId]['items'][] = [
        'service_name' => $row['service_name'],
        'quantity' => $row['quantity'],
        'subtotal' => $row['subtotal'],
        'service_image' => $row['service_image']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - WashTag</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; padding: 30px; font-family: Arial, sans-serif; }
        .order-block { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .order-header { border-bottom: 1px solid #ddd; margin-bottom: 10px; padding-bottom: 10px; }
        .order-header h5 { margin: 0; }
        .order-item { display: flex; margin-bottom: 10px; }
        .order-item img { width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border-radius: 6px; }
        .order-details { flex: 1; }
        .cancel-btn { margin-top: 10px; }
        .no-orders { text-align: center; color: #888; margin-top: 40px; font-size: 18px; }
    </style>
</head>
<body>
    <h2 class="text-center mb-4">My WashTag Bookings</h2>

    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $orderId => $data): ?>
            <div class="order-block">
                <div class="order-header">
                    <h5>Order #<?= $orderId ?> | Pickup: <?= htmlspecialchars($data['info']['pickup_date']) ?> | Status: <?= ucfirst(htmlspecialchars($data['info']['status'])) ?></h5>
                    <p><strong>Address:</strong> <?= htmlspecialchars($data['info']['address']) ?> |
                       <strong>Payment:</strong> <?= htmlspecialchars($data['info']['payment_method']) ?> |
                       <strong>Total:</strong> ₹<?= htmlspecialchars($data['info']['total']) ?></p>
                </div>

                <?php foreach ($data['items'] as $item): ?>
                    <div class="order-item">
                        <img src="<?= htmlspecialchars($item['service_image']) ?>" alt="">
                        <div class="order-details">
                            <strong><?= htmlspecialchars($item['service_name']) ?></strong><br>
                            Quantity: <?= (int)$item['quantity'] ?> | Subtotal: ₹<?= (float)$item['subtotal'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php
                    $status = strtolower($data['info']['status']);
                    if ($status === 'pending' || $status === 'approved'):
                ?>
                    <form method="POST" class="cancel-btn">
                        <input type="hidden" name="order_id" value="<?= $orderId ?>">
                        <button type="submit" name="cancel_order" class="btn btn-danger btn-sm">Cancel Order</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-orders">You have not placed any active orders.</div>
    <?php endif; ?>
</body>
</html>
