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

if (isset($_POST['submit'])) {
    $specialization = trim($_POST['doctorspecilization']);
    if (preg_match('/^[a-zA-Z0-9\s]+$/', $specialization)) { // Server-side validation
        $sql = mysqli_query($con, "INSERT INTO doctorSpecilization(specilization) VALUES ('$specialization')");
        $_SESSION['add_msg'] = "Doctor Specialization added successfully!";
    } else {
        $_SESSION['add_msg'] = "Please enter a valid specialization containing only letters, numbers, or spaces.";
    }
}

if (isset($_GET['del']) && isset($_GET['id'])) {
    mysqli_query($con, "DELETE FROM doctorSpecilization WHERE id = '" . $_GET['id'] . "'");
    $_SESSION['del_msg'] = "Specialization deleted successfully!";
    header("Location: doctor-specilization.php"); // Redirect to avoid re-triggering deletion
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Dentist Specialization</title>
	
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
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Add Dentist Specialization</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Admin</span></li>
                                <li class="active"><span>Add Dentist Specialization</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Dentist Specialization</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="dcotorspcl" method="post" onsubmit="return validateForm();">
                                                    <div class="form-group">
                                                        <label for="doctorspecilization">Dentist Specialization</label>
                                                        <input type="text" id="doctorspecilization" name="doctorspecilization" class="form-control" placeholder="Enter Doctor Specialization">
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Manage Dentist Specialization Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Dentist Specialization</span></h5>
                                        <table class="table table-hover" id="sample-table-1">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>Specialization</th>
                                                    <th class="hidden-xs">Creation Date</th>
                                                    <th>Updation Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = mysqli_query($con, "SELECT * FROM doctorSpecilization");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <tr>
                                                        <td class="center"><?php echo $cnt; ?>.</td>
                                                        <td class="hidden-xs"><?php echo $row['specilization']; ?></td>
                                                        <td><?php echo $row['creationDate']; ?></td>
                                                        <td><?php echo $row['updationDate']; ?></td>
                                                        <td>
   <a href="edit-doctor-specialization.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" title="Edit">
    <i class="fa fa-pencil"></i> Edit
</a>

<a href="javascript:void(0);" class="btn btn-transparent btn-xs" onclick="confirmDelete(<?php echo $row['id']; ?>)" title="Remove">
    <i class="fa fa-times fa fa-white"></i> Remove
</a>
                                                        </td>
                                                    </tr>
                                                <?php $cnt = $cnt + 1; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <?php include('include/setting.php'); ?>
        </div>
        <?php include('include/footer.php'); ?>
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
		</script>
		 <?php if (!empty($_SESSION['add_msg'])) { ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: "<?php echo $_SESSION['add_msg']; ?>",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    <?php unset($_SESSION['add_msg']); ?>
<?php } elseif (!empty($_SESSION['del_msg'])) { ?>
    <script>
        Swal.fire({
            title: 'Deleted!',
            text: "<?php echo $_SESSION['del_msg']; ?>",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    <?php unset($_SESSION['del_msg']); ?>
<?php } ?>

<!-- Delete Confirmation Script -->
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "doctor-specilization.php?id=" + id + "&del=delete";
            }
        });
    }
</script>

<!-- Client-side Validation Script -->
<script>
    function validateForm() {
        const specialization = document.getElementById('doctorspecilization').value.trim();
        const validPattern = /^[a-zA-Z0-9\s]+$/;

        if (!validPattern.test(specialization)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Input',
                text: 'Please enter a valid specialization containing only letters, numbers, or spaces.',
                confirmButtonText: 'OK'
            });
            return false;
        }
        return true;
    }
</script>
		
	</body>
</html>
