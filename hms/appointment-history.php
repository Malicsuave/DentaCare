<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: error.php");
    exit();
}

if (isset($_GET['cancel'])) {
    mysqli_query($con, "UPDATE appointment SET userStatus='0' WHERE id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "Your appointment canceled !!";
    $_SESSION['alert'] = "cancel"; // Set a session to trigger SweetAlert
}

if (isset($_GET['success'])) {
    mysqli_query($con, "UPDATE appointment SET doctorStatus='1' WHERE id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "Appointment marked as successful!";
    $_SESSION['alert'] = "success"; // Set a session to trigger SweetAlert
}
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
                                $sql = mysqli_query($con, "SELECT doctors.doctorName AS docname, appointment.* FROM appointment JOIN doctors ON doctors.id=appointment.doctorId WHERE appointment.userId='" . $_SESSION['id'] . "'");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($sql)) {
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
            <a href="appointment-history.php?id=<?php echo $row['id'] ?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')" class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>
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
    <?php include('include/footer.php');?>
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
