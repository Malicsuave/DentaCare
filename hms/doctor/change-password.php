<?php
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

date_default_timezone_set('Asia/Kolkata'); // change according to timezone
$currentTime = date('d-m-Y h:i:s A', time());

if (isset($_POST['submit'])) {
    $cpass = htmlspecialchars(trim($_POST['cpass']));
    $npass = htmlspecialchars(trim($_POST['npass']));
    $cfpass = htmlspecialchars(trim($_POST['cfpass']));

    // Input Validation and Data Sanitation
    if (empty($cpass) || empty($npass) || empty($cfpass)) {
        $_SESSION['msg1'] = "All fields are required!";
        header("Location: change-password.php?status=error"); // Redirect with error status
        exit();
    }

    if ($npass !== $cfpass) {
        $_SESSION['msg1'] = "New Password and Confirm Password do not match!";
        header("Location: change-password.php?status=error"); // Redirect with error status
        exit();
    }

    $sql = mysqli_query($con, "SELECT password FROM doctors WHERE password='" . md5($cpass) . "' AND id='" . $_SESSION['id'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
        mysqli_query($con, "UPDATE doctors SET password='" . md5($npass) . "', updationDate='$currentTime' WHERE id='" . $_SESSION['id'] . "'");
        $_SESSION['msg1'] = "Password Changed Successfully !!";
        header("Location: change-password.php?status=success"); // Redirect with success status
        exit();
    } else {
        $_SESSION['msg1'] = "Old Password does not match !!";
        header("Location: change-password.php?status=error"); // Redirect with error status
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor | Change Password</title>
    
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
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->

    <script type="text/javascript">
    function valid() {
        if (document.chngpwd.cpass.value == "") {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Current Password Field is Empty!' });
            document.chngpwd.cpass.focus();
            return false;
        } else if (document.chngpwd.npass.value == "") {
            Swal.fire({ icon: 'error', title: 'Error', text: 'New Password Field is Empty!' });
            document.chngpwd.npass.focus();
            return false;
        } else if (document.chngpwd.cfpass.value == "") {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Confirm Password Field is Empty!' });
            document.chngpwd.cfpass.focus();
            return false;
        } else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Password and Confirm Password Field do not match!' });
            document.chngpwd.cfpass.focus();
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
<div id="app">
    <?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Doctor | Change Password</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Doctor</span></li>
                            <li class="active"><span>Change Password</span></li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Change Password</h5>
                                </div>
                                <div class="panel-body">
                                    
                                    <form role="form" name="chngpwd" method="post" onSubmit="return valid();">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input type="password" name="cpass" class="form-control" placeholder="Enter Current Password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="npass" class="form-control" placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const urlParams = new URLSearchParams(window.location.search);
                        const status = urlParams.get('status');
                        if (status === 'success') {
                            Swal.fire({ icon: 'success', title: 'Success', text: 'Password Changed Successfully!', confirmButtonText: 'OK' });
                        } else if (status === 'error') {
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Old Password does not match!', confirmButtonText: 'OK' });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
    <?php include('include/setting.php'); ?>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Password Changed Successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                // Remove the status parameter from the URL
                window.history.replaceState(null, null, window.location.pathname);
            });
        } else if (status === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Old Password does not match!',
                confirmButtonText: 'OK'
            }).then(() => {
                // Remove the status parameter from the URL
                window.history.replaceState(null, null, window.location.pathname);
            });
        }
    });
</script>
</body>
</html>
