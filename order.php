<?php
session_start();
require_once 'includes/db.php';
$conn = connectdb();

// --- Session timeout (30 minutes) ---
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();     // Unset session variables
    session_destroy();   // Destroy session
    header("Location: user_login.php?timeout=1");
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity

// --- Login check ---
if (!isset($_SESSION['NAME'])) {
    // Redirect to login page with redirect back to this page
    $redirect = urlencode($_SERVER['REQUEST_URI']);
    header("Location: user_login.php?redirect=$redirect");
    exit;
}

$name = $_SESSION['NAME'];
$email = $_SESSION['USER_EMAIL'] ?? '';
$user_name = "";
$success = "";

// --- Fetch user name (optional) ---
$stmt = mysqli_prepare($conn, "SELECT name FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_name);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// --- Store selected services in session (from previous form) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_ids']) && !isset($_POST['confirm_order'])) {
    $_SESSION['selected_services'] = $_POST['service_ids'];
}

$service_ids = $_SESSION['selected_services'] ?? [];
$selectedServices = [];

if (!empty($service_ids)) {
    $ids = array_map('intval', $service_ids);
    $id_list = implode(',', $ids);
    $result = mysqli_query($conn, "SELECT * FROM services WHERE id IN ($id_list)");

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $row['quantity'] = 1;
            $row['subtotal'] = $row['price'];
            $selectedServices[] = $row;
        }
    }
}

// --- Handle order confirmation ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    $pickup_date = $_POST['pickup_date'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $service_ids = $_POST['service_ids'] ?? [];
    $quantities = $_POST['quantities'] ?? [];

    $total = 0;
    $items = [];

    foreach ($service_ids as $sid) {
        $sid = intval($sid);
        $qty = intval($quantities[$sid] ?? 1);
        if ($qty <= 0) continue;

        $price_query = mysqli_query($conn, "SELECT price FROM services WHERE id = $sid");
        $price_row = mysqli_fetch_assoc($price_query);
        $subtotal = $price_row['price'] * $qty;
        $total += $subtotal;

        $items[] = [
            'service_id' => $sid,
            'quantity' => $qty,
            'subtotal' => $subtotal
        ];
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO orders2 (user_email, pickup_date, address, payment_method, total) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssd", $email, $pickup_date, $address, $payment_method, $total);

    if (mysqli_stmt_execute($stmt)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($items as $item) {
            mysqli_query($conn, "INSERT INTO orders (order_id, service_id, quantity) VALUES ($order_id, {$item['service_id']}, {$item['quantity']})");
        }
        $success = "Order placed successfully!";
        unset($_SESSION['selected_services']);
    } else {
        $success = "Error placing order.";
    }

    mysqli_stmt_close($stmt);
}
?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Laundry | Teamplate</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        .service-summary { border: 1px solid #ccc; padding: 20px; margin-bottom: 15px; border-radius: 8px; }
        <style>
    .service-summary img {
        max-height: 150px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
  
body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }
        form {
            background: #fff;
            max-width: 800px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .summary {
            margin-top: 30px;
            border-top: 2px solid #ddd;
            padding-top: 20px;
        }
        .order-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
        }
        .order-item img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
            border-radius: 6px;
            object-fit: cover;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 15px;
        }
        .success {
            background: #d4edda;
            color:rgb(6, 116, 242);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #c3e6cb;
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }
        button {
            margin-top: 25px;
            background-color:rgb(82, 194, 255);
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
        }
        button:hover {
            background-color:rgb(75, 159, 255);
        }
  
</style>
</head>
<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <!-- Logo -->
                <div class="header-left">
                    <div class="logo">
                        <a  href="index.php"><img style="width: 80px;" src="assets/img/logo/logo.ico" alt=""></a>
                    </div>
                    <div class="menu-wrapper  d-flex align-items-center">
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav> 
                                <ul id="navigation">                                                                                          
                                    <li class="active"><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li><a href="services.php">Services</a></li>
                                    
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div> 
                <div class="header-right d-none d-lg-block">
                    
                    
                    <a href="logout.php" class="header-btn2">Logout </a>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
