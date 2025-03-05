

<?php

header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer-when-downgrade");
header("Content-Security-Policy: default-src 'self'; script-src 'self';");

session_start();
error_reporting(0);
include("include/config.php");

// Generate a nonce
if (empty($_SESSION['nonce'])) {
    $_SESSION['nonce'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['nonce'], $_POST['nonce'])) {
        die('Invalid nonce');
    }

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password']; // Don't escape password, it may be hashed

    // Fetch user info
    $stmt = mysqli_prepare($con, "SELECT id, password FROM admin WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id, $db_password);
        mysqli_stmt_fetch($stmt);

        if ($db_password === $password || password_verify($password, $db_password)) {
            // If password is plain text, hash it and update the database
            if ($db_password === $password) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateStmt = mysqli_prepare($con, "UPDATE admin SET password=? WHERE id=?");
                mysqli_stmt_bind_param($updateStmt, "si", $hashedPassword, $id);
                mysqli_stmt_execute($updateStmt);
                mysqli_stmt_close($updateStmt);
            }

            $_SESSION['login'] = $username;
            $_SESSION['id'] = $id;
            $_SESSION['role'] = 'admin';

            header("Location: dashboard.php");
            exit();
        }
    }

    $_SESSION['errmsg'] = "Invalid username or password";
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin-Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
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
</head>
<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <h2>Admin Login</h2>
            </div>

            <div class="box-login">
                <form class="form-login" method="post">
                    <fieldset>
                        <legend>
                            Sign in to your account
                        </legend>
                        <p>
                            Please enter your name and password to log in.<br />
                            <span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
                        </p>
                        <input type="hidden" name="nonce" value="<?php echo $_SESSION['nonce']; ?>">
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                                <i class="fa fa-user"></i> 
                            </span>
                        </div>
                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="password" class="form-control password" name="password" placeholder="Password" required>
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right" name="submit">
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
        });
    </script>
</body>
</html>