<?php
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

date_default_timezone_set('Asia/Kolkata'); // change according to timezone
$currentTime = date('d-m-Y h:i:s A', time());

if (isset($_POST['submit'])) {
    $sql = mysqli_query($con, "SELECT password FROM doctors WHERE password='" . md5($_POST['cpass']) . "' AND id='" . $_SESSION['id'] . "'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
        mysqli_query($con, "UPDATE doctors SET password='" . md5($_POST['npass']) . "', updationDate='$currentTime' WHERE id='" . $_SESSION['id'] . "'");
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
    <!-- Include your CSS and other resources here -->
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
                                    <p style="color:red;"><?php echo htmlentities($_SESSION['msg1']); $_SESSION['msg1'] = ""; ?></p>
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
<script src="assets/js/main.js"></script>
<script src="assets/js/form-elements.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
    });
</script>
</body>
</html>
