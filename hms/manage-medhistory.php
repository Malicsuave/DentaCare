<?php
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict',
]);

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/app_errors.log');

include('include/config.php');
include('include/checklogin.php');
check_login();

// Encryption key and IV
define("ENCRYPTION_KEY", base64_decode("your-base64-encoded-32-byte-key"));
define("ENCRYPTION_IV", substr(base64_decode("your-base64-encoded-16-byte-iv"), 0, 16));

function encryptData($data) {
    return base64_encode(openssl_encrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_IV));
}

function decryptData($encryptedData) {
    return openssl_decrypt(base64_decode($encryptedData), 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $vid = filter_input(INPUT_GET, 'viewid', FILTER_SANITIZE_NUMBER_INT);
    $bp = encryptData(htmlspecialchars(strip_tags($_POST['bp'])));
    $bs = encryptData(htmlspecialchars(strip_tags($_POST['bs'])));
    $weight = encryptData(htmlspecialchars(strip_tags($_POST['weight'])));
    $temp = encryptData(htmlspecialchars(strip_tags($_POST['temp'])));
    $pres = encryptData(htmlspecialchars(strip_tags($_POST['pres'])));
    $chronic = encryptData(htmlspecialchars(strip_tags($_POST['chronic'])));
    $prev = encryptData(htmlspecialchars(strip_tags($_POST['previous'])));

    $stmt = $con->prepare("INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres, ChronicCond, PrevDen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssssss', $vid, $bp, $bs, $weight, $temp, $pres, $chronic, $prev);
    if ($stmt->execute()) {
        echo '<script>alert("Medical history has been added.")</script>';
        echo "<script>window.location.href ='manage-patient.php'</script>";
    } else {
        error_log("Error: " . $stmt->error, 3, "/var/log/app_errors.log");
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
    $stmt->close();
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
                                $stmt = $con->prepare("SELECT * FROM tblpatient WHERE ID = ?");
                                $stmt->bind_param('i', $vid);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <table class="table table-bordered">
                                        <tr align="center">
                                            <td colspan="4" style="font-size:20px;color:blue">Patient Details</td>
                                        </tr>
                                        <tr>
                                            <th>Patient Name</th>
                                            <td><?php echo htmlentities($row['PatientName']); ?></td>
                                            <th>Patient Email</th>
                                            <td><?php echo htmlentities($row['PatientEmail']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Patient Mobile Number</th>
                                            <td><?php echo htmlentities($row['PatientContno']); ?></td>
                                            <th>Patient Address</th>
                                            <td><?php echo htmlentities($row['PatientAdd']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Patient Gender</th>
                                            <td><?php echo htmlentities($row['PatientGender']); ?></td>
                                            <th>Patient Age</th>
                                            <td><?php echo htmlentities($row['PatientAge']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Patient Medical History (if any)</th>
                                            <td><?php echo htmlentities($row['PatientMedhis']); ?></td>
                                            <th>Patient Reg Date</th>
                                            <td><?php echo htmlentities($row['CreationDate']); ?></td>
                                        </tr>
                                    </table>
                                <?php } ?>

                                <!-- Existing Medical History Table -->
                                <h5 class="margin-top-30">Existing <span class="text-bold">Medical History</span></h5>
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Blood Pressure</th>
                                            <th>Blood Sugar</th>
                                            <th>Weight</th>
                                            <th>Temperature</th>
                                            <th>Medical Prescription</th>
                                            <th>Chronic Conditions</th>
                                            <th>Previous Dental Treatments</th>
                                            <th>Visit Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = mysqli_query($con, "SELECT * FROM tblmedicalhistory WHERE PatientID='$vid'");
                                        while ($row = mysqli_fetch_array($ret)) {
                                            echo "<tr>
                                                <td>{$row['BloodPressure']}</td>
                                                <td>{$row['BloodSugar']}</td>
                                                <td>{$row['Weight']}</td>
                                                <td>{$row['Temperature']}</td>
                                                <td>{$row['MedicalPres']}</td>
                                                <td>{$row['ChronicCond']}</td>
                                                <td>{$row['PrevDen']}</td>
                                                <td>{$row['CreationDate']}</td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Form for Medical History Upload -->
                                <h5 class="margin-top-30">Upload <span class="text-bold">Medical Records</span></h5>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="file" name="file" class="form-control-file">
                                    </div>
                                    <button type="submit" name="btnUpload" class="btn btn-primary">Upload Medical Records</button>
                                </form>

                                <!-- New Table for Uploaded Medical Records -->
                                <?php
                                if (isset($_POST["btnUpload"])) {
                                    echo "<hr>";
                                    echo "<h5 class='margin-top-30'>Uploaded <span class='text-bold'>Medical Records</span></h5>";
                                    echo "<table class='table table-bordered'>";
                                    echo "<thead class='thead-light'>
                                            <tr>
                                                <th>Blood Pressure</th>
                                                <th>Blood Sugar</th>
                                                <th>Weight</th>
                                                <th>Temperature</th>
                                                <th>Medical Prescription</th>
                                                <th>Chronic Conditions</th>
                                                <th>Previous Dental Treatments</th>
                                                <th>Errors</th>
                                            </tr>
                                        </thead>
                                        <tbody>";

                                    echo "<form method='POST'>";

                                    $btnStatus = "ENABLED";
                                    $filename = $_FILES["file"]["tmp_name"];

                                    if ($_FILES["file"]["size"] > 0) {
                                        $file = fopen($filename, "r");
                                        $row = 1;

                                        while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
                                            $bp = $bs = $weight = $temp = $pres = $chronic = $prev = "";
                                            $errorMsg = "";

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

                                            // Validate data
                                            if (empty($bp)) $errorMsg .= "Blood Pressure is empty! ";
                                            if (empty($bs)) $errorMsg .= "Blood Sugar is empty! ";
                                            if (empty($weight)) $errorMsg .= "Weight is empty! ";
                                            if (empty($temp)) $errorMsg .= "Temperature is empty! ";
                                            if (empty($pres)) $errorMsg .= "Prescription is empty! ";
                                            if (empty($chronic)) $errorMsg .= "Chronic Conditions is empty! ";
                                            if (empty($prev)) $errorMsg .= "Previous Dental Treatments is empty! ";

                                            // Store data for each valid row
                                            echo "<input type='hidden' name='bp[]' value='$bp'>";
                                            echo "<input type='hidden' name='bs[]' value='$bs'>";
                                            echo "<input type='hidden' name='weight[]' value='$weight'>";
                                            echo "<input type='hidden' name='temp[]' value='$temp'>";
                                            echo "<input type='hidden' name='pres[]' value='$pres'>";
                                            echo "<input type='hidden' name='chronic[]' value='$chronic'>";
                                            echo "<input type='hidden' name='prev[]' value='$prev'>";

                                            // Display row in table
                                            echo "<tr>
                                                    <td>$bp</td>
                                                    <td>$bs</td>
                                                    <td>$weight</td>
                                                    <td>$temp</td>
                                                    <td>$pres</td>
                                                    <td>$chronic</td>
                                                    <td>$prev</td>
                                                    <td>$errorMsg</td>
                                                </tr>";
                                            $row++;
                                        }

                                        fclose($file);
                                    }

                                    echo "</tbody></table>";
                                    echo "<div class='text-right'>
                                            <button type='submit' $btnStatus name='btnAdd' class='btn btn-success'>Add Medical Records</button>
                                        </div>";
                                    echo "</form>";
                                }

                                // Insert Uploaded Medical Records into Database
                                if (isset($_POST["btnAdd"])) {
                                    $bps = $_POST["bp"];
                                    $bss = $_POST["bs"];
                                    $weights = $_POST["weight"];
                                    $temps = $_POST["temp"];
                                    $prescriptions = $_POST["pres"];
                                    $chronicConditions = $_POST["chronic"];
                                    $previousTreatments = $_POST["prev"];

                                    foreach ($bps as $index => $bp) {
                                        $bs = $bss[$index];
                                        $weight = $weights[$index];
                                        $temp = $temps[$index];
                                        $pres = $prescriptions[$index];
                                        $chronic = $chronicConditions[$index];
                                        $prev = $previousTreatments[$index];

                                        // Insert into the database
                                        mysqli_query($con, "INSERT INTO tblmedicalhistory (PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres, ChronicCond, PrevDen) VALUES ('$vid', '$bp', '$bs', '$weight', '$temp', '$pres', '$chronic', '$prev')");
                                    }
                                    echo "<script>window.location.href='manage-medhistory?notify=<font color=green>Medical records have been uploaded!</font>';</script>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php include('include/setting.php'); ?>
                </div>
            </div>
        </div>
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
        });
    </script>
</body>
</html>