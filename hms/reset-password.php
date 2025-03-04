<?php
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict',
]);
include("include/config.php");

// Disable error display in production
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/app_errors.log');

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$alertType = ""; 

if(isset($_POST['change'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $newpassword = $_POST['password'];

    // Validate password strength
    if (strlen($newpassword) < 8 || !preg_match("/[A-Z]/", $newpassword) || !preg_match("/[0-9]/", $newpassword)) {
        $alertType = "weak_password";
    } else {
        // Fetch the current password hash
        $query = mysqli_prepare($con, "SELECT password FROM users WHERE fullName=? AND email=?");
        mysqli_stmt_bind_param($query, "ss", $name, $email);
        mysqli_stmt_execute($query);
        mysqli_stmt_bind_result($query, $currentPassword);
        mysqli_stmt_fetch($query);
        mysqli_stmt_close($query);

        // Verify if the new password is the same as the current one
        if (password_verify($newpassword, $currentPassword)) {
            $alertType = "same_password";
        } else {
            $newHashedPassword = password_hash($newpassword, PASSWORD_BCRYPT);
            $updateQuery = mysqli_prepare($con, "UPDATE users SET password=? WHERE fullName=? AND email=?");
            mysqli_stmt_bind_param($updateQuery, "sss", $newHashedPassword, $name, $email);
            $queryResult = mysqli_stmt_execute($updateQuery);
            mysqli_stmt_close($updateQuery);

            if ($queryResult) {
                $alertType = "success";
            } else {
                $alertType = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Reset</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="login">
    <div class="row">
        <div class="main-login col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <a href="../index.php"><h2> DentaCare | Patient Reset Password</h2></a>
            </div>
            <div class="box-login">
                <form class="form-login" name="passwordreset" method="post" onSubmit="return valid();">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <fieldset>
                        <legend>Patient Reset Password</legend>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Confirm Password" required>
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary pull-right" name="change">
                                Change <i class="fa fa-arrow-circle-right"></i>
                            </button>
                            <a href="user-login.php" class="btn btn-secondary pull-left">
                                Back to Sign In
                            </a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script>
        function valid() {
            if (document.passwordreset.password.value !== document.passwordreset.password_again.value) {
                Swal.fire('Error', 'Passwords do not match!', 'error');
                return false;
            }
            return true;
        }

        <?php if ($alertType == "success") { ?>
            Swal.fire({ icon: 'success', title: 'Password updated successfully!', confirmButtonText: 'OK' })
                .then(() => window.location.href = 'user-login.php');
        <?php } elseif ($alertType == "error") { ?>
            Swal.fire({ icon: 'error', title: 'Password update failed. Please try again.', confirmButtonText: 'OK' });
        <?php } elseif ($alertType == "same_password") { ?>
            Swal.fire({ icon: 'warning', title: 'You entered your current password!', text: 'Please enter a new password.', confirmButtonText: 'OK' });
        <?php } elseif ($alertType == "weak_password") { ?>
            Swal.fire({ icon: 'warning', title: 'Weak Password!', text: 'Use at least 8 characters, including an uppercase letter and a number.', confirmButtonText: 'OK' });
        <?php } ?>
    </script>
</body>
</html>