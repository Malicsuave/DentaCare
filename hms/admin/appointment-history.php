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

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_GET['cancel'])) {
    // CSRF token validation
    if (!hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $appointmentId = intval($_GET['id']);
    $query = mysqli_prepare($con, "UPDATE appointment SET doctorStatus=0 WHERE id=?");
    mysqli_stmt_bind_param($query, "i", $appointmentId);
    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);

    $_SESSION['msg'] = "Appointment canceled successfully!";
    header("Location: appointment-history.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patients | Appointment History</title>
    
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
                                <h1 class="mainTitle">Patients  | Appointment History</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Patients </span>
                                </li>
                                <li class="active">
                                    <span>Appointment History</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                            <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != ""): ?>
    <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?></p>
    <?php unset($_SESSION['msg']); ?>
<?php endif; ?>
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th class="hidden-xs">Doctor Name</th>
                                            <th>Patient Name</th>
                                            <th>Specialization</th>
                                            <th>Consultancy Fee</th>
                                            <th>Appointment Date / Time </th>
                                            <th>Appointment Creation Date  </th>
                                            <th>Current Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql = mysqli_prepare($con, "SELECT doctors.doctorName as docname, users.fullName as pname, appointment.* FROM appointment JOIN doctors ON doctors.id=appointment.doctorId JOIN users ON users.id=appointment.userId");
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);;
$cnt = 1;
while ($row = mysqli_fetch_array($result)) {
?>
                                        <tr>
                                            <td class="center"><?php echo $cnt;?>.</td>
                                            <td class="hidden-xs"><?php echo htmlentities($row['docname']);?></td>
                                            <td class="hidden-xs"><?php echo htmlentities($row['pname']);?></td>
                                            <td><?php echo htmlentities($row['doctorSpecialization']);?></td>
                                            <td><?php echo htmlentities($row['consultancyFees']);?></td>
                                            <td><?php echo htmlentities($row['appointmentDate']);?> / <?php echo htmlentities($row['appointmentTime']);?></td>
                                            <td><?php echo htmlentities($row['postingDate']);?></td>
                                            <td>
<?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
{
    echo "Active";
}
if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
{
    echo "Cancel by Patient";
}

if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
{
    echo "Cancel by Doctor";
}
?>
                                            </td>
                                            <td>
                                                <div class="visible-md visible-lg hidden-sm hidden-xs">
<?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
{ 
    echo '<a href="appointment-history.php?id='.htmlentities($row['id']).'&cancel=update&csrf_token='.$_SESSION['csrf_token'].'" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Cancel Appointment">Cancel</a>';
} else {
    echo "Canceled";
} ?>
                                                </div>
                                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                    <div class="btn-group" dropdown is-open="status.isopen">
                                                        <button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
                                                            <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right dropdown-light" role="menu">
                                                            <li>
                                                                <a href="edit.php">
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    Share
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    Remove
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
<?php 
$cnt=$cnt+1;
}
mysqli_stmt_close($sql);
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: BASIC EXAMPLE -->
                    <!-- end: SELECT BOXES -->
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