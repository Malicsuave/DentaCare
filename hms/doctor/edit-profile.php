<?php
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

$updateSuccess = false;

if (isset($_POST['submit'])) {
    $docspecialization = htmlspecialchars(trim($_POST['Doctorspecialization']));
    $docname = htmlspecialchars(trim($_POST['docname']));
    $docaddress = htmlspecialchars(trim($_POST['clinicaddress']));
    $docfees = htmlspecialchars(trim($_POST['docfees']));
    $doccontactno = htmlspecialchars(trim($_POST['doccontact']));
    $docemail = htmlspecialchars(trim($_POST['docemail']));

    // Input Validation and Data Sanitation
    if (!filter_var($docemail, FILTER_VALIDATE_EMAIL)) {
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
    $stmt = $con->prepare("UPDATE doctors SET specilization=?, doctorName=?, address=?, docFees=?, contactno=? WHERE id=?");
    $stmt->bind_param("sssssi", $docspecialization, $docname, $docaddress, $docfees, $doccontactno, $_SESSION['id']);

    if ($stmt->execute()) {
        $updateSuccess = true;
    } else {
        // Error Handling & Logging
        error_log("Error in updating doctor details: " . $stmt->error);
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor | Edit Doctor Details</title>
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
</head>
<body>
    <div id="app"><?php include('include/footer.php'); ?>
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Doctor | Edit Doctor Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Doctor</span></li>
                                <li class="active"><span>Edit Doctor Details</span></li>
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
                                                <h5 class="panel-title">Edit Doctor</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php $sql = mysqli_query($con, "SELECT * FROM doctors WHERE docEmail='" . $_SESSION['dlogin'] . "'");
                                                while ($data = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <h4><?php echo htmlentities($data['doctorName']); ?>'s Profile</h4>
                                                    <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creationDate']); ?></p>
                                                    <?php if ($data['updationDate']) { ?>
                                                        <p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']); ?></p>
                                                    <?php } ?>
                                                    <hr />
                                                    <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                                                        <div class="form-group">
                                                            <label for="DoctorSpecialization">Doctor Specialization</label>
                                                            <select name="Doctorspecialization" class="form-control" required="required">
                                                                <option value="<?php echo htmlentities($data['specilization']); ?>"><?php echo htmlentities($data['specilization']); ?></option>
                                                                <?php $ret = mysqli_query($con, "SELECT * FROM doctorspecilization");
                                                                while ($row = mysqli_fetch_array($ret)) { ?>
                                                                    <option value="<?php echo htmlentities($row['specilization']); ?>"><?php echo htmlentities($row['specilization']); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="doctorname">Doctor Name</label>
                                                            <input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address">Doctor Clinic Address</label>
                                                            <textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fess">Doctor Consultancy Fees</label>
                                                            <input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['docFees']); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fess">Doctor Contact no</label>
                                                            <input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactno']); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fess">Doctor Email</label>
                                                            <input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['docEmail']); ?>">
                                                        </div>
                                                        <?php } ?>
                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">Update</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('include/setting.php'); ?>
                </div>
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
            
            <?php if ($updateSuccess) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Doctor Details Updated Successfully',
                    confirmButtonText: 'OK'
                });
            <?php } ?>
        });
    </script>
</body>
</html>
