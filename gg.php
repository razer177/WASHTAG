<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EventSpark</title>
  
  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/themefisher-font/style.css" rel="stylesheet">
  <link href="plugins/font-awsome/css/font-awesome.min.css" rel="stylesheet">
  <link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="plugins/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="images/favicon.png" rel="shortcut icon">
  <style>
  label {
  display: block;
  margin-bottom: 5px;
  font-weight: 600;
  color: #333;
}

.form-control.main {
  display: block;
  width: 100%;
  padding: 10px 14px;
  font-size: 16px;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 8px;
  transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

.contact-form .row > div {
  margin-bottom: 20px;
}

  </style>
</head>

<body class="body-wrapper">

<!-- Navigation -->
<nav class="navbar main-nav border-less fixed-top navbar-expand-lg p-0">
  <div class="container-fluid p-0">
      <a class="navbar-brand" href="index.html"><img src="EventSpark.png" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown active dropdown-slide">
            <a class="nav-link" href="#" data-toggle="dropdown">Home<span>/</span></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="index.html">Homepage</a>
              <a class="dropdown-item" href="homepage-two.html">Homepage 2</a>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="speakers.html">Speakers<span>/</span></a></li>
          <li class="nav-item dropdown dropdown-slide">
            <a class="nav-link" href="#" data-toggle="dropdown">Pages<span>/</span></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="about-us.html">About Us</a>
              <a class="dropdown-item" href="single-speaker.html">Single Speaker</a>
              <a class="dropdown-item" href="gallery.html">Gallery</a>
              <a class="dropdown-item" href="testimonial.html">Testimonial</a>
              <a class="dropdown-item" href="pricing.html">Pricing</a>
              <a class="dropdown-item" href="FAQ.html">FAQ</a>
              <a class="dropdown-item" href="404.html">404</a>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule<span>/</span></a></li>
          <li class="nav-item"><a class="nav-link" href="sponsors.html">Sponsors<span>/</span></a></li>
             <li class="nav-item"><a class="nav-link" href="Register.php">Registration<span>/</span></a></li>
          <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
        </ul>
        <a href="#" class="ticket"><img src="images/icon/ticket.png" alt="ticket"><span>Buy Ticket</span></a>
      </div>
  </div>
</nav>

<!-- Page Title -->
<section class="page-title bg-title overlay-dark">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <div class="title"><h3>Contact Us</h3></div>
        <ol class="breadcrumb p-0 m-0">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Contact Us</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Contact Form -->
<section class="section contact-form">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h3>Get in <span class="alternate"> Events</span></h3>
        </div>
      </div>
    </div>

    <form name="events Form" action="events_check.php" method="POST">
      <h2>Events Form</h2>
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <div class="row">
        
		
		 <div class="col-md-6">
            <label for="EventName">Event Name:</label>
      <select class="form-control main" name="EventName" id="EventName" required>
        <option value="" disabled selected>Select Event Name</option>
        <option value="Marriage">Marriage</option>
        <option value="Birthday">Birthday</option>
        <option value="Engagment">Engagment</option>
		        <option value="Party">Party</option>

      </select>
        </div>
		
		
		<div class="col-md-6">
            <label for="Hall">Hall:</label>
          <select class="form-control main" name="Hall" id="Hall" required>
        <option value="" disabled selected>Select a Hall</option>
        <option value="Main Hall">Main Hall</option>
        <option value="Banquet Hall">Banquet Hall</option>
        <option value="Open Ground">Open Ground</option>
        <option value="Conference Room">Conference Room</option>
      </select>
        </div>
		
		
		
        <div class="col-md-6 mt-3">
            <label for="Decoration">Decoration:</label> 
      <select class="form-control main" name="Decoration" id="Decoration" required>
        <option value="" disabled selected>Select Decoration Type</option>
        <option value="Basic">Basic</option>
        <option value="Premium">Premium</option>
        <option value="Luxury">Luxury</option>
        <option value="Custom Theme">Custom Theme</option>
      </select>
        </div>
        
        <div class="col-md-12 mt-3">
            <label for="Place">Place:</label>
          <select class="form-control main" name="Place" id="Place" required>
    <option value="" disabled selected>Select Place</option>
    <option value="Bangalore">Bangalore</option>
    <option value="Mumbai">Mumbai</option>
    <option value="Chennai">Chennai</option>
    <option value="Hyderabad">Hyderabad</option>
    <option value="Delhi">Delhi</option>
    <option value="Kolkata">Kolkata</option>
    <option value="Other">Other</option>
  </select>
        </div>
		
		 <div class="col-md-6 mt-3">
            <label for="package">Event Type:</label>
      <select class="form-control main" name="package" id="package" required>
        <option value="" disabled selected>Select Event Type</option>
        <option value="Marriage">Gold</option>
        <option value="Birthday">Silver</option>
        <option value="Engagment">Platinum</option>
      </select>
        </div>
		
         <div class="col-md-6 mt-3">
            <label for="Food">Food:</label>
           <select class="form-control main" name="Food" id="Food" required>
    <option value="" disabled selected>Select Food Type</option>
    <option value="Vegetarian">Vegetarian</option>
    <option value="Non-Vegetarian">Non-Vegetarian</option>
    <option value="Both">Both</option>
    <option value="Custom Menu">Custom Menu</option>
  </select>
        </div>
		
		
		<div class="col-md-12 mt-3">
            <label for="Hall">Date:</label>
        <input type="date" name="date" > 
        </div>
		
		
		
		
		
		
        
	  <div class="col-md-12 mt-4 text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>

	  
	  
    
</p>
  </div>
</section>

<!-- Map Section -->
<section class="map">
  <div id="map"></div>
  <div class="address-block">
    <h4>Docklands Convention</h4>
    <ul class="address-list p-0 m-0">
      <li><i class="fa fa-home"></i><span>1201 Park Street, Fifth Avenue, Dhanmondy, Dhaka.</span></li>
      <li><i class="fa fa-phone"></i><span>[88] 657 524 332</span></li>
    </ul>
    <a href="#" class="btn btn-white-md">Get Direction</a>
  </div>
</section>

<!-- Footer -->
<footer class="footer-main">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="footer-logo"><img src="EventSparkImage.png" alt="logo" class="img-fluid"></div>
        <ul class="social-links-footer list-inline">
          <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-rss"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fa fa-vimeo"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<footer class="subfooter">
  <div class="container">
    <div class="row">
      <div class="col-md-6 align-self-center">
        <div class="copyright-text">
          <p><a href="#">EventSpark</a> &#169; 2017 All Right Reserved</p>
        </div>
      </div>
      <div class="col-md-6 text-right">
        <a href="#" class="to-top"><i class="fa fa-angle-up"></i></a>
      </div>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="plugins/jquery/jquery.js"></script>
<script src="plugins/popper/popper.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/smoothscroll/SmoothScroll.min.js"></script>  
<script src="plugins/isotope/mixitup.min.js"></script>  
<script src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="plugins/slick/slick.min.js"></script>  
<script src="plugins/syotimer/jquery.syotimer.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
<script src="plugins/google-map/gmap.js"></script>
<script src="js/custom.js"></script>

</body>
</html>