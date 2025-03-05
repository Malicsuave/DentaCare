<?php
session_start();
include_once('include/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/vendor/autoload.php';

// Disable error display in production
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/app_errors.log');

// Generate a CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit']))
{
    // Verify the CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $fname = htmlspecialchars(strip_tags($_POST['full_name']));
    $address = htmlspecialchars(strip_tags($_POST['address']));
    $city = htmlspecialchars(strip_tags($_POST['city']));
    $province = htmlspecialchars(strip_tags($_POST['province']));
    $gender = htmlspecialchars(strip_tags($_POST['gender']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Generate random password
    function random_password($length = 8) {
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($str), 0, $length);
    }
    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Encrypt sensitive data
    $encryption_key =  getenv('ENCRYPTION_KEY');
    $encrypted_address = openssl_encrypt($address, 'aes-256-cbc', $encryption_key, 0, 'your-iv');
    $encrypted_city = openssl_encrypt($city, 'aes-256-cbc', $encryption_key, 0, 'your-iv');
    $encrypted_province = openssl_encrypt($province, 'aes-256-cbc', $encryption_key, 0, 'your-iv');

    $query = mysqli_prepare($con, "INSERT INTO users(fullname, address, city, province, gender, email, password) VALUES(?, ?, ?, ?, ?, ?, ?)");
    if ($query) {
        mysqli_stmt_bind_param($query, 'sssssss', $fname, $encrypted_address, $encrypted_city, $encrypted_province, $gender, $email, $hashed_password);
        $result = mysqli_stmt_execute($query);
        mysqli_stmt_close($query);
    } else {
        $result = false;
    }

    if($result)
    {
        // Send email with the random password
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'reywillardd01@gmail.com'; // Your SMTP username
        $mail->Password = 'rvuf yyem neki ctql'; // Your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('reywillardd01@gmail.com', 'DentaCare');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your Registration Password';
        $mail->Body = "Hello $fname,<br><br>Your account has been successfully created.<br>Your password is: <strong>$password</strong><br>Please login and change your password after logging in.<br><br>Thank you!";
        
        if($mail->send()) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully Registered!',
                        text: 'Your password has been sent to your email.',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = 'user-login.php';
                    });
                });
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">
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

    <script type="text/javascript">
        function valid() {
            if(document.registration.password.value != document.registration.password_again.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.registration.password_again.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="login">
    <!-- start: REGISTRATION -->
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <a href="../index.php"><h2>DentaCare | Patient Registration</h2></a>
            </div>
            <!-- start: REGISTER BOX -->
            <div class="box-register">
                <form name="registration" id="registration" method="post" onSubmit="return valid();">
                    <fieldset>
                        <legend>
                            Sign Up
                        </legend>
                        <p>
                            Enter your personal details below:
                        </p>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="city" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="province" placeholder="Province" required>
                        </div>
                        <div class="form-group">
                            <label class="block">
                                Gender
                            </label>
                            <div class="clip-radio radio-primary">
                                <input type="radio" id="rg-female" name="gender" value="female">
                                <label for="rg-female">
                                    Female
                                </label>
                                <input type="radio" id="rg-male" name="gender" value="male">
                                <label for="rg-male">
                                    Male
                                </label>
                            </div>
                        </div>
                        <p>
                            Enter your account details below:
                        </p>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()" placeholder="Email" required>
                                <i class="fa fa-envelope"></i> </span>
                                <span id="user-availability-status1" style="font-size:12px;"></span>
                        </div>
                        <div class="form-group">
                            <div class="checkbox clip-check check-primary">
                                <input type="checkbox" id="agree" value="agree" checked="true" readonly="true">
                                <label for="agree">
                                    I agree
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <p>
                                Already have an account?
                                <a href="user-login.php">
                                    Log-in
                                </a>
                            </p>
                            <button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
                                Submit <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>

                <div class="copyright">
                    &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> HMS</span>. <span>All rights reserved</span>
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
        });
    </script>
    
    <script>
        function userAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</body>
<!-- end: BODY -->
</html>