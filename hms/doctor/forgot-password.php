<?php
session_start();
error_reporting(0);
include("include/config.php");

// Set security headers
header("X-Frame-Options: DENY");
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; style-src 'self' https://fonts.googleapis.com https://cdn.jsdelivr.net; font-src 'self' https://fonts.gstatic.com; img-src 'self';");

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Checking Details for reset password
if (isset($_POST['submit'])) {
    // Verify CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $_SESSION['error'] = 'Invalid CSRF token.';
        header('location:forgot-password.php');
        exit();
    }

    $contactno = htmlspecialchars(trim($_POST['contactno']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Input Validation and Data Sanitation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format.';
        header('location:forgot-password.php');
        exit();
    }

    $stmt = $con->prepare("SELECT id FROM doctors WHERE contactno=? AND docEmail=?");
    $stmt->bind_param("ss", $contactno, $email);
    $stmt->execute();
    $stmt->store_result();
    $row = $stmt->num_rows;

    if ($row > 0) {
        $_SESSION['cnumber'] = $contactno;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
    } else {
        // Store an error message in a session variable to trigger SweetAlert
        $_SESSION['error'] = 'Invalid details. Please try with a valid email or contact.';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Recovery</title>
    
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <a href="../../index.php"><h2>DentaCare | Doctor Password Recovery</h2></a>
            </div>

            <div class="box-login">
                <form class="form-login" method="post">
                    <fieldset>
                        <legend>Doctor Password Recovery</legend>
                        <p>
                            Please enter your Contact number and Email to recover your password.<br />
                        </p>

                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="contactno" placeholder="Registered Contact Number" required>
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>

                        <div class="form-group">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="Registered Email" required>
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right" name="submit">
                                Reset <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                        <div class="new-account">
                            Already have an account? 
                            <a href="index.php">Log-in</a>
                        </div>
                    </fieldset>
                </form>

                <div class="copyright">
                    &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> DentaCare</span>. <span>All rights reserved</span>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" 
        integrity="sha384-lxRRZ+Wv+MDaIZe1An1CfGKnYodPph2TCI/BCkWQKlbKQzLSF/z4zyhXGp+odxI1" 
        crossorigin="anonymous"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/login.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });

        // Show SweetAlert if there's an error message
        <?php if (isset($_SESSION['error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Info',
                text: '<?php echo $_SESSION['error']; ?>'
            }).then(() => {
                // Redirect after SweetAlert is dismissed
                window.location.href = 'forgot-password.php';
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>
</body>
</html>
