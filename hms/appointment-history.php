<?php
// Start session with secure cookie settings
$cookieParams = session_get_cookie_params();
session_set_cookie_params([
    'lifetime' => $cookieParams['lifetime'],
    'path' => $cookieParams['path'],
    'domain' => $cookieParams['domain'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

// Error reporting (in production, log errors instead of displaying them)
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

require_once('include/config.php');
require_once('include/checklogin.php');

// CSRF Protection
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Authentication check
check_login();

// Authorization check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    $_SESSION['msg'] = 'Unauthorized access attempt logged';
    $_SESSION['msg_type'] = 'error';
    error_log('Unauthorized access attempt from IP: ' . $_SERVER['REMOTE_ADDR']);
    header("Location: error.php");
    exit();
}

if (isset($_GET['cancel']) && isset($_GET['id'])) {
    // Validate CSRF token
    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['msg'] = 'Invalid request';
        $_SESSION['msg_type'] = 'error';
        header("Location: appointment-history.php");
        exit();
    }

    // Input validation and sanitization
    $appointmentId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    // Verify appointment belongs to current user
    $stmt = $con->prepare("SELECT userId FROM appointment WHERE id = ? AND userId = ?");
    $stmt->bind_param("ii", $appointmentId, $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        // Prepared statement for update
        $updateStmt = $con->prepare("UPDATE appointment SET userStatus='0' WHERE id = ? AND userId = ?");
        $updateStmt->bind_param("ii", $appointmentId, $_SESSION['id']);
        
        if ($updateStmt->execute()) {
            $_SESSION['msg'] = "Your appointment has been canceled";
            $_SESSION['alert'] = "cancel";
            // Log the action
            error_log("Appointment ID: " . $appointmentId . " canceled by user ID: " . $_SESSION['id']);
        } else {
            $_SESSION['msg'] = "Error canceling appointment";
            $_SESSION['msg_type'] = "error";
            error_log("Error canceling appointment: " . $updateStmt->error);
        }
        $updateStmt->close();
    } else {
        $_SESSION['msg'] = "Invalid appointment";
        $_SESSION['msg_type'] = "error";
        error_log("Invalid appointment cancellation attempt by user ID: " . $_SESSION['id']);
    }
    $stmt->close();
}

// Fetch appointments using prepared statement
$stmt = $con->prepare("SELECT doctors.doctorName AS docname, appointment.* 
                      FROM appointment 
                      JOIN doctors ON doctors.id = appointment.doctorId 
                      WHERE appointment.userId = ?
                      ORDER BY appointment.appointmentDate DESC");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$appointments = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Appointment History</title>
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
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;">
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
                            <h1 class="mainTitle">User | Appointment History</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>User </span>
                            </li>
                            <li class="active">
                                <span>Appointment History</span>
                            </li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                            <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                            <table class="table table-hover" id="sample-table-1">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th class="hidden-xs">Doctor Name</th>
                                        <th>Specialization</th>
                                        <th>Consultancy Fee</th>
                                        <th>Appointment Date / Time</th>
                                        <th>Appointment Creation Date</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $cnt = 1;
                                while ($row = $appointments->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $cnt; ?>.</td>
                                        <td class="hidden-xs"><?php echo $row['docname']; ?></td>
                                        <td><?php echo $row['doctorSpecialization']; ?></td>
                                        <td><?php echo $row['consultancyFees']; ?></td>
                                        <td><?php echo $row['appointmentDate']; ?> / <?php echo $row['appointmentTime']; ?></td>
                                        <td><?php echo $row['postingDate']; ?></td>
                                        <td>
                                            <?php 
                                            if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                                echo "Active";
                                            } elseif (($row['userStatus'] == 0) && ($row['doctorStatus'] == 1)) {
                                                echo "Canceled by You";
                                            } elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                                echo "Canceled by Doctor";
                                            } elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 2)) {
                                                echo "Successful"; // Display "Successful" for successful appointments
                                            } else {
                                                echo ""; // For other states, just leave it blank
                                            } 
                                            ?>
                                        </td>
                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>
                                                    <a href="appointment-history.php?id=<?php echo $row['id']; ?>&cancel=update&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" 
                                                       onClick="return confirm('Are you sure you want to cancel this appointment?')" 
                                                       class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment">Cancel</a>
                                                <?php } elseif (($row['userStatus'] == 1) && ($row['doctorStatus'] == 2)) {
                                                    // Leave this blank when the appointment is successful
                                                    echo ""; 
                                                } else {
                                                    echo "Canceled"; // Show "Canceled" for canceled appointments
                                                } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                    $cnt++;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
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
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
    });
</script>

</body>
</html>