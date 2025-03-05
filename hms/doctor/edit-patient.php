<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

if (isset($_POST['submit'])) {
    $eid = intval($_GET['editid']);
    $patname = htmlspecialchars(trim($_POST['patname']));
    $patcontact = htmlspecialchars(trim($_POST['patcontact']));
    $patemail = htmlspecialchars(trim($_POST['patemail']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $pataddress = htmlspecialchars(trim($_POST['pataddress']));
    $patage = htmlspecialchars(trim($_POST['patage']));
    $medhis = htmlspecialchars(trim($_POST['medhis']));

    // Input Validation and Data Sanitation
    if (!filter_var($patemail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = "Invalid email format. Please enter a valid email address.";
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid email format. Please enter a valid email address.',
                    confirmButtonText: 'OK'
                });
            }
        </script>";
        exit();
    }

    // Secure Data Storage & Encryption
    $stmt = $con->prepare("UPDATE tblpatient SET PatientName=?, PatientContno=?, PatientEmail=?, PatientGender=?, PatientAdd=?, PatientAge=?, PatientMedhis=? WHERE ID=?");
    $stmt->bind_param("sssssssi", $patname, $patcontact, $patemail, $gender, $pataddress, $patage, $medhis, $eid);

    if ($stmt->execute()) {
        $_SESSION['msg'] = 'Patient info updated Successfully';
        $success = true; // Set a flag indicating success
    } else {
        // Error Handling & Logging
        error_log("Error in updating patient info: " . $stmt->error);
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor | Edit Patient</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> <!-- SweetAlert2 CSS -->
</head>
<body>
    <div id="app">		
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Patient | Edit Patient</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Patient</span></li>
                                <li class="active"><span>Edit Patient</span></li>
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
                                                <h5 class="panel-title">Edit Patient</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="" method="post">
                                                    <?php
                                                    $eid = intval($_GET['editid']);
                                                    $ret = mysqli_query($con, "SELECT * FROM tblpatient WHERE ID='$eid'");
                                                    while ($row = mysqli_fetch_array($ret)) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="doctorname">Patient Name</label>
                                                        <input type="text" name="patname" class="form-control" value="<?php echo htmlspecialchars($row['PatientName']); ?>" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess"> Patient Contact no</label>
                                                        <input type="text" name="patcontact" class="form-control" value="<?php echo htmlspecialchars($row['PatientContno']); ?>" required="true" maxlength="10" pattern="[0-9]+">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Patient Email</label>
                                                        <input type="email" id="patemail" name="patemail" class="form-control" value="<?php echo htmlspecialchars($row['PatientEmail']); ?>" readonly='true'>
                                                        <span id="email-availability-status"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Gender: </label>
                                                        <?php if ($row['PatientGender'] == "Female") { ?>
                                                            <input type="radio" name="gender" id="gender" value="Female" checked="true">Female
                                                            <input type="radio" name="gender" id="gender" value="Male">Male
                                                        <?php } else { ?>
                                                            <input type="radio" name="gender" id="gender" value="Male" checked="true">Male
                                                            <input type="radio" name="gender" id="gender" value="Female">Female
                                                        <?php } ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Patient Address</label>
                                                        <textarea name="pataddress" class="form-control" required="true"><?php echo htmlspecialchars($row['PatientAdd']); ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess"> Patient Age</label>
                                                        <input type="text" name="patage" class="form-control" value="<?php echo htmlspecialchars($row['PatientAge']); ?>" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess"> Medical History</label>
                                                        <textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)" required="true"><?php echo htmlspecialchars($row['PatientMedhis']); ?></textarea>
                                                    </div>	
                                                    <div class="form-group">
                                                        <label for="fess"> Creation Date</label>
                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['CreationDate']); ?>" readonly='true'>
                                                    </div>
                                                    <?php } ?>
                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>				
                    </div>
                </div>
            </div>
        </div>				
    </div>
    <!-- start: FOOTER -->
    <?php include('include/footer.php');?>
    <!-- end: FOOTER -->
    <!-- start: SETTINGS -->
    <?php include('include/setting.php');?>
    <!-- end: SETTINGS -->
    <!-- start: MAIN JAVASCRIPTS -->
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
    <script src="assets/js/form-elements.js"></script>
    <script>
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
        // Initialize SweetAlert2
        <?php if (isset($success) && $success): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'manage-patient.php'; // Redirect to manage-patient.php after alert is confirmed
                }
            });
        <?php endif; ?>
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 JS -->
</body>
</html>
