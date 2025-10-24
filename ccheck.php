<?php
session_start();
include 'includes/db.php';

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $subject = test_input($_POST['subject']);
    $message = test_input($_POST['message']);
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $mysqli = connectdb();

        $stmt = $mysqli->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

            if ($stmt->execute()) {
                
                $success = '✅ Thank you for contacting us! We will get back to you within 24 hours.';
                $_POST = array(); // clear form
            } else {
                $error = '❌ Failed to send message. Error: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = '❌ Database error: ' . $mysqli->error;
        }

        $mysqli->close();
    }
}
?>