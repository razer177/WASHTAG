<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Washtag | Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/img/favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    .contact-card {
    background: #ffffff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border-radius: 15px;
    padding: 40px;
    transition: transform 0.3s ease;
}

.contact-card:hover {
    transform: scale(1.02);
}

.contact-card h2 {
    font-weight: 700;
    color: #333;
}

.contact-card .form-label {
    font-weight: 600;
    color: #444;
}

.contact-card .form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    transition: border-color 0.3s;
}

.contact-card .form-control:focus {
    border-color: #007bff;
    box-shadow: none;
}

.contact-card .btn-primary {
    background: #007bff;
    border: none;
    border-radius: 10px;
    padding: 10px 30px;
    font-weight: 600;
    transition: background 0.3s ease;
}

.contact-card .btn-primary:hover {
    background: #0056b3;
}

    </style>
</head>
<body>
<!-- Preloader -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/loder.png" alt="Loading...">
            </div>
        </div>
    </div>
</div>

<!-- Header -->
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
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="services.php">Services</a></li>
                                <li class="active"><a href="contact.php">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="header-right d-none d-lg-block">
                
            </div>
            <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
            </div>
        </div>
    </div>
</header>

<!-- Contact Form -->
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="ccheck.php">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="number" name="phone" class="form-control" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="Message subject" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Your Message</label>
                    <textarea name="message" class="form-control" rows="5" placeholder="Write your message..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="footer-area footer-padding">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-logo mb-35">
                             <a href="index.php"><img style="width: 150px;" src="img/logo.png" alt=""></a>
                        </div>
                        <div class="footer-tittle">
                            <p>"Premium laundry care with doorstep pickup and delivery. Clean clothes, happy life."</p>
                        </div>
                        <div class="footer-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Services</h4>
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
                                <li><a href="#">info@washtag.com</a></li>
                                <li><a href="#">Near Maladevi Temple Karwar 581301</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-area section-bg2">
        <div class="container">
            <div class="footer-border">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="footer-copy-right text-center">
                            <p>© <script>document.write(new Date().getFullYear());</script> All rights reserved | Washtag is made with ❤️ by <a href="#" target="_blank">Bhargav</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</footer>

<!-- Scroll Up -->
<div id="back-top">
    <a title="Go to Top" href="#"><i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS -->
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
