<?php
session_start();
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        jsAlertAndGoBack("Invalid request. Please reload the page.");
    }

    // Sanitize inputs
    $username = test_input($_POST['username'] ?? '');
    $email = test_input($_POST['email'] ?? '');
    $name = test_input($_POST['name'] ?? '');
    $phone = test_input($_POST['phone'] ?? '');
    $state = test_input($_POST['state'] ?? '');
    $city = test_input($_POST['city'] ?? '');
    $pincode = test_input($_POST['pincode'] ?? '');
    $address = test_input($_POST['address'] ?? '');
    $raw_password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';

    // Validation
    if (empty($username) || !preg_match("/^[a-zA-Z0-9_]{4,20}$/", $username)) {
        jsAlertAndGoBack("Username must be 4–20 characters long and contain only letters, numbers, or underscores.");
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsAlertAndGoBack("Invalid email address.");
    }

    if (empty($name) || !preg_match("/^[A-Za-z\s]+$/", $name)) {
        jsAlertAndGoBack("Name must contain only letters and spaces.");
    }

    if (empty($phone) || !preg_match("/^\d{10,15}$/", $phone)) {
        jsAlertAndGoBack("Phone number must be 10–15 digits long.");
    }
    if (empty($state)) {
        jsAlertAndGoBack("Please select a state.");
    }

    if (empty($city)) {
        jsAlertAndGoBack("Please select a city.");
    }
    if (empty($pincode) || !preg_match("/^\d{6}$/", $pincode)) {
        jsAlertAndGoBack("Pincode must be exactly 6 digits.");
    }
    if (empty($address)) {
        jsAlertAndGoBack("Address is required.");
    }

    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}$/", $raw_password)) {
        jsAlertAndGoBack("Password must be at least 6 characters and include letters, numbers, and symbols.");
    }

    if ($raw_password !== $repassword) {
        jsAlertAndGoBack("Passwords do not match.");
    }

    $mysqli = connectdb();

    // Check for existing email
    $stmt = $mysqli->prepare("SELECT email FROM register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        jsAlertAndGoBack("Email already registered. Try a different one.");
    }
    $stmt->close();

    // Check for existing username
    $stmt = $mysqli->prepare("SELECT username FROM register WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        jsAlertAndGoBack("Username already taken. Choose another one.");
    }
    $stmt->close();

    // Insert user
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO register (username, email, name,  phone, state, city, pincode,address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        log_error("Prepare failed: " . $mysqli->error);
        jsAlertAndRedirect("Internal error. Try again later.", "register.php");
    }

    $stmt->bind_param("sssssssss", $username, $email, $name, $phone,$state,$city,$pincode,$address, $hashed_password);
    if ($stmt->execute()) {
        unset($_SESSION['csrf_token']);
        jsAlertAndRedirect("Registration successful!", "user_login.php");
    } else {
        log_error("Insert failed: " . $stmt->error);
        jsAlertAndGoBack("Failed to register. Try again.");
    }

    $stmt->close();
    $mysqli->close();
}

// Helper Functions
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function log_error($message) {
    $logFile = __DIR__ . '/error_log.txt';
    error_log("[" . date('Y-m-d H:i:s') . "] " . $message . "\n", 3, $logFile);
}

function jsAlertAndGoBack($message) {
    echo generateModal($message, 'back');
    exit();
}

function jsAlertAndRedirect($message, $location) {
    echo generateModal($message, 'redirect', $location);
    exit();
}
function generateModal($message, $action = 'back', $location = '') {
    $onclick = $action === 'redirect' 
        ? "window.location='{$location}'" 
        : "window.history.back()";

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: rgba(0,0,0,0.2);
        }
        .overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        .modal {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            text-align: center;
            animation: fadeInZoom 0.5s ease-out;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .modal h3 {
            color: #cc0000;
            margin-bottom: 20px;
        }
        .modal button {
            padding: 10px 20px;
            border: none;
            background: #cc0000;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        .modal button:hover {
            background: #a30000;
        }

        @keyframes fadeInZoom {
            from {
                opacity: 0;
                transform: scale(0.7);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="modal">
            <h3>{$message}</h3>
            <button onclick="{$onclick}">OK</button>
        </div>
    </div>
</body>
</html>
HTML;
}
