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
    $docid = $_SESSION['id'];
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
    $stmt = $con->prepare("INSERT INTO tblpatient (Docid, PatientName, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssis", $docid, $patname, $patcontact, $patemail, $gender, $pataddress, $patage, $medhis);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Patient info added successfully!";
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Patient info added successfully!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'add-patient.php';
                    }
                });
            }
        </script>";
    } else {
        // Error Handling & Logging
        error_log("Error in adding patient info: " . $stmt->error);
        $_SESSION['msg'] = "Error in adding patient info. Please try again.";
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error in adding patient info. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        </script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor | Add Patient</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="app">  <?php include('include/footer.php');?>    
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Patient | Add Patient</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Patient</span>
                                </li>
                                <li class="active">
                                    <span>Add Patient</span>
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
                                                <h5 class="panel-title">Add Patient</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="" method="post">
                                                    <div class="form-group">
                                                        <label for="doctorname">Patient Name</label>
                                                        <input type="text" name="patname" class="form-control" placeholder="Enter Patient Name" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Patient Contact no</label>
                                                        <input type="text" name="patcontact" class="form-control" placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Patient Email</label>
                                                        <input type="email" id="patemail" name="patemail" class="form-control" placeholder="Enter Patient Email id" required="true">
                                                        <span id="user-availability-status1" style="font-size:12px;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="block">Gender</label>
                                                        <div class="clip-radio radio-primary">
                                                            <input type="radio" id="rg-female" name="gender" value="female">
                                                            <label for="rg-female">Female</label>
                                                            <input type="radio" id="rg-male" name="gender" value="male">
                                                            <label for="rg-male">Male</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Patient Address</label>
                                                        <textarea name="pataddress" class="form-control" placeholder="Enter Patient Address" required="true"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Patient Age</label>
                                                        <input type="text" name="patage" class="form-control" placeholder="Enter Patient Age" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Medical History</label>
                                                        <textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)" required="true"></textarea>
                                                    </div>    
                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Add</button>
                                                </form>
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
                </div>
            </div>
        </div>
        
        <?php include('include/setting.php');?>
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
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
    <script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
    <!-- end: MAIN JAVASCRIPTS -->
</body>
</html>
