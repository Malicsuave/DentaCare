<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $vid = $_GET['viewid'];
    $bp = $_POST['bp'];
    $bs = $_POST['bs'];
    $weight = $_POST['weight'];
    $temp = $_POST['temp'];
    $pres = $_POST['pres'];
    $chronic = $_POST['chronic'];
    $prev = $_POST['previous'];

    $query = mysqli_query($con, "INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres, ChronicCond, PrevDen) VALUES ('$vid', '$bp', '$bs', '$weight', '$temp', '$pres', '$chronic', '$prev')");

    if ($query) {
        $successMessage = "Medical history has been added.";
    } else {
        $errorMessage = "Something went wrong. Please try again.";
    }
}

if (isset($_POST["btnUpload"])) {
    $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $row = 1;

        while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
            $bp = $bs = $weight = $temp = $pres = $chronic = $prev = "";

            if ($row == 1) { // Skip the header row
                $row++;
                continue;
            }

            // Retrieve and sanitize each column
            $bp = !empty($data[0]) ? $data[0] : '';
            $bs = !empty($data[1]) ? $data[1] : '';
            $weight = !empty($data[2]) ? $data[2] : '';
            $temp = !empty($data[3]) ? $data[3] : '';
            $pres = !empty($data[4]) ? $data[4] : '';
            $chronic = !empty($data[5]) ? $data[5] : '';
            $prev = !empty($data[6]) ? $data[6] : '';

            if (!empty($bp) && !empty($bs) && !empty($weight) && !empty($temp) && !empty($pres) && !empty($chronic) && !empty($prev)) {
                mysqli_query($con, "INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres, ChronicCond, PrevDen) VALUES ('$vid', '$bp', '$bs', '$weight', '$temp', '$pres', '$chronic', '$prev')");
            }
            $row++;
        }

        fclose($file);
        $successMessage = "Medical records from Excel file have been uploaded successfully.";
    } else {
        $errorMessage = "Failed to upload the Excel file. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users | Medical History Upload</title>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="app"><?php include('include/footer.php');?> 
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Users | Medical History Upload</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Users</span></li>
                                <li class="active"><span>Medical History</span></li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Patient <span class="text-bold">Details</span></h5>

                                <!-- Patient Details Table -->
                                <?php
                                $vid = $_GET['viewid'];
                                $ret = mysqli_query($con, "SELECT * FROM tblpatient WHERE ID='$vid'");
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                    <table class="table table-bordered">
                                        <tr align="center">
                                            <td colspan="4" style="font-size:20px;color:blue">Patient Details</td>
                                        </tr>
                                        <tr>
                                            <th>Patient Name</th>
                                            <td><?php echo $row['PatientName']; ?></td>
                                            <th>Patient Email</th>
                                            <td><?php echo $row['PatientEmail']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Patient Mobile Number</th>
                                            <td><?php echo $row['PatientContno']; ?></td>
                                            <th>Patient Address</th>
                                            <td><?php echo $row['PatientAdd']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Patient Gender</th>
                                            <td><?php echo $row['PatientGender']; ?></td>
                                            <th>Patient Age</th>
                                            <td><?php echo $row['PatientAge']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Patient Medical History (if any)</th>
                                            <td><?php echo $row['PatientMedhis']; ?></td>
                                            <th>Patient Reg Date</th>
                                            <td><?php echo $row['CreationDate']; ?></td>
                                        </tr>
                                    </table>
                                <?php } ?>

                                <!-- Button to Add Medical History Manually -->
                                <p align="center">
                                    <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Add Medical History</button>
                                </p>

                                <!-- Modal for Adding Medical History -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" name="submit">
                                                    <table class="table table-bordered table-hover data-tables">
                                                        <tr>
                                                            <th>Blood Pressure :</th>
                                                            <td><input name="bp" placeholder="Blood Pressure" class="form-control wd-450" required="true"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Blood Sugar :</th>
                                                            <td><input name="bs" placeholder="Blood Sugar" class="form-control wd-450" required="true"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Weight :</th>
                                                            <td><input name="weight" placeholder="Weight" class="form-control wd-450" required="true"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Body Temperature :</th>
                                                            <td><input name="temp" placeholder="Body Temperature" class="form-control wd-450" required="true"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Prescription :</th>
                                                            <td><textarea name="pres" placeholder="Medical Prescription" rows="6" class="form-control wd-450" required="true"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Chronic Conditions :</th>
                                                            <td><textarea name="chronic" placeholder="Chronic Conditions" rows="6" class="form-control wd-450" required="true"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Previous Dental Treatments :</th>
                                                            <td><textarea name="previous" placeholder="Previous Dental Treatments" rows="6" class="form-control wd-450" required="true"></textarea></td>
                                                        </tr>
                                                    </table>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form for Uploading Medical History via Excel File -->
                                <h5 class="margin-top-30">Upload <span class="text-bold">Medical Records via Excel</span></h5>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="file" name="file" class="form-control-file">
                                    </div>
                                    <button type="submit" name="btnUpload" class="btn btn-primary">Upload Medical Records</button>
                                </form>

                                <!-- SweetAlert Messages -->
                                <?php if (isset($successMessage)): ?>
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: "<?php echo $successMessage; ?>",
                                        });
                                    </script>
                                <?php elseif (isset($errorMessage)): ?>
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: "<?php echo $errorMessage; ?>",
                                        });
                                    </script>
                                <?php endif; ?>
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
    <script src="assets/js/main.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
        });
    </script>
</body>
</html>
