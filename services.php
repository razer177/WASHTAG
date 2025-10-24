<?php
session_start();
$page_title = "Services";

// Check if user is logged in
if (!isset($_SESSION['NAME'])) {
    header("Location: user_login.php?message=Please login to access services.");
    exit;
}

require_once 'includes/db.php';
$conn = connectdb();

$services = [];
$sql = "SELECT * FROM services ORDER BY id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $services[] = $row;
    }
}
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <title>Select Services | WashTag</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    .service-card {
        border: 2px solid #ddd;
        border-radius: 10px;
        transition: 0.3s;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .service-card.selected {
        border: 3px solid #28a745;
        box-shadow: 0 0 10px rgba(40,167,69,0.4);
    }

    .service-card img {
        height: 180px;
        object-fit: cover;
        width: 100%;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px;
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
                        <a  href="dashboard.php"><img style="width: 80px;" src="assets/img/logo/logo.ico" alt=""></a>
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
    <h2 class="text-center mb-4">Select Your Laundry Services</h2>
    <form action="order.php" method="POST" id="serviceForm">
        <div class="row">
            <?php foreach ($services as $service): ?>
                <div class="col-sm-6 col-md-4 mb-4 d-flex">
                    <div class="card service-card w-100" data-id="<?= $service['id'] ?>">
                        <img src="<?= $service['image'] ?>" class="card-img-top" alt="<?= $service['name'] ?>">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title"><?= $service['name'] ?></h5>
                                <p class="card-text"><?= $service['description'] ?></p>
                                <p class="text-success font-weight-bold">₹<?= $service['price'] ?></p>
                            </div>
                            <input type="hidden" name="service_ids[]" class="service-hidden" value="<?= $service['id'] ?>" disabled>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-3">
            <button type="submit" name="start_order" class="btn btn-success px-5 py-3 fs-3" style="min-width: 200px;font-size: 2rem;">Continue</button>
        </div>
    </form>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll('.service-card');

    cards.forEach(card => {
        const hiddenInput = card.querySelector('.service-hidden');

        card.addEventListener('click', () => {
            const isSelected = card.classList.toggle('selected');
            hiddenInput.disabled = !isSelected;
        });
    });

    // Prevent form submission if no card is selected
    document.getElementById('serviceForm').addEventListener('submit', function(e) {
        const selected = document.querySelectorAll('.service-card.selected');
        if (selected.length === 0) {
            alert("Please select at least one service.");
            e.preventDefault();
        }
    });
});
</script>



<script>
document.getElementById('serviceForm').addEventListener('submit', function(e) {
    const selected = document.querySelectorAll('.service-card.selected');
    if (selected.length === 0) {
        alert("Please select at least one service.");
        e.preventDefault();
    }
});
</script>
<script>
document.getElementById('serviceForm').addEventListener('submit', function(e) {
    const selected = document.querySelectorAll('.service-card.selected');
    if (selected.length === 0) {
        alert("Please select at least one service.");
        e.preventDefault();
    }
});
</script>


</body>
</html>
