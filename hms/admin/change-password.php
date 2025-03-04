<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');

check_login();

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

date_default_timezone_set('Asia/Kolkata'); // change according timezone
$currentTime = date('d-m-Y h:i:s A', time());
$message = ""; // Variable to hold the alert message

// Input validation and data sanitation
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST['submit'])) {
    $cpass = sanitize_input($_POST['cpass']);
    $npass = sanitize_input($_POST['npass']);
    $cfpass = sanitize_input($_POST['cfpass']);

    // Fetch current password from the database
    $sql = mysqli_query($con, "SELECT password FROM admin WHERE username='" . $_SESSION['login'] . "'");
    $num = mysqli_fetch_array($sql);
    $db_password = $num['password']; // This could be plain text or hashed

    // Check if the stored password is plain text
    if (password_needs_rehash($db_password, PASSWORD_DEFAULT)) {
        // If the database password is plain text, compare directly
        if ($cpass === $db_password) {
            // Hash the new password before storing it
            $hashed_npass = password_hash($npass, PASSWORD_DEFAULT);
            mysqli_query($con, "UPDATE admin SET password='$hashed_npass', updationDate='$currentTime' WHERE username='" . $_SESSION['login'] . "'");

            $message = "success";
            $_SESSION['msg1'] = "Password updated successfully!";
        } else {
            $message = "error";
            $_SESSION['msg1'] = "Current password is incorrect.";
        }
    } else {
        // The password is already hashed, so verify it properly
        if (password_verify($cpass, $db_password)) {
            // Hash the new password before storing it
            $hashed_npass = password_hash($npass, PASSWORD_DEFAULT);
            mysqli_query($con, "UPDATE admin SET password='$hashed_npass', updationDate='$currentTime' WHERE username='" . $_SESSION['login'] . "'");

            $message = "success";
            $_SESSION['msg1'] = "Password updated successfully!";
        } else {
            $message = "error";
            $_SESSION['msg1'] = "Current password is incorrect.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Change Password</title>
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
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.cpass.value == "") {
                alert("Current Password Field is Empty !!");
                document.chngpwd.cpass.focus();
                return false;
            } else if (document.chngpwd.npass.value == "") {
                alert("New Password Field is Empty !!");
                document.chngpwd.npass.focus();
                return false;
            } else if (document.chngpwd.cfpass.value == "") {
                alert("Confirm Password Field is Empty !!");
                document.chngpwd.cfpass.focus();
                return false;
            } else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
                alert("Password and Confirm Password Field do not match !!");
                document.chngpwd.cfpass.focus();
                return false;
            }
            return true;
        }
    </script>

</head>
<body>
<div id="app"><?php include('include/footer.php');?>
    <?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Admin | Change Password</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>Admin</span>
                            </li>
                            <li class="active">
                                <span>Change Password</span>
                            </li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row margin-top-30">
                                <div class="col-lg-8 col-md-12">
                                    <div class="panel panel-white">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">Change Password</h5>
                                        </div>
                                        <div class="panel-body">
                                           
                                            <form role="form" name="chngpwd" method="post" onSubmit="return valid();">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">
                                                        Current Password
                                                    </label>
                                                    <input type="password" name="cpass" class="form-control" placeholder="Enter Current Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">
                                                        New Password
                                                    </label>
                                                    <input type="password" name="npass" class="form-control" placeholder="New Password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">
                                                        Confirm Password
                                                    </label>
                                                    <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password">
                                                </div>

                                                <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include('include/setting.php'); ?>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/modernizr/modernizr.js"></script>
        <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="vendor/switchery/switchery.min.js"></script>
        <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="vendor/autosize/autosize.min.js"></script>
        <script src="vendor/selectFx/classie.js"></script>
        <script src="vendor/selectFx/selectFx.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/form-elements.js"></script>
        <script>
            jQuery(document).ready(function () {
                Main.init();
                FormElements.init();
            });

            <?php if ($message == "success"): ?>
            Swal.fire({
                title: 'Success!',
                text: "<?php echo htmlentities($_SESSION['msg1']); ?>",
                icon: 'success'
            });
            <?php elseif ($message == "error"): ?>
            Swal.fire({
                title: 'Error!',
                text: "<?php echo htmlentities($_SESSION['msg1']); ?>",
                icon: 'error'
            });
            <?php endif; ?>
        </script>
    </div>
</body>
</html>