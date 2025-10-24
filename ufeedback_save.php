<?php 
session_start();
include 'includes/db.php'; // Connects to database

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    $name = test_input($_POST['name'] ?? '');
    $email = test_input($_POST['email'] ?? '');
    $service = test_input($_POST['Service Type'] ?? '');
    $rating = test_input($_POST['rating'] ?? '');
    $comments = test_input($_POST['comments'] ?? '');

    if (empty($name) || empty($email) || empty($comments) || empty($service) || empty($rating)) {
        echo '<script>alert("All fields are required!"); window.history.back();</script>';
        exit;
    }

    $conn = connectdb();

    // You should ensure this table matches these fields: name, email, number, service, rating, message
    $query = "INSERT INTO feedback (name, email, service, rating, comments) VALUES ( ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $name, $email, $service, $rating, $comments);

    if ($stmt->execute()) {
        echo '<script>alert("Your feedback is successfully sent!"); window.location="dashboard.php";</script>';
    } else {
        echo '<script>alert("Error posting feedback. Please try again."); window.history.back();</script>';
    }

    $stmt->close();
    $conn->close();
}
?>