<div class="container my-5">
   
    <?php if (!empty($success)): ?>
        <div class="success"><?= $success ?></div>
        <a href="user_view_booking.php" class="btn btn-primary">View My Orders</a>
    <?php elseif (!empty($selectedServices)): ?>
        <form method="POST">
            <h2>Review & Confirm Your Order</h2>

            <label>Email:</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($name) ?>" readonly>

            <label>Pickup Date:</label>
            <input type="date" class="form-control" name="pickup_date" id="pickup_date" required>

            <label>Address:</label>
            <textarea class="form-control" name="address" required></textarea>

            <label>Payment Method:</label>
            <select class="form-control" name="payment_method" required>
                <option value="">-- Select Payment Method --</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Online Payment">Online Payment</option>
            </select>

            <h4 class="mt-4">Selected Services</h4>
            <?php foreach ($selectedServices as $service): ?>
                <div class="order-item">
                    <img src="<?= $service['image'] ?>" alt="<?= htmlspecialchars($service['name']) ?>">
                    <div>
                        <strong><?= htmlspecialchars($service['name']) ?></strong><br>
                        ₹<?= $service['price'] ?> × 
                        <input type="number" class="form-control d-inline-block qty-input" name="quantities[<?= $service['id'] ?>]" data-price="<?= $service['price'] ?>" value="1" min="1" style="width: 70px;">
                        <input type="hidden" name="service_ids[]" value="<?= $service['id'] ?>">
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="total-section">Total: ₹<span id="grandTotal">0</span></div>

            <button type="submit" name="confirm_order" class="btn btn-success">Place Order</button>
        </form>
    <?php else: ?>
        <p>No services selected. <a href="services.php">Go back to services</a></p>
    <?php endif; ?>


</div>
<footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                     <div class="single-footer-caption mb-50">
                       <div class="single-footer-caption mb-30">
                        <!-- logo -->
                        <div class="footer-logo mb-35">
                            <a href="dashboard.php"><img style="width: 150px;" src="img/logo.png" alt=""></a>
                        </div>
                        <div class="footer-tittle">
                            <div class="footer-pera">
                                <p>Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.</p>
                            </div>
                        </div>
                        <!-- social -->
                        <div class="footer-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="single-footer-caption mb-50">
                    <div class="footer-tittle">
                        <h4>Services </h4>
                        <ul>
                            <li><a href="#">- Dry Cleaning</a></li>
                            <li><a href="#">- Dry Clean</a></li>
                            <li><a href="#">- Ironing Services</a></li>
                            <li><a href="#">- Laundry Service London</a></li>
                            <li><a href="#">- Laundry App</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="single-footer-caption mb-50">
                    <div class="footer-tittle">
                        <h4>Get in touch</h4>
                        <ul>
                            <li class="number"><a href="#">(90) 898 789-8957</a></li>
                            <li><a href="#">laundry@567.com</a></li>
                            <li><a href="#">789/A, Green road NYC-9089</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer-bottom area -->
<div class="footer-bottom-area section-bg2" data-background="assets/img/gallery/footer-bg.png">
    <div class="container">
        <div class="footer-border">
           <div class="row d-flex align-items-center">
               <div class="col-xl-12 ">
                   <div class="footer-copy-right text-center">
                       <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer End-->
</footer>
<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->

<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Date Picker -->
<script src="./assets/js/gijgo.min.js"></script>
<!-- Nice-select, sticky -->
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>
<!-- Progress -->
<script src="./assets/js/jquery.barfiller.js"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/waypoints.min.js"></script>
<script src="./assets/js/jquery.countdown.min.js"></script>
<script src="./assets/js/hover-direction-snake.min.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<script src="assets/js/jquery-1.12.4.min.js"></script>
<script>
function updateTotal() {
    let total = 0;
    document.querySelectorAll('.qty-input').forEach(input => {
        const price = parseFloat(input.dataset.price);
        const qty = parseInt(input.value) || 0;
        total += price * qty;
    });
    document.getElementById('grandTotal').textContent = total.toFixed(2);
}
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', updateTotal);
});
updateTotal();
</script>
<script>
  // Get today's date in YYYY-MM-DD format
  const today = new Date().toISOString().split('T')[0];

  // Set it as the minimum selectable date
  document.getElementById("pickup_date").setAttribute("min", today);
</script>

</body>
</html>