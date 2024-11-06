<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: error.php");
    exit();
}

if (isset($_POST['submit']) || isset($_POST['pay_online'])) {
    $specilization = $_POST['Doctorspecialization'];
    $doctorid = $_POST['doctor'];
    $userid = $_SESSION['id'];
    $fees = $_POST['fees'];
    $appdate = $_POST['appdate'];
    $time = $_POST['apptime'];
    $userstatus = 1;
    $docstatus = 1;

    // Check if the selected date is in the past
    $currentDate = date('Y-m-d');
    if ($appdate < $currentDate) {
        $_SESSION['msg'] = 'You cannot book an appointment in the past. Please select a valid date.';
        $_SESSION['msg_type'] = 'error';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Validate the appointment time based on the day of the week
    $dayOfWeek = date('N', strtotime($appdate)); // 1 (for Monday) through 7 (for Sunday)
    $appointmentTime = date("H:i", strtotime($time)); // Convert time to 24-hour format for comparison

    // Set allowed time ranges for weekdays and weekends
    $weekdayStart = "10:00";
    $weekdayEnd = "17:00";
    $weekendStart = "10:00";
    $weekendEnd = "15:00";

    // Check if the selected time falls within the allowed range
    if (($dayOfWeek >= 1 && $dayOfWeek <= 5 && ($appointmentTime < $weekdayStart || $appointmentTime > $weekdayEnd)) ||
        ($dayOfWeek == 6 || $dayOfWeek == 7) && ($appointmentTime < $weekendStart || $appointmentTime > $weekendEnd)) {
        $_SESSION['msg'] = 'Invalid appointment time. Please select a time between 10:00 AM and 5:00 PM on weekdays, or 10:00 AM to 3:00 PM on weekends.';
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
        if (isset($_POST['pay_online'])) {
            $_SESSION['appointment_data'] = [
                'doctorSpecialization' => $specilization,
                'doctorId' => $doctorid,
                'userId' => $userid,
                'consultancyFees' => $fees,
                'appointmentDate' => $appdate,
                'appointmentTime' => $time,
                'userStatus' => $userstatus,
                'doctorStatus' => $docstatus
            ];
            header("Location: pay_fee.php");
            exit();
        } else {
            $stmt = $con->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $specilization, $doctorid, $userid, $fees, $appdate, $time, $userstatus, $docstatus);

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
    <script src="https://checkout.stripe.com/checkout.js"></script>
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
                                                    <input class="form-control timepicker" name="apptime" id="timepicker1" required="required" placeholder="eg: 10:00 PM">
                                                </div>

                                                <button type="button" id="payButton" class="btn btn-o btn-primary">Proceed to Pay</button>
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

<script>
    document.getElementById('payButton').addEventListener('click', function(e) {
        var handler = StripeCheckout.configure({
            key: 'pk_test_51QG2QFLwfEoMpz35Dnxr0pzi4u8S4FuYmcNPnIBcfXsm1RkZGv5i8jHvLPp7jR0UVxRTkjkSqho3cUz5WtPVhl2B00mX4vJt68', // Replace with your Stripe public key
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            locale: 'auto',
            token: function(token) {
                // Insert the token into the form
                var form = document.getElementById('appointmentForm');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Add a hidden input for the total amount
                var fees = document.getElementById('fees').value;
                var hiddenAmountInput = document.createElement('input');
                hiddenAmountInput.setAttribute('type', 'hidden');
                hiddenAmountInput.setAttribute('name', 'total');
                hiddenAmountInput.setAttribute('value', fees * 100); // Convert to cents
                form.appendChild(hiddenAmountInput);

                // Submit the form
                form.submit();
            }
        });

        // Open the Stripe Checkout with default options
        handler.open({
            name: 'DentaCare',
            description: 'Full Payment',
            amount: document.getElementById('fees').value * 100, // Convert to cents
            currency: 'php',
            email: 'reywillardd01@gmail.com'
        });
        e.preventDefault();
    });

    window.addEventListener('popstate', function() {
        handler.close();
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
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
        $('.datepicker').datepicker();
        $('.timepicker').timepicker();
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
