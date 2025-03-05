<?php
session_start();
include_once('../hms/include/config.php');

$successMessage = false; // Initialize a flag for success

// Generate a CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $name = $_POST['fullname'];
        $email = $_POST['emailid'];
        $mobileno = $_POST['mobileno'];
        $dscrption = $_POST['description'];

        $query = mysqli_query($con, "INSERT INTO tblcontactus(fullname,email,contactno,message) VALUE('$name','$email','$mobileno','$dscrption')");

        if ($query) {
            $successMessage = true; // Set flag to true if submission is successful
        }
    } else {
        // Invalid CSRF token
        die('Invalid CSRF token');
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contact-DentaCare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
  <style>
        /* Navbar background and text */
        #ftco-navbar {
            background-color: #343a40; /* Dark background color for navbar */
        }

        /* Dropdown menu style */
        #ftco-navbar .dropdown-menu {
            background-color: #343a40; /* Dark background for dropdown */
            border-radius: 8px;         /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            padding: 10px 0;            /* Padding */
        }

        /* Dropdown items style */
        #ftco-navbar .dropdown-item {
            color: #f8f9fa;                 /* Light color for text */
            padding: 10px 20px;             /* Spacing around items */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth hover transition */
            font-weight: 500;               /* Slightly bold font */
        }

        /* Hover effect for dropdown items */
        #ftco-navbar .dropdown-item:hover {
            background-color: #17a2b8;      /* Teal color on hover */
            color: #fff;                    /* White text on hover */
            border-radius: 4px;             /* Slight rounding on hover */
        }

        /* Active state for Login/Register link */
        #ftco-navbar .nav-link.dropdown-toggle:active {
            color: #17a2b8;                 /* Teal color on click */
        }

        /* Navbar links style */
        #ftco-navbar .nav-link {
            color: #f8f9fa;                 /* Light color for regular navbar links */
            transition: color 0.3s ease;    /* Smooth color transition */
        }

        /* Hover effect for navbar links */
        #ftco-navbar .nav-link:hover {
            color: #17a2b8;                 /* Teal color on hover */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Denta<span>Care</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
                    <li class="nav-item active"><a href="contact.php" class="nav-link">Contact</a></li>
                    
                    <!-- Dropdown for Login/Register -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login/Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../hms/user-login.php">Login as User</a>
                            <a class="dropdown-item" href="../hms/doctor/index.php">Login as Doctor</a>
                            <a class="dropdown-item" href="../hms/admin/index.php">Login as Admin</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
    <!-- END nav -->

    <section class="home-slider owl-carousel">
      <div class="slider-item bread-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container" data-scrollax-parent="true">
          <div class="row slider-text align-items-end">
            <div class="col-md-7 col-sm-12 ftco-animate mb-5">
              <p class="breadcrumbs" data-scrollax=" properties: { translateY: '70%', opacity: 1.6}"><span class="mr-2"><a href="index.php">Home</a></span> <span>Blog</span></p>
              <h1 class="mb-3" data-scrollax=" properties: { translateY: '70%', opacity: .9}">Contact Us</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section contact-section ftco-degree-bg">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-6 pr-md-5">
                   <form method="POST" action="contact.php">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <div class="form-group">
        <input type="text" class="form-control" name="fullname" required placeholder="Your Name">
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="emailid" required placeholder="Your Email">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="mobileno" required="true" maxlength="11" placeholder="Mobile Number" oninput="limitInput(this)">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="description" required placeholder="Message" cols="30" rows="7"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary py-3 px-5">Send Message</button>
    </div>
</form>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Dentacare is a trusted dental clinic committed to quality oral health care. With a team of skilled professionals, we offer a full range of dental services in a friendly and comfortable setting, ensuring every visit supports your healthiest, brightest smile.</p>
            </div>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft ">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Quick Links</h2>
              <ul class="list-unstyled">
                <li><a href="about" class="py-2 d-block">About</a></li>
                <li><a href="services" class="py-2 d-block">Services</a></li>
                <li><a href="contact" class="py-2 d-block">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 pr-md-4">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Related Blogs</h2>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="https://www.dentalhealth.org/blog/vegan-food-and-oral-health">Nourishing Smiles: The Intersection of Vegan Food and Oral Health</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Nov 4, 2024</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 3</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Nov 4, 2024</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Office</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">LTC Tambo,Lipa City, Batangas, Philippines</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">(043) 756-1493</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">dentacare@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> DentaCare. All rights reserved.
  </p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <!-- Modal -->
  <div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRequestLabel">Make an Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#">
            <div class="form-group">
              <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
              <input type="text" class="form-control" id="appointment_name" placeholder="Full Name">
            </div>
            <div class="form-group">
              <!-- <label for="appointment_email" class="text-black">Email</label> -->
              <input type="text" class="form-control" id="appointment_email" placeholder="Email">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <!-- <label for="appointment_date" class="text-black">Date</label> -->
                  <input type="text" class="form-control appointment_date" placeholder="Date">
                </div>    
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <!-- <label for="appointment_time" class="text-black">Time</label> -->
                  <input type="text" class="form-control appointment_time" placeholder="Time">
                </div>
              </div>
            </div>
            

            <div class="form-group">
              <!-- <label for="appointment_message" class="text-black">Message</label> -->
              <textarea name="" id="appointment_message" class="form-control" cols="30" rows="10" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Make an Appointment" class="btn btn-primary">
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  <script>
function limitInput(input) {
    // Remove any non-numeric characters
    input.value = input.value.replace(/\D/g, '');
    // Ensure the length does not exceed 11
    if (input.value.length > 11) {
        input.value = input.value.slice(0, 11);
    }
}
</script>
<?php if ($successMessage): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted!',
                    text: 'Your information was successfully submitted!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'contact.php';
                    }
                });
            });
        </script>
    <?php endif; ?>
    
  </body>
</html>