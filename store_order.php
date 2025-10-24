<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['USER'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$conn = connectdb();
$user_id = $_SESSION['USER'];
$payment_method = $_POST['payment_method'] ?? '';

// Update payment method for the latest orders for the user
if ($payment_method) {
    $stmt = $conn->prepare("UPDATE orders SET payment_method = ? WHERE user_id = ? AND payment_method IS NULL");
    $stmt->bind_param("si", $payment_method, $user_id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No payment method provided']);
}
?>
