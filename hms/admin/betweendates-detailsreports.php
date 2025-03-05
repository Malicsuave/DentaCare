<?php
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict',
]);
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');

check_login();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Validate and sanitize input
$fdate = filter_input(INPUT_POST, 'fromdate', FILTER_SANITIZE_STRING);
$tdate = filter_input(INPUT_POST, 'todate', FILTER_SANITIZE_STRING);

// CSRF Protection
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    die('Invalid CSRF token');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | View Patients</title>
    
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
        <?php include('include/footer.php');?>    
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <!-- end: TOP NAVBAR -->
            <div class="main-content" >
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | View Patients</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>View Patients</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="tittle-w3-agileits mb-4">Between dates reports</h4>
                                <h5 align="center" style="color:blue">Report from <?php echo htmlentities($fdate); ?> to <?php echo htmlentities($tdate); ?></h5>
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Patient Name</th>
                                            <th>Patient Contact Number</th>
                                            <th>Patient Gender </th>
                                            <th>Creation Date </th>
                                            <th>Updation Date </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql = mysqli_prepare($con, "SELECT * FROM tblpatient WHERE date(CreationDate) BETWEEN ? AND ?");
mysqli_stmt_bind_param($sql, "ss", $fdate, $tdate);
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);
$cnt = 1;
while ($row = mysqli_fetch_array($result)) {
?>
                                        <tr>
                                            <td class="center"><?php echo $cnt;?>.</td>
                                            <td class="hidden-xs"><?php echo htmlentities($row['PatientName']);?></td>
                                            <td><?php echo htmlentities($row['PatientContno']);?></td>
                                            <td><?php echo htmlentities($row['PatientGender']);?></td>
                                            <td><?php echo htmlentities($row['CreationDate']);?></td>
                                            <td><?php echo htmlentities($row['UpdationDate']);?></td>
                                            <td>
                                                <a href="view-patient.php?viewid=<?php echo htmlentities($row['ID']);?>"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
<?php 
$cnt = $cnt + 1;
}
mysqli_stmt_close($sql);
?>
                                    </tbody>
                                </table>
                                <!-- Add Export Buttons -->
                                <div>
                                    <form action="bw_pdf.php" method="post" style="display:inline;">
                                        <input type="hidden" name="fromdate" value="<?php echo htmlentities($fdate); ?>">
                                        <input type="hidden" name="todate" value="<?php echo htmlentities($tdate); ?>">
                                        <button type="submit" class="btn btn-danger">Export to PDF</button>
                                    </form>
                                    <form action="bw_excel.php" method="post" style="display:inline;">
                                        <input type="hidden" name="fromdate" value="<?php echo htmlentities($fdate); ?>">
                                        <input type="hidden" name="todate" value="<?php echo htmlentities($tdate); ?>">
                                        <button type="submit" class="btn btn-success">Export to Excel</button>
                                    </form>
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