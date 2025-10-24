e:\akhi\login_check1.php<?php
session_start();
include 'includes/db.php'; // Make sure this connects to your DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = test_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsAlertAndGoBack("Please enter a valid email.");
    }

    if (empty($password)) {
        jsAlertAndGoBack("Please enter your password.");
    }

    $mysqli = connectdb();
    $stmt = $mysqli->prepare("SELECT password, full_name FROM admin WHERE email = ?");
    if (!$stmt) {
        jsAlertAndGoBack("Database error. Try again later.");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword, $name);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
             // clear CSRF token
            $_SESSION['ADMIN_EMAIL'] = $email;
            $_SESSION['ADMIN_NAME'] = $name;
            echo '<script>alert("Login successful!"); window.location="admin_dashboard.php";</script>';
        } else {
            jsAlertAndGoBack("Incorrect password.");
        }
    } else {
        jsAlertAndGoBack("Account not found.");
    }

    $stmt->close();
    $mysqli->close();
}

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function jsAlertAndGoBack($msg) {
    echo "<script>alert('" . addslashes($msg) . "'); window.history.back();</script>";
    exit();
}
?>
