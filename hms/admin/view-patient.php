<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Input Validation and Data Sanitation
if (isset($_POST['submit'])) {
    $vid = intval($_GET['viewid']); // Sanitize input
    $bp = htmlspecialchars($_POST['bp']);
    $bs = htmlspecialchars($_POST['bs']);
    $weight = htmlspecialchars($_POST['weight']);
    $temp = htmlspecialchars($_POST['temp']);
    $pres = htmlspecialchars($_POST['pres']);
    $chronic = htmlspecialchars($_POST['chronic']);
    $prev = htmlspecialchars($_POST['previous']);

    $stmt = $con->prepare("INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres, ChroniCond, PrevDen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $vid, $bp, $bs, $weight, $temp, $pres, $chronic, $prev);
    if ($stmt->execute()) {
        echo '<script>alert("Medical history has been added.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor | Manage Patients</title>
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
</head>
<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Doctor | Manage Patients</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Doctor</span>
                                </li>
                                <li class="active">
                                    <span>Manage Patients</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Patients</span></h5>
                                <?php
                                $vid = intval($_GET['viewid']);
                                $ret = $con->prepare("SELECT * FROM tblpatient WHERE ID = ?");
                                $ret->bind_param("i", $vid);
                                $ret->execute();
                                $result = $ret->get_result();
                                $cnt = 1;
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                <table border="1" class="table table-bordered">
                                    <tr align="center">
                                        <td colspan="4" style="font-size:20px;color:blue">Patient Details</td>
                                    </tr>
                                    <tr>
                                        <th scope>Patient Name</th>
                                        <td><?php echo htmlspecialchars($row['PatientName']); ?></td>
                                        <th scope>Patient Email</th>
                                        <td><?php echo htmlspecialchars($row['PatientEmail']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope>Patient Mobile Number</th>
                                        <td><?php echo htmlspecialchars($row['PatientContno']); ?></td>
                                        <th>Patient Address</th>
                                        <td><?php echo htmlspecialchars($row['PatientAdd']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Patient Gender</th>
                                        <td><?php echo htmlspecialchars($row['PatientGender']); ?></td>
                                        <th>Patient Age</th>
                                        <td><?php echo htmlspecialchars($row['PatientAge']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Patient Medical History(if any)</th>
                                        <td><?php echo htmlspecialchars($row['PatientMedhis']); ?></td>
                                        <th>Patient Reg Date</th>
                                        <td><?php echo htmlspecialchars($row['CreationDate']); ?></td>
                                    </tr>
                                </table>
                                <?php } $ret->close(); ?>
                                <?php
                                $ret = $con->prepare("SELECT * FROM tblmedicalhistory WHERE PatientID = ?");
                                $ret->bind_param("i", $vid);
                                $ret->execute();
                                $result = $ret->get_result();
                                ?>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tr align="center">
                                        <th colspan="8">Medical History</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Blood Pressure</th>
                                        <th>Weight</th>
                                        <th>Blood Sugar</th>
                                        <th>Body Temperature</th>
                                        <th>Medical Prescription</th>
                                        <th>Chronic Conditions</th>
                                        <th>Previous Dental Treatments</th>
                                        <th>Visit Date</th>
                                    </tr>
                                    <?php
                                    $cnt = 1;
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo htmlspecialchars($row['BloodPressure']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Weight']); ?></td>
                                        <td><?php echo htmlspecialchars($row['BloodSugar']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Temperature']); ?></td>
                                        <td><?php echo htmlspecialchars($row['MedicalPres']); ?></td>
                                        <td><?php echo htmlspecialchars($row['ChronicCond']); ?></td>
                                        <td><?php echo htmlspecialchars($row['PrevDen']); ?></td>
                                        <td><?php echo htmlspecialchars($row['CreationDate']); ?></td>
                                    </tr>
                                    <?php $cnt = $cnt + 1; } $ret->close(); ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start: FOOTER -->
        <?php include('include/footer.php'); ?>
        <!-- end: FOOTER -->
        <!-- start: SETTINGS -->
        <?php include('include/setting.php'); ?>
        <!-- end: SETTINGS -->
    </div>
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
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>
</html>
