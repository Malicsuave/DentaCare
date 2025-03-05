<?php
session_start();
include("include/config.php");
error_reporting(0);

// Set maximum login attempts and lockout duration
$max_attempts = 3;
$lockout_duration = 10; // 10 seconds for lockout duration

// Check for existing lockout
$lockout_active = false;
$remaining_lockout_time = 0; // Remaining time for lockout (for JavaScript)

if (isset($_SESSION['login_attempts']) && isset($_SESSION['lockout_time'])) {
    if ($_SESSION['login_attempts'] >= $max_attempts && time() < $_SESSION['lockout_time']) {
        $lockout_active = true;
        $remaining_lockout_time = $_SESSION['lockout_time'] - time(); // Calculate remaining lockout time
    } elseif (time() > $_SESSION['lockout_time']) {
        // Reset attempts after lockout duration
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['lockout_time']);
    }
}

$alert_message = ""; // Message for SweetAlert on general attempts
$lockout_message = ""; // Message for SweetAlert on lockout

if (isset($_POST['submit'])) {
    if ($lockout_active) {
        $lockout_message = "Too many login attempts. Please wait for a minute";
    } else {
        // Check doctor credentials
        $ret = mysqli_query($con, "SELECT * FROM doctors WHERE docEmail='" . $_POST['username'] . "' and password='" . md5($_POST['password']) . "'");
        $num = mysqli_fetch_array($ret);

        if ($num > 0) { // Successful login
            $_SESSION['dlogin'] = $_POST['username'];
            $_SESSION['id'] = $num['id'];
            $_SESSION['role'] = 'doctor';
            $_SESSION['login_attempts'] = 0; // Reset login attempts
            $extra = "dashboard.php";
            $host = $_SERVER['HTTP_HOST'];
            $uip = $_SERVER['REMOTE_ADDR'];
            $status = 1;

            // Log successful login
            mysqli_query($con, "INSERT INTO doctorslog(uid, username, userip, status) VALUES('" . $_SESSION['id'] . "', '" . $_SESSION['dlogin'] . "', '$uip', '$status')");
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("location:https://$host$uri/$extra");
            exit();
        } else { // Unsuccessful login
            $_SESSION['dlogin'] = $_POST['username'];
            $uip = $_SERVER['REMOTE_ADDR'];
            $status = 0;

            // Log unsuccessful login attempt
            mysqli_query($con, "INSERT INTO doctorslog(username, userip, status) VALUES('" . $_SESSION['dlogin'] . "', '$uip', '$status')");
            $alert_message = "Invalid username or password.";

            // Increment login attempts
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 1;
            } else {
                $_SESSION['login_attempts']++;
            }

            // Lock out user if max attempts reached
            if ($_SESSION['login_attempts'] >= $max_attempts) {
                $_SESSION['lockout_time'] = time() + $lockout_duration;
                $lockout_message = "Too many login attempts. Please wait for 10 seconds.";
                $lockout_active = true;
                $remaining_lockout_time = $lockout_duration; // Set initial lockout time for client-side timer
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Login</title>
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
                <a href="../../index.php"><h2> DentaCare | Doctor Login</h2></a>
            </div>

            <div class="box-login">
                <form class="form-login" method="post" id="loginForm">
                    <fieldset>
                        <legend>
                            Sign in to your account
                        </legend>
                        <p>
                            Please enter your name and password to log in.
                        </p>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="username" placeholder="Email" <?php echo ($lockout_active ? 'disabled' : ''); ?>>
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="password" class="form-control password" name="password" id="password" placeholder="Password" <?php echo ($lockout_active ? 'disabled' : ''); ?>>
                                <i class="fa fa-lock"></i>
                            </span>
                            <div class="form-group">
                                <input type="checkbox" onclick="togglePassword()"> Show Password
                            </div>
                            <a href="forgot-password.php">Forgot Password ?</a>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right" name="submit" <?php echo ($lockout_active ? 'disabled' : ''); ?>>
                                Login <i class="fa fa-arrow-circle-right"></i>
                            </button>
                            <a href="../../index.php" class="btn btn-secondary pull-left">
                                Back <i class="fa fa-arrow-circle-left"></i>
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

            // SweetAlert for general attempts
            <?php if (!empty($alert_message)) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Attempt',
                    text: '<?php echo $alert_message; ?>',
                });
            <?php } ?>

            // SweetAlert for lockout
            <?php if (!empty($lockout_message)) { ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Locked Out',
                    text: '<?php echo $lockout_message; ?>',
                });

                // Disable the form and start a countdown
                var lockoutTime = <?php echo $remaining_lockout_time; ?>;
                var countdownInterval = setInterval(function() {
                    if (lockoutTime > 0) {
                        lockoutTime--;
                    } else {
                        clearInterval(countdownInterval);
                        location.reload(); // Refresh the page after lockout
                    }
                }, 1000);
            <?php } ?>

            // Toggle password visibility
            function togglePassword() {
                var passwordField = document.getElementById("password");
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                } else {
                    passwordField.type = "password";
                }
            }
        });
    </script>
</body>
</html>