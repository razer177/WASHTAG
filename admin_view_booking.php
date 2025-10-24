<?php
session_start();
require_once 'includes/db.php';
$conn = connectdb();

if (!isset($_SESSION['ADMIN_EMAIL'])) {
    echo "Access denied.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = $_POST['status'];

    if ($new_status === 'cancelled') {
        // First delete from child table
        $stmt1 = mysqli_prepare($conn, "DELETE FROM orders WHERE order_id = ?");
        mysqli_stmt_bind_param($stmt1, "i", $order_id);
        mysqli_stmt_execute($stmt1);

        // Then delete from parent table
        $stmt2 = mysqli_prepare($conn, "DELETE FROM orders2 WHERE id = ?");
        mysqli_stmt_bind_param($stmt2, "i", $order_id);
        mysqli_stmt_execute($stmt2);
    } else {
        // Just update the status
        $stmt = mysqli_prepare($conn, "UPDATE orders2 SET status = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $new_status, $order_id);
        mysqli_stmt_execute($stmt);
    }
}

// Join order_items and services to get all order item details
$sql = "SELECT o.*, oi.service_id, oi.quantity, oi.subtotal, s.name AS service_name, s.image AS service_image 
        FROM orders2 o 
        JOIN orders oi ON o.id = oi.order_id 
        JOIN services s ON oi.service_id = s.id 
        ORDER BY o.id DESC";

$result = mysqli_query($conn, $sql);

$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orders[$row['id']]['info'] = $row;
    $orders[$row['id']]['items'][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - All Orders | WashTag</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; padding: 30px; font-family: Arial, sans-serif; }
        .order-block { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .order-header { border-bottom: 1px solid #ddd; margin-bottom: 10px; padding-bottom: 10px; }
        .order-item { display: flex; margin-bottom: 10px; }
        .order-item img { width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border-radius: 6px; }
        .order-details { flex: 1; }
        form.status-form { margin-top: 10px; display: flex; gap: 10px; align-items: center; }
        select.form-select { max-width: 200px; }
    </style>
</head>
<body>
    <h2 class="text-center mb-4">All Customer Orders</h2>
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $orderId => $data): ?>
            <div class="order-block">
                <div class="order-header">
                    <h5>Order #<?= $orderId ?> | User: <?= $data['info']['user_email'] ?></h5>
                    <p>Pickup: <?= $data['info']['pickup_date'] ?> | Address: <?= $data['info']['address'] ?> | Payment: <?= $data['info']['payment_method'] ?> | 
                        <strong>Total:</strong> ₹<?= $data['info']['total'] ?> | 
                        <strong>Status:</strong> <?= ucfirst($data['info']['status']) ?>
                    </p>
                    <form method="POST" class="status-form">
                        <input type="hidden" name="order_id" value="<?= $orderId ?>">
                        <select name="status" class="form-select" required>
                            <?php
                            $statuses = ['pending', 'approved', 'rejected', 'delivered', 'cancelled'];
                            foreach ($statuses as $status) {
                                $selected = ($data['info']['status'] === $status) ? 'selected' : '';
                                echo "<option value=\"$status\" $selected>" . ucfirst($status) . "</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" name="update_status" class="btn btn-sm btn-primary">Update Status</button>
                    </form>
                </div>
                <?php foreach ($data['items'] as $item): ?>
                    <div class="order-item">
                        <img src="<?= $item['service_image'] ?>" alt="<?= htmlspecialchars($item['service_name']) ?>">
                        <div class="order-details">
                            <strong><?= htmlspecialchars($item['service_name']) ?></strong><br>
                            Quantity: <?= $item['quantity'] ?> | Subtotal: ₹<?= $item['subtotal'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">No orders found.</p>
    <?php endif; ?>
</body>
</html>
