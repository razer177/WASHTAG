<?php
session_start();

if (!isset($_SESSION['ADMIN_NAME'])) {
    header("Location: admin_login.php");
    exit;
}

$email = $_SESSION['ADMIN_NAME'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Washtag</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
    
    <style>
        .dashboard-card {
            border: 1px solid #eee;
            border-radius: 10px;
            transition: transform 0.3s;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 40px;
            color: #007bff;
        }
        .card-title {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>

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
                         <a class="navbar-brand" href="#">Washtag Admin</a>
                          Logged in as:  <strong><?php echo htmlspecialchars($email); ?></strong>
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

<!-- Navbar
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Washtag Admin</a>
    <div class="ml-auto text-white">
       
        <a href="logout.php" class="btn btn-danger btn-sm ml-3">Logout</a>
    </div>
</nav> -->

<!-- Hero Section -->
<header class="bg-primary text-white text-center py-4">
    <h1 class="mb-0">Admin Dashboard</h1>
    <p class="lead">Manage Users, Bookings, Feedback, and Delivery</p>
</header>

<!-- Main Cards Section -->
<div class="container my-5">
    <div class="row g-4">
        <!-- View Feedback -->
        <div class="col-md-4">
            <div class="card dashboard-card text-center p-4">
                <div class="card-icon mb-2"><i class="fas fa-comments"></i></div>
                <div class="card-title">View Feedback</div>
                <p>See all user feedback and ratings.</p>
                <a href="admin-feedback.php" class="btn btn-outline-primary">Go</a>
            </div>
        </div>

        <!-- Manage Feedback -->
        <div class="col-md-4">
            <div class="card dashboard-card text-center p-4">
                <div class="card-icon mb-2"><i class="fas fa-edit"></i></div>
                <div class="card-title">Manage Feedback</div>
                <p>Edit or delete feedback entries.</p>
                <a href="admin-manage-feedback.php" class="btn btn-outline-primary">Manage</a>
            </div>
        </div>

        <!-- View Users -->
        <!-- <div class="col-md-4">
            <div class="card dashboard-card text-center p-4">
                <div class="card-icon mb-2"><i class="fas fa-users"></i></div>
                <div class="card-title">View Users</div>
                <p>Browse all registered customers.</p>
                <a href="admin-users.php" class="btn btn-outline-primary">Go</a>
            </div>
        </div> -->

        <!-- Manage Users -->
        <div class="col-md-4">
            <div class="card dashboard-card text-center p-4">
                <div class="card-icon mb-2"><i class="fas fa-user-cog"></i></div>
                <div class="card-title">Manage Users</div>
                <p>Edit or remove user accounts.</p>
                <a href="manage_users.php" class="btn btn-outline-primary">Manage</a>
            </div>
        </div>

        <!-- View Bookings -->
        <!-- <div class="col-md-4"> -->
            <!-- <div class="card dashboard-card text-center p-4">
                <div class="card-icon mb-2"><i class="fas fa-calendar-check"></i></div>
                <div class="card-title">View Bookings</div>
                <p>Review all laundry bookings.</p>
                <a href="admin_view_booking.php" class="btn btn-outline-primary">Go</a>
            </div>
        </div> -->

        <!-- Manage Bookings -->
        <div class="col-md-4">
            <div class="card dashboard-card text-center p-4">
                <div class="card-icon mb-2"><i class="fas fa-tasks"></i></div>
                <div class="card-title">Manage Bookings</div>
                <p>Update booking status or assign staff.</p>
                <a href="admin_view_booking.php" class="btn btn-outline-primary">Manage</a>
            </div>
        </div>

        <!-- Manage Delivery -->
        <!-- <div class="col-md-4">
            <div class="card dashboard-card text-center p-4">
                <div class="card-icon mb-2"><i class="fas fa-shipping-fast"></i></div>
                <div class="card-title">Manage Delivery</div>
                <p>Assign deliveries or view status.</p>
                <a href="admin-delivery.php" class="btn btn-outline-primary">Go</a>
            </div>
        </div> -->
        <!-- View Payment -->
<!-- <div class="col-md-4">
    <div class="card dashboard-card text-center p-4">
        <div class="card-icon mb-2"><i class="fas fa-credit-card"></i></div>
        <div class="card-title">View Payment</div>
        <p>Check all customer payments and history.</p>
        <a href="admin-view-payments.php" class="btn btn-outline-primary">Go</a>
    </div>
</div> -->

<!-- Manage Payment -->
<!-- <div class="col-md-4">
    <div class="card dashboard-card text-center p-4">
        <div class="card-icon mb-2"><i class="fas fa-money-check-alt"></i></div>
        <div class="card-title">Manage Payment</div>
        <p>Edit payment records or handle disputes.</p>
        <a href="admin-manage-payments.php" class="btn btn-outline-primary">Manage</a>
    </div>
</div> -->

    </div>
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
                            <a href="index.html"><img style="width: 150px;" src="img/logo.png" alt=""></a>
                        </div>
                        <div class="footer-tittle">
                            <div class="footer-pera">
                                <p>"Premium laundry care with doorstep pickup and delivery. Clean clothes, happy life.".</p>
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
                            <li><a href="services.php">- Dry Cleaning</a></li>
                            <li><a href="services.php">- Washing</a></li>
                            <li><a href="services.php">- Ironing Services</a></li>
                            <li><a href="services.php">- Carpet Cleaning</a></li>
                            <li><a href="services.php">- More</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="single-footer-caption mb-50">
                    <div class="footer-tittle">
                        <h4>Get in touch</h4>
                        <ul>
                            <li class="number"><a href="#">+91 7892324047</a></li>
                            <li><a href="#">Info@washtag.com</a></li>
                            <li><a href="#">Near Maladevi Temple Karwar 581301</a></li>
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
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | WashTag is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Bhargav</a>
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

<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>