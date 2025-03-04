<?php

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

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include('include/config.php');
include('include/checklogin.php');
check_login();

require '../vendor/autoload.php'; // Ensure PayPal SDK is loaded

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

$clientId = 'AY-gfl-uXBUXsyYEhwRyW6p-wgZv_GBeZsV8AEWLgj8NOOcIkD-xPH--HlcwESe4v9HA3jW68NhXRU1I'; // Replace with your actual PayPal client ID
$clientSecret = 'ENjXYuxvihqYfX7tWwt84K4OL1PAtJlz8N4Bp303H-MAhV8bTGXGg31YHZc6B-twIMxjt6UYEXU9-CHs'; // Replace with your actual PayPal client secret

$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);

function validateAppointment($appdate, $time) {
    $currentDate = date('Y-m-d');
    if ($appdate < $currentDate) {
        return 'You cannot book an appointment in the past. Please select a valid date.';
    }

    $dayOfWeek = date('N', strtotime($appdate)); // 1 (for Monday) through 7 (for Sunday)
    $appointmentTime = date("H:i", strtotime($time)); // Convert time to 24-hour format for comparison

    // Set allowed time ranges for weekdays and weekends
    $weekdayStart = "10:00";
    $weekdayEnd = "17:00";
    $weekendStart = "10:00";
    $weekendEnd = "15:00";

    // Check if the selected time falls within the allowed range
    if (($dayOfWeek >= 1 && $dayOfWeek <= 5 && ($appointmentTime < $weekdayStart || $appointmentTime > $weekdayEnd)) ||
        ($dayOfWeek == 6 || $dayOfWeek == 7 && ($appointmentTime < $weekendStart || $appointmentTime > $weekendEnd))) {
        return 'Invalid appointment time. Please select a time between 10:00 AM and 5:00 PM on weekdays, or 10:00 AM to 3:00 PM on weekends.';
    }

    return null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['paypal'])) {

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $_SESSION['msg'] = 'Invalid CSRF token.';
        $_SESSION['msg_type'] = 'error';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $userid = $_SESSION['id'];
    $specilization = htmlspecialchars(strip_tags($_POST['Doctorspecialization']));
    $doctorid = htmlspecialchars(strip_tags($_POST['doctor']));
    $fees = htmlspecialchars(strip_tags($_POST['fees']));
    $appdate = htmlspecialchars(strip_tags($_POST['appdate']));
    $time = htmlspecialchars(strip_tags($_POST['apptime']));
    $userstatus = 1;
    $docstatus = 1;

    // Validate appointment date and time
    $validationError = validateAppointment($appdate, $time);
    if ($validationError) {
        $_SESSION['msg'] = $validationError;
        $_SESSION['msg_type'] = 'error';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Set session variables
    $_SESSION['Doctorspecialization'] = $specilization;
    $_SESSION['doctor'] = $doctorid;
    $_SESSION['fees'] = $fees;
    $_SESSION['appdate'] = $appdate;
    $_SESSION['apptime'] = $time;

    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = [
        "intent" => "CAPTURE",
        "purchase_units" => [[
            "amount" => [
                "value" => $fees,
                "currency_code" => "PHP"
            ]
        ]],
        "application_context" => [
            "cancel_url" => "http://localhost/dentacare/hms/book-appointment.php",
            "return_url" => "http://localhost/dentacare/hms/book-appointment.php?success=true"
        ]
    ];

    try {
        $response = $client->execute($request);
        foreach ($response->result->links as $link) {
            if ($link->rel == 'approve') {
                header("Location: " . $link->href);
                exit();
            }
        }
    } catch (Exception $ex) {
        $_SESSION['msg'] = "Error processing payment: " . $ex->getMessage();
        $_SESSION['msg_type'] = "error";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_GET['success']) && $_GET['success'] == 'true' && isset($_GET['token'])) {
    $token = $_GET['token'];

    $request = new OrdersCaptureRequest($token);
    $request->prefer('return=representation');

    try {
        $response = $client->execute($request);

        if ($response->result->status == 'COMPLETED') {
            if (isset($_SESSION['id'], $_SESSION['Doctorspecialization'], $_SESSION['doctor'], $_SESSION['fees'], $_SESSION['appdate'], $_SESSION['apptime'])) {
                $userid = $_SESSION['id'];
                $specilization = $_SESSION['Doctorspecialization'];
                $doctorid = $_SESSION['doctor'];
                $fees = $_SESSION['fees'];
                $appdate = $_SESSION['appdate'];
                $time = $_SESSION['apptime'];
                $userstatus = 1;
                $docstatus = 1;
                $payment_method = 'Online';

                // Insert payment details into DB
                $stmt = $con->prepare("INSERT INTO payments (user_id, amount, transaction_id, status) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("idss", $userid, $fees, $response->result->id, $response->result->status);
                $stmt->execute();
                $stmt->close();

                // Insert appointment details
                $stmt = $con->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssss", $specilization, $doctorid, $userid, $fees, $appdate, $time, $userstatus, $docstatus, $payment_method);
                $stmt->execute();
                $stmt->close();

                $_SESSION['msg'] = "Payment and appointment booking successful!";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['msg'] = "Session variables not set.";
                $_SESSION['msg_type'] = "error";
            }
        } else {
            $_SESSION['msg'] = "Payment failed. Please try again.";
            $_SESSION['msg_type'] = "error";
        }
    } catch (Exception $ex) {
        $_SESSION['msg'] = "Error processing payment: " . $ex->getMessage();
        $_SESSION['msg_type'] = "error";
    }
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: error.php");
    exit();
}

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $_SESSION['msg'] = 'Invalid CSRF token.';
        $_SESSION['msg_type'] = 'error';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    $specilization = htmlspecialchars(strip_tags($_POST['Doctorspecialization']));
    $doctorid = htmlspecialchars(strip_tags($_POST['doctor']));
    $userid = $_SESSION['id'];
    $fees = htmlspecialchars(strip_tags($_POST['fees']));
    $appdate = htmlspecialchars(strip_tags($_POST['appdate']));
    $time = htmlspecialchars(strip_tags($_POST['apptime']));
    $userstatus = 1;
    $docstatus = 1;
    $payment_method = 'Cash';

    // Validate appointment date and time
    $validationError = validateAppointment($appdate, $time);
    if ($validationError) {
        $_SESSION['msg'] = $validationError;
        $_SESSION['msg_type'] = 'error';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Check if the user already has an appointment on the same date
    $checkAppointmentQuery = $con->prepare("SELECT * FROM appointment WHERE userId=? AND appointmentDate=?");
    $checkAppointmentQuery->bind_param("ss", $userid, $appdate);
    $checkAppointmentQuery->execute();
    $result = $checkAppointmentQuery->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['msg'] = 'You already have an appointment booked on this date. Please choose another date.';
        $_SESSION['msg_type'] = 'error';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $stmt = $con->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $specilization, $doctorid, $userid, $fees, $appdate, $time, $userstatus, $docstatus, $payment_method);

        if ($stmt->execute()) {
            $_SESSION['msg'] = 'Your appointment has been successfully booked.';
            $_SESSION['msg_type'] = 'success';
        } else {
            $_SESSION['msg'] = 'Error booking appointment: ' . $stmt->error;
            $_SESSION['msg_type'] = 'error';
        }

        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Book Appointment</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css">
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
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div id="app">        
    <?php include('include/footer.php');?>
    <?php include('include/sidebar.php');?>
    <div class="app-content">
        <?php include('include/header.php');?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">User  | Book Appointment</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>User</span></li>
                            <li class="active"><span>Book Appointment</span></li>
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
                                            <h5 class="panel-title">Book Appointment</h5>
                                        </div>
                                        <div class="panel-body">
                                            <form role="form" name="book" method="post" id="appointmentForm">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <div class="form-group">
                                                    <label for="DoctorSpecialization">Doctor Specialization</label>
                                                    <select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
                                                        <option value="">Select Specialization</option>
                                                        <?php 
                                                        $ret = mysqli_query($con,"select * from doctorspecilization");
                                                        while ($row = mysqli_fetch_array($ret)) {
                                                        ?>
                                                        <option value="<?php echo htmlentities($row['specilization']);?>"><?php echo htmlentities($row['specilization']);?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="doctor">Doctors</label>
                                                    <select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
                                                        <option value="">Select Doctor</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="consultancyfees">Consultancy Fees</label>
                                                    <select name="fees" class="form-control" id="fees" readonly></select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="AppointmentDate">Date</label>
                                                    <input class="form-control datepicker" name="appdate" required="required" data-date-format="yyyy-mm-dd" id="appdate">
                                                </div>

                                                <div class="form-group">
                                                    <label for="Appointmenttime">Time</label>
                                                    <input class="form-control timepicker" name="apptime" id="timepicker1" required="required" placeholder="eg: 10:00 AM">
                                                </div>

                                                <input type="hidden" name="pay_online" value="1">
                                                <button type="submit" name="paypal" class="btn btn-o btn-primary">Proceed to Pay with PayPal</button>
                                                <button type="submit" name="submit" class="btn btn-o btn-secondary">Book without Payment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
                <?php include('include/setting.php');?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.timepicker').timepicker({
            showMeridian: true,
            defaultTime: 'current'
        });
    });

    function getdoctor(val) {
        $.ajax({
            type: "POST",
            url: "get_doctor.php",
            data: 'specilizationid=' + val,
            success: function(data) {
                $("#doctor").html(data);
            }
        });
    }

    function getfee(val) {
        $.ajax({
            type: "POST",
            url: "get_doctor.php",
            data: 'doctor=' + val,
            success: function(data) {
                $("#fees").html(data);
            }
        });
    }

    $(document).ready(function() {
        // Display messages using SweetAlert only if there is a message to show
        <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])): ?>
            Swal.fire({
                title: '<?php echo ($_SESSION['msg_type'] === 'error') ? 'Error' : 'Success'; ?>',
                text: '<?php echo addslashes($_SESSION['msg']); ?>',
                icon: '<?php echo ($_SESSION['msg_type'] === 'error') ? 'error' : 'success'; ?>',
                confirmButtonText: 'OK'
            }).then(() => {
                <?php unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
            });
        <?php endif; ?>
    });
</script>
</body>
</html>