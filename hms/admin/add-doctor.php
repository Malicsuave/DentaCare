<?php
session_start();

include('include/config.php');
include('include/checklogin.php');
check_login();

require '../PHPMailer/vendor/autoload.php';

// Debugging: Display session role


// Ensure the user has admin role
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: error.php"); // Redirect to an error page or home page
        exit();
    }

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])) {
    echo "Form submitted successfully. Processing...<br>"; // Debugging line

    $docspecialization = $_POST['Doctorspecialization'];
    $docname = $_POST['docname'];
    $docaddress = $_POST['clinicaddress'];
    $docfees = $_POST['docfees'];
    $doccontactno = $_POST['doccontact'];
    $docemail = $_POST['docemail'];

    // Generate a random password
    function random_password($length = 8) {
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($str), 0, $length);
    }
    $password = random_password(8);
    $hashed_password = md5($password); // Hash the password for storage

    // Insert doctor info into the database
    $sql = mysqli_query($con, "INSERT INTO doctors(specilization, doctorName, address, docFees, contactno, docEmail, password) VALUES('$docspecialization', '$docname', '$docaddress', '$docfees', '$doccontactno', '$docemail', '$hashed_password')");
    
    // Check if the query was successful
    if (!$sql) {
        echo "Database error: " . mysqli_error($con); // Debugging line
        exit();
    } else {
        echo "Doctor added successfully.<br>"; // Debugging line
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'reywillardd01@gmail.com';
            $mail->Password = 'rvuf yyem neki ctql';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('reywillardd01@gmail.com', 'DentaCare');
            $mail->addAddress($docemail, $docname);

            $mail->isHTML(true);
            $mail->Subject = 'Your Account Details';
            $mail->Body = "Dear $docname,<br>Your account has been created successfully!<br>Your password is: <strong>$password</strong><br>Thank you!";
            
            $mail->send();
            $success = true; // Set success flag to true
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Add Doctor</title>
    <!-- Include Stylesheets and Scripts -->
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
    <div id="app"><?php include('include/footer.php'); ?>
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Add Dentist</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Admin</span></li>
                                <li class="active"><span>Add Dentist</span></li>
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
                                                <h5 class="panel-title">Add Dentist</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="DoctorSpecialization">Dentist Specialization</label>
                                                        <select name="Doctorspecialization" class="form-control" required="true">
                                                            <option value="">Select Specialization</option>
                                                            <?php $ret = mysqli_query($con, "select * from doctorspecilization");
                                                            while ($row = mysqli_fetch_array($ret)) { ?>
                                                                <option value="<?php echo htmlentities($row['specilization']); ?>">
                                                                    <?php echo htmlentities($row['specilization']); ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="doctorname">Doctor Name</label>
                                                        <input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Doctor's Address</label>
                                                        <textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address" required="true"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Doctor Consultancy Fees</label>
                                                        <input type="text" name="docfees" class="form-control" placeholder="Enter Doctor Consultancy Fees" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Doctor Contact no</label>
                                                        <input type="text" name="doccontact" class="form-control" placeholder="Enter Doctor Contact no" required="true" pattern="[0-9]{11}" title="Contact number must be 11 digits and contain only numbers." maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Doctor Email</label>
                                                        <input type="email" id="docemail" name="docemail" class="form-control" placeholder="Enter Doctor Email id" required="true" onBlur="checkemailAvailability()">
                                                        <span id="email-availability-status"></span>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php if (isset($success) && $success): ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Doctor info added successfully and email sent!',
                    }).then(() => {
                        window.location.href = 'manage-doctors.php';
                    });
                </script>
            <?php endif; ?>
        </div>
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
