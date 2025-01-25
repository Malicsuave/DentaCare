<?php
session_start();
error_reporting(0);
include("include/config.php");

// Set the maximum login attempts and lockout duration
$max_attempts = 3;
$lockout_duration = 10; // Time in seconds for lockout

// Check if the user has a previous attempt record
$lockout_active = false; // Flag to track if the user is locked out
$lockout_message = ""; // Separate message for lockout SweetAlert

if (isset($_SESSION['login_attempts']) && isset($_SESSION['lockout_time'])) {
    if ($_SESSION['login_attempts'] >= $max_attempts && time() < $_SESSION['lockout_time']) {
        $lockout_message = "Too many login attempts. Please wait for a minute.";
        $lockout_active = true; // Set lockout flag
    } elseif (time() > $_SESSION['lockout_time']) {
        // Reset attempts after lockout duration
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['lockout_time']);
    }
}

$alert_message = ""; // To store alert message for SweetAlert

if (isset($_POST['submit'])) {
    // Check if the user is locked out
    if ($lockout_active) {
        // Set message for SweetAlert if locked out
        $alert_message = "Too many login attempts. Please wait for a minute.";
    } else {
        // Fetch user data
        $ret = mysqli_query($con, "SELECT * FROM users WHERE email='" . $_POST['username'] . "' and password='" . md5($_POST['password']) . "'");
        $num = mysqli_fetch_array($ret);

        if ($num) {
            // Successful login: reset attempts
            $_SESSION['login'] = $_POST['username'];
            $_SESSION['id'] = $num['id'];
            $_SESSION['role'] = 'user';
            $_SESSION['login_attempts'] = 0; // Reset login attempts
            $extra = "dashboard.php";
            $host = $_SERVER['HTTP_HOST'];
            $uip = $_SERVER['REMOTE_ADDR'];
            $status = 1;

            // Log successful login
            mysqli_query($con, "INSERT INTO userlog(uid, username, userip, status) VALUES('" . $_SESSION['id'] . "', '" . $_SESSION['login'] . "', '$uip', '$status')");
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/$extra");
            exit();
        } else {
            // Unsuccessful login
            $_SESSION['login'] = $_POST['username'];
            $uip = $_SERVER['REMOTE_ADDR'];
            $status = 0;
            mysqli_query($con, "INSERT INTO userlog(username, userip, status) VALUES('" . $_SESSION['login'] . "', '$uip', '$status')");
            $alert_message = "Invalid username or password"; // Set message for SweetAlert

            // Increment login attempts
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 1;
            } else {
                $_SESSION['login_attempts']++;
            }

            // Lock the user out if max attempts reached
            if ($_SESSION['login_attempts'] >= $max_attempts) {
                $_SESSION['lockout_time'] = time() + $lockout_duration;
                $lockout_message = "Too many login attempts. Please wait for a minute.";
                $lockout_active = true;
            }
        }
    }
}
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <title>User-Login</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert -->
</head>
<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <a href="../index.php"><h2> DentaCare | Patient Login</h2></a>
            </div>

            <div class="box-login">
                <form class="form-login" method="post">
                    <fieldset>
                        <legend>
                            Sign in to your account
                        </legend>
                        <p>
                            Please enter your name and password to log in.
                        </p>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username" <?php echo ($lockout_active ? 'disabled' : ''); ?>>
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="password" class="form-control password" id="password" name="password" placeholder="Password" <?php echo ($lockout_active ? 'disabled' : ''); ?>>
                                <i class="fa fa-lock"></i>
                            </span>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="togglePassword" <?php echo ($lockout_active ? 'disabled' : ''); ?>> Show Password
                                </label>
                            </div>
                            <a href="forgot-password.php">Forgot Password ?</a>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right" name="submit" <?php echo ($lockout_active ? 'disabled' : ''); ?>>
                                Login <i class="fa fa-arrow-circle-right"></i>
                            </button>
                            <a href="../index.php" class="btn btn-secondary pull-left">
                                Back <i class="fa fa-arrow-circle-left"></i>
                            </a>
                        </div>
                        
                        <div class="new-account">
                            Don't have an account yet?
                            <a href="registration.php">
                                Create an account
                            </a>
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
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/login.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();

            // Show SweetAlert if there's a general alert message
            <?php if (!empty($alert_message)) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Attempt',
                    text: '<?php echo $alert_message; ?>',
                });
            <?php } ?>

            // Show SweetAlert if user is locked out
            <?php if (!empty($lockout_message)) { ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Locked Out',
                    text: '<?php echo $lockout_message; ?>',
                });
            <?php } ?>

            // Toggle password visibility
            $('#togglePassword').change(function() {
                var passwordField = $('#password');
                if ($(this).is(':checked')) {
                    passwordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                }
            });
        });
    </script>
</body>
</html>
