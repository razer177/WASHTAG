<?php
session_start();

if (!isset($_SESSION['NAME'])) {
    header("Location: user_login.php");
    exit;
}

$user_email = $_SESSION['USER'];  // Or if you want email, store it during login and use $_SESSION['email']
$name = $_SESSION['NAME'];  // Assuming you store user's name in session during login
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome | Washtag Laundry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .service-card-3d {
    background-color:rgb(255, 255, 255); /* Black background */
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.64);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    /* color: #0000000; */
}

.service-card-3d:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 15px 30px rgba(255, 255, 255, 0.2);
}

.service-card-3d .card-body img {
    filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.4));
}

</style>
</head>
<body>

<!-- Header Start -->
<header>
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="header-left">
                <div class="logo">
                    <a href="dashboard.php"><img style="width: 80px;" src="assets/img/logo/logo.ico" alt="Logo"></a>
                </div>
                <div class="menu-wrapper d-flex align-items-center">
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li class="active"><a href="dashboard.php">Home</a></li>
                                <li><a href="services.php">Services</a></li>
                                <li><a href="feedback.php">Feedback</a></li>
                                <li><a href="user_view_booking.php">View Orders</a></li>
                                
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
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/img/hero/laundry-bg.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div style="margin-top:50px;margin-bottom:-100px"class="row no-gutters slider-text js-fullheight align-items-center justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <h1 class="mb-3 bread text-black">Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
                <p class="text-black">Choose from our premium laundry services below:</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-area section-padding30">
    <div class="container">
        <h2 class="text-center mb-5">Recommended For You</h2>
        <div class="row justify-content-center">
            <!-- Dry Cleaning Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-center h-100 service-card-3d">
                    <div class="card-body">
                        <img src="img/img1.jpeg" alt="Dry Cleaning" style="width:80px;" class="mb-3">
                        <h5 class="card-title text-black">Dry Cleaning</h5>
                        <p class="card-text text-dark">Expert dry cleaning service for your delicate clothes.</p>
                        <a href="services.php" class="btn btn-outline-light btn-sm">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Washing Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-center h-100 service-card-3d">
                    <div class="card-body">
                        <img src="img/img2.jpeg" alt="Washing" style="width:80px;" class="mb-3">
                        <h5 class="card-title text-black">Washing</h5>
                        <p class="card-text text-dark">Top-quality washing and detergent for freshness.</p>
                        <a href="services.php" class="btn btn-outline-light btn-sm">Book Now</a>
                    </div>
                </div>
            </div>

            <!-- Ironing Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-center h-100 service-card-3d">
                    <div class="card-body">
                        <img src="img/img3.jpeg" alt="Ironing" style="width:80px;" class="mb-3">
                        <h5 class="card-title text-black">Ironing</h5>
                        <p class="card-text text-dark">Perfect press and fold to make your clothes sharp.</p>
                        <a href="services.php" class="btn btn-outline-light btn-sm">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Access Cards -->
<section class="my-5">
    <style>
        .quick-access-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .quick-access-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }

        .quick-access-card .card-body i {
            transition: transform 0.3s ease;
        }

        .quick-access-card:hover .card-body i {
            transform: scale(1.2);
        }
    </style>

    <div class="container">
        <h2 class="text-center mb-4">Quick Access</h2>
        <div class="row">
            <!-- Services Card -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center quick-access-card">
                    <div class="card-body">
                        <i class="fas fa-tshirt fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Services</h5>
                        <p class="card-text">Explore our premium laundry offerings.</p>
                        <a href="services.php" class="btn btn-outline-primary btn-sm">View Services</a>
                    </div>
                </div>
            </div>

            <!-- View Orders Card -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center quick-access-card">
                    <div class="card-body">
                        <i class="fas fa-receipt fa-2x mb-3 text-success"></i>
                        <h5 class="card-title">My Orders</h5>
                        <p class="card-text">Track your current and past orders.</p>
                        <a href="user_view_booking.php" class="btn btn-outline-success btn-sm">View Orders</a>
                    </div>
                </div>
            </div>

            <!-- Feedback Card -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center quick-access-card">
                    <div class="card-body">
                        <i class="fas fa-comment-dots fa-2x mb-3 text-warning"></i>
                        <h5 class="card-title">Feedback</h5>
                        <p class="card-text">Tell us about your experience.</p>
                        <a href="feedback.php" class="btn btn-outline-warning btn-sm">Give Feedback</a>
                    </div>
                </div>
            </div>

            <!-- Logout Card -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 text-center quick-access-card">
                    <div class="card-body">
                        <i class="fas fa-sign-out-alt fa-2x mb-3 text-danger"></i>
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">End your session securely.</p>
                        <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
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

</body>
</html>