<?php
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict',
]);

include('include/config.php');
include('include/checklogin.php');
check_login();




if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    $_SESSION['msg'] = 'Unauthorized access attempt logged';
    $_SESSION['msg_type'] = 'error';
    error_log('Unauthorized access attempt from IP: ' . $_SERVER['REMOTE_ADDR']);
    header("Location: error.php");
    exit();
}

session_regenerate_id(true);

date_default_timezone_set('Asia/Kolkata');
$currentTime = date('d-m-Y h:i:s A', time());

if (isset($_POST['submit'])) {
    $sql = mysqli_prepare($con, "SELECT password FROM users WHERE id=?");
    mysqli_stmt_bind_param($sql, 'i', $_SESSION['id']);
    mysqli_stmt_execute($sql);
    mysqli_stmt_bind_result($sql, $hashedPassword);
    mysqli_stmt_fetch($sql);
    mysqli_stmt_close($sql);

    // Debugging: Check if the hashed password is retrieved correctly
    error_log("Hashed Password from DB: " . $hashedPassword);
    error_log("Entered Current Password: " . $_POST['cpass']);

    if (password_verify($_POST['cpass'], $hashedPassword)) {
        $newPasswordHash = password_hash($_POST['npass'], PASSWORD_BCRYPT);
        $updateSql = mysqli_prepare($con, "UPDATE users SET password=?, updationDate=? WHERE id=?");
        mysqli_stmt_bind_param($updateSql, 'ssi', $newPasswordHash, $currentTime, $_SESSION['id']);
        mysqli_stmt_execute($updateSql);
        mysqli_stmt_close($updateSql);
        $_SESSION['msg1'] = "Password Changed Successfully !!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg1'] = "Old Password does not match !!";
        $_SESSION['msg_type'] = "error";
    }
    header("Location: change-password.php"); // Refresh the page to display alert
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Change Password</title>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <h1 class="mainTitle">User | Change Password</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>User</span>
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
                                                        <label for="exampleInputEmail1">Current Password</label>
                                                        <input type="password" name="cpass" class="form-control" placeholder="Enter Current Password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">New Password</label>
                                                        <input type="password" name="npass" class="form-control" placeholder="New Password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Confirm Password</label>
                                                        <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password" required>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('include/setting.php'); ?>
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

            <?php if (isset($_SESSION['msg1']) && $_SESSION['msg1'] != ""): ?>
                Swal.fire({
                    title: '<?php echo $_SESSION['msg_type'] == "success" ? "Success!" : "Error!"; ?>',
                    text: "<?php echo $_SESSION['msg1']; ?>",
                    icon: '<?php echo $_SESSION['msg_type']; ?>'
                }).then(() => {
                    <?php
                    // Reset session message after displaying it
                    unset($_SESSION['msg1']);
                    unset($_SESSION['msg_type']);
                    ?>
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>