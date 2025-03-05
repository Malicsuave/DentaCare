<?php
session_start();
include('include/config.php');
include('include/checklogin.php');

// Input Validation and Data Sanitation
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Authentication and Session Management
check_login();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Authorization and Access Control
// Ensure only authorized users can access this page
if ($_SESSION['role'] !== 'admin') {
    header("Location: error.php");
    exit();
}

// Error Handling & Logging
try {
    // Updating Admin Remark
    if (isset($_POST['update'])) {
        $qid = intval($_GET['id']);
        $adminremark = sanitize_input($_POST['adminremark']);
        $isread = 1;
        $query = mysqli_query($con, "UPDATE tblcontactus SET AdminRemark='$adminremark', IsRead='$isread' WHERE id='$qid'");
        if ($query) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Admin Remark updated successfully.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'read-query.php';
                    }
                });
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Query Details</title>
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
    <div id="app">    <?php include('include/footer.php');?>    
    <?php include('include/sidebar.php');?>
    <div class="app-content">
        <?php include('include/header.php');?>
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Admin | Query Details</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Admin</span></li>
                            <li class="active"><span>Query Details</span></li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Query Details</span></h5>
                            <table class="table table-hover" id="sample-table-1">
                                <tbody>
                                    <?php
                                    $qid = intval($_GET['id']);
                                    $sql = mysqli_query($con, "select * from tblcontactus where id='$qid'");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($sql))
                                    {
                                    ?>
                                    <tr>
                                        <th>Full Name</th>
                                        <td><?php echo sanitize_input($row['fullname']);?></td>
                                    </tr>
                                    <tr>
                                        <th>Email Id</th>
                                        <td><?php echo sanitize_input($row['email']);?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td><?php echo sanitize_input($row['contactno']);?></td>
                                    </tr>
                                    <tr>
                                        <th>Message</th>
                                        <td><?php echo sanitize_input($row['message']);?></td>
                                    </tr>
                                    <?php if($row['AdminRemark'] == ""){?>    
                                    <form name="query" method="post">
                                        <tr>
                                            <th>Admin Remark</th>
                                            <td><textarea name="adminremark" class="form-control" required="true"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>    
                                                <button type="submit" class="btn btn-primary pull-left" name="update">
                                                    Update <i class="fa fa-arrow-circle-right"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </form>                                                
                                    <?php } else {?>                                            
                                    <tr>
                                        <th>Admin Remark</th>
                                        <td><?php echo sanitize_input($row['AdminRemark']);?></td>
                                    </tr>
                                    <tr>
                                        <th>Last Updatation Date</th>
                                        <td><?php echo sanitize_input($row['LastupdationDate']);?></td>
                                    </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/setting.php');?>
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
        });
    </script>
    <script>
        <?php if(isset($_POST['update']) && $query) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: 'Admin Remark updated successfully.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'read-query.php';
                }
            });
        <?php } ?>
    </script>
</body>
</html>
<?php
} catch (Exception $e) {
    error_log($e->getMessage());
    header("Location: error.php");
    exit();
}
?>