<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: error.php");
    exit();
}
if (isset($_POST['submit'])) {
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
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Validate the appointment time based on the day of the week
    $dayOfWeek = date('N', strtotime($appdate)); // 1 (for Monday) through 7 (for Sunday)
    
    // Define allowed time ranges
    $allowedWeekdayTimes = ['10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM'];
    $allowedWeekendTimes = ['10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM'];

    // Validate the time
    if (($dayOfWeek >= 1 && $dayOfWeek <= 5 && !in_array($time, $allowedWeekdayTimes)) || 
        ($dayOfWeek == 6 && !in_array($time, $allowedWeekendTimes)) || 
        ($dayOfWeek == 7 && !in_array($time, $allowedWeekendTimes))) {
        $_SESSION['msg'] = 'Invalid appointment time. Please select a time between 10:00 AM and 5:00 PM on weekdays, or 10:00 AM to 3:00 PM on weekends.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Check if the user already has an appointment on the same date
    $checkAppointmentQuery = $con->prepare("SELECT * FROM appointment WHERE userId=? AND appointmentDate=?");
    $checkAppointmentQuery->bind_param("ss", $userid, $appdate);
    $checkAppointmentQuery->execute();
    $result = $checkAppointmentQuery->get_result();

    if ($result->num_rows > 0) {
        // Appointment already exists
        $_SESSION['msg'] = 'You already have an appointment booked on this date. Please choose another date.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $specilization, $doctorid, $userid, $fees, $appdate, $time, $userstatus, $docstatus);

        if ($stmt->execute()) {
            $_SESSION['msg'] = 'Your appointment has been successfully booked.';
        } else {
            $_SESSION['msg'] = 'Error booking appointment: ' . $stmt->error;
        }

        $checkAppointmentQuery->close();
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
    
    <!-- Include SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
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
                                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg1']);?><?php echo htmlentities($_SESSION['msg1']="");?></p>    
                                            <form role="form" name="book" method="post">
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

                                                <button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('include/footer.php');?>
                <?php include('include/setting.php');?>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/modernizr/modernizr.js"></script>
<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="vendor/perfect-scrollbar /perfect-scrollbar.min.js"></script>
<script src="vendor/switchery/switchery.min.js"></script>
<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
    jQuery(document).ready(function() {
        Main.init();
        $('.datepicker').datepicker();
        $('.timepicker').timepicker();
    });
</script>
<script>
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
    // Display messages using SweetAlert
    <?php if (isset($_SESSION['msg'])): ?>
        Swal.fire({
            title: 'Notification',
            text: '<?php echo addslashes($_SESSION['msg']); ?>',
            icon: '<?php echo strpos($_SESSION['msg'], 'Error') !== false ? 'error' : 'success'; ?>',
            confirmButtonText: 'OK'
        }).then(() => {
            // Clear the message after displaying
            <?php 
            unset($_SESSION['msg']); // Unset the session message here
            ?>
        });
    <?php endif; ?>
});
    </script>
</body>
</html>