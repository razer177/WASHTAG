<?php
// START SESSION IF NEEDED
session_start();

// DATABASE CONFIGURATION
$host = "localhost";
$dbname = "razer_db";
$user = "root";
$pass = "";

// CONNECT TO DATABASE
$conn = new mysqli($host, $user, $pass, $dbname);

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// FUNCTION TO SANITIZE INPUT
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// CHECK IF FORM SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // SANITIZE AND VALIDATE INPUT
    $name        = clean_input($_POST["name"] ?? '');
    $email       = clean_input($_POST["email"] ?? '');
    $phone       = clean_input($_POST["phone"] ?? '');
    $address     = clean_input($_POST["address"] ?? '');
    $pickup_date = clean_input($_POST["pickup_date"] ?? '');
    $services    = $_POST["services"] ?? [];

    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($pickup_date) || empty($services)) {
        echo "<h3 style='color:red; text-align:center;'>Please fill all required fields.</h3>";
        exit;
    }

    // CONVERT SERVICES ARRAY TO STRING
    $services_str = implode(", ", $services);

    // PREPARE SQL
    $stmt = $conn->prepare("INSERT INTO orders (name, email, phone, address, pickup_date, services) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $address, $pickup_date, $services_str);

    if ($stmt->execute()) {
        echo "<h2 style='text-align:center; color:green;'>Thank you $name! Your laundry order has been placed successfully.</h2>";
        echo "<p style='text-align:center;'>We will contact you shortly at <strong>$phone</strong> or <strong>$email</strong>.<br><a href='index.html'>Return Home</a></p>";
    } else {
        echo "<h3 style='color:red; text-align:center;'>Something went wrong. Please try again later.</h3>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h3 style='color:red; text-align:center;'>Invalid request.</h3>";
}
?>
