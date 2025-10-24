<?php
session_start();
require_once 'includes/db.php';  
$conn = connectdb();

if (!isset($_SESSION['USER'])) {
    header("Location: user_login.php");
    exit;
}

$user_id = $_SESSION['USER'];
$user_email = $_SESSION['EMAIL'] ?? '';

// Fetch latest orders for the user
$order_items = [];
$total_price = 0;

$stmt = $conn->prepare("
    SELECT o.id, s.name, o.quantity, o.total_price
    FROM orders o
    JOIN services s ON o.service_id = s.id
    WHERE o.user_id = ?
    ORDER BY o.created_at DESC
");

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $order_items[] = $row;
        $total_price += $row['total_price'];
    }
    $stmt->close();
} else {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment | Washtag</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .payment-methods label { margin-right: 20px; }
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            border: 2px solid #28a745;
            padding: 30px;
            text-align: center;
            display: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Review Your Order</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Service</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($order_items as $row): ?>
        <?php
            $unit_price = $row['quantity'] > 0 ? ($row['total_price'] / $row['quantity']) : 0;
        ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>₹<?= number_format($unit_price, 2) ?></td>
            <td>₹<?= number_format($row['total_price'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>

        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Grand Total</th>
                <th>₹<?= $total_price ?></th>
            </tr>
        </tfoot>
    </table>

    <h3 class="mt-4">Select Payment Method</h3>
    <form id="paymentForm" method="post" action="store_order.php">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" value="card" required>
            <label class="form-check-label">Credit/Debit Card</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" value="upi">
            <label class="form-check-label">UPI</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" value="netbanking">
            <label class="form-check-label">Net Banking</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" value="cod">
            <label class="form-check-label">Cash on Delivery</label>
        </div>

        <button type="submit" class="btn btn-success mt-3">Confirm Payment</button>
    </form>
</div>

<div class="popup" id="popup">
    <h4>✅ Payment Successful</h4>
    <p>Your order has been placed successfully.</p>
    <a href="view_booking.php" class="btn btn-primary mt-2">View Bookings</a>
</div>

<script>
    $("#paymentForm").submit(function(e) {
        e.preventDefault();

        const method = $("input[name='payment_method']:checked").val();
        if (!method) return alert("Please select a payment method.");

        $.post("store_order.php", {
            payment_method: method
        }, function(response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    $("#popup").fadeIn();
                } else {
                    alert("Error: " + data.message);
                }
            } catch (e) {
                alert("Unexpected error occurred.");
            }
        });
    });
</script>

</body>
</html>
