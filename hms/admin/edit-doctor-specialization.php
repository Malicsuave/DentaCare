<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');

check_login();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

$id = intval($_GET['id']); // Get the ID
if (isset($_POST['submit'])) {
    $docspecialization = trim($_POST['doctorspecilization']);
    
    // Input validation and data sanitization
    $docspecialization = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($docspecialization)));
    
    // Check if the specialization input is not empty
    if (!empty($docspecialization)) {
        $sql = mysqli_prepare($con, "UPDATE doctorSpecilization SET specilization=? WHERE id=?");
        mysqli_stmt_bind_param($sql, "si", $docspecialization, $id);
        
        if (mysqli_stmt_execute($sql)) {
            $_SESSION['msg'] = "Doctor Specialization updated successfully!";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['msg'] = "Error updating specialization!";
            $_SESSION['status'] = "error";
        }
        mysqli_stmt_close($sql);
    } else {
        $_SESSION['msg'] = "Please enter a specialization!";
        $_SESSION['status'] = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Edit Doctor Specialization</title>
    
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
    <div id="app">        
        <?php include('include/sidebar.php');?>
        <?php include('include/footer.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            
            <!-- end: TOP NAVBAR -->
            <div class="main-content" >
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Edit Doctor Specialization</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Doctor Specialization</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Doctor Specialization</h5>
                                            </div>
                                            <div class="panel-body">
                                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
                                                <?php echo htmlentities($_SESSION['msg']="");?></p>    
                                                <form role="form" name="dcotorspcl" method="post" onsubmit="return validateForm();">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">
                                                            Edit Doctor Specialization
                                                        </label>

                                                        <?php 
                                                        $sql = mysqli_prepare($con, "SELECT specilization FROM doctorSpecilization WHERE id=?");
                                                        mysqli_stmt_bind_param($sql, "i", $id);
                                                        mysqli_stmt_execute($sql);
                                                        mysqli_stmt_bind_result($sql, $specilization);
                                                        mysqli_stmt_fetch($sql);
                                                        mysqli_stmt_close($sql);
                                                        ?>        
                                                        <input type="text" name="doctorspecilization" id="specInput" class="form-control" value="<?php echo htmlentities($specilization);?>" >
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                        Update
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end: BASIC EXAMPLE -->
                    <!-- end: SELECT BOXES -->
                </div>
                
            </div>
        </div>
        <!-- start: FOOTER -->
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

        function validateForm() {
            const specialization = document.getElementById("specInput").value.trim();
            if (specialization === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Input Required',
                    text: 'Please enter a specialization.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            return true;
        }

        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == "success"): ?>
        Swal.fire({
            title: 'Success!',
            text: "<?php echo htmlentities($_SESSION['msg']); ?>",
            icon: 'success'
        });
        <?php elseif (isset($_SESSION['status']) && $_SESSION['status'] == "error"): ?>
        Swal.fire({
            title: 'Error!',
            text: "<?php echo htmlentities($_SESSION['msg']); ?>",
            icon: 'error'
        });
        <?php endif; ?>
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>
</html>