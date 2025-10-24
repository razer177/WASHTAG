<?php
session_start();
if (!isset($_SESSION['DELIVERY_EMAIL'])) {
    header("location:delivery_login.php");
    exit;
}
$delivery_email = $_SESSION['DELIVERY_EMAIL'];
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Delivery Dashboard | Washtag Laundry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Header Start -->
<header>
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="header-left">
                <div class="logo">
                    <a href="index.php"><img style="width: 80px;" src="assets/img/logo/logo.ico" alt="Logo"></a>
                </div>
                <div class="menu-wrapper d-flex align-items-center">
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li class="active"><a href="delivery-dashboard.php">Dashboard</a></li>
                                <li><a href="view_orders.php">View Orders</a></li>
                                <li><a href="delivery_schedule.php">Schedule</a></li>
                                <li><a href="live_map.php">Live Map</a></li>
                                <li><a href="delivery_profile.php">Profile</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div> 
            <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/img/hero/delivery-bg.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread text-white">Welcome, <?php echo htmlspecialchars($delivery_email); ?>!</h1>
                <p class="text-white">Manage your delivery orders efficiently with Washtag.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="services-area section-padding30">
    <div class="container">
        <div class="row justify-content-center">

            <!-- View Orders -->
            <div class="col-lg-4 col-md-6 text-center mb-4">
                <div class="single-service">
                    <img src="assets/img/gallery/order.png" alt="Orders" style="width:80px;">
                    <h4>View Orders</h4>
                    <p>Access assigned pickups and delivery details.</p>
                    <a href="view_orders.php" class="btn btn-primary mt-2">View</a>
                </div>
            </div>

            <!-- Accept/Reject Orders -->
            <div class="col-lg-4 col-md-6 text-center mb-4">
                <div class="single-service">
                    <img src="assets/img/gallery/accept.png" alt="Accept" style="width:80px;">
                    <h4>Accept / Reject</h4>
                    <p>Manage new order requests quickly.</p>
                    <a href="view_orders.php" class="btn btn-primary mt-2">Manage</a>
                </div>
            </div>

            <!-- Live Map -->
            <div class="col-lg-4 col-md-6 text-center mb-4">
                <div class="single-service">
                    <img src="assets/img/gallery/map.png" alt="Map" style="width:80px;">
                    <h4>Check Route</h4>
                    <p>Navigate with live map to reach customers easily.</p>
                    <a href="live_map.php" class="btn btn-primary mt-2">Open Map</a>
                </div>
            </div>

            <!-- Mark as Delivered -->
            <div class="col-lg-4 col-md-6 text-center mb-4">
                <div class="single-service">
                    <img src="assets/img/gallery/delivered.png" alt="Delivered" style="width:80px;">
                    <h4>Update Status</h4>
                    <p>Mark orders as Picked or Delivered.</p>
                    <a href="view_orders.php" class="btn btn-primary mt-2">Update</a>
                </div>
            </div>

            <!-- Schedule -->
            <div class="col-lg-4 col-md-6 text-center mb-4">
                <div class="single-service">
                    <img src="assets/img/gallery/schedule.png" alt="Schedule" style="width:80px;">
                    <h4>Delivery Schedule</h4>
                    <p>Check your weekly delivery plan.</p>
                    <a href="delivery_schedule.php" class="btn btn-primary mt-2">View</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer-area footer-padding">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4">
                <div class="single-footer-caption">
                    <div class="footer-logo">
                        <a href="index.php"><img src="assets/img/logo/logo.png" style="width:150px;" alt=""></a>
                    </div>
                    <p>"Efficient deliveries, happy customers – Washtag Delivery Team."</p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="view_orders.php">View Orders</a></li>
                    <li><a href="live_map.php">Live Map</a></li>
                    <li><a href="delivery_schedule.php">Schedule</a></li>
                    <li><a href="delivery_profile.php">Profile</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h4>Contact</h4>
                <ul>
                    <li>📞 +91 7892324047</li>
                    <li>📧 support@washtag.com</li>
                    <li>📍 Near Maladevi Temple, Karwar 581301</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center pt-3">
        <p>&copy; <?php echo date("Y"); ?> Washtag Laundry | Powered by Bhargav</p>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
