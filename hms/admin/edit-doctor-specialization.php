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
    
    // Check if the specialization input is not empty
    if (!empty($docspecialization)) {
        $sql = mysqli_query($con, "UPDATE doctorSpecilization SET specilization='$docspecialization' WHERE id='$id'");
        
        if ($sql) {
            $_SESSION['msg'] = "Doctor Specialization updated successfully!";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['msg'] = "Error updating specialization!";
            $_SESSION['status'] = "error";
        }
    } else {
        $_SESSION['msg'] = "Please enter a specialization!";
        $_SESSION['status'] = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Edit Dentist Specialization</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
                            <h1 class="mainTitle">Admin | Edit Dentist Specialization</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>Admin</span></li>
                            <li class="active"><span>Edit Dentist Specialization</span></li>
                        </ol>
                    </div>
                </section>
                
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Edit Dentist Specialization</h5>
                                </div>
                                <div class="panel-body">
                                    <form role="form" name="dcotorspcl" method="post" onsubmit="return validateForm()">
                                        <div class="form-group">
                                            <label for="specInput">Edit Dentist Specialization</label>
                                            <?php 
                                            $sql = mysqli_query($con, "SELECT * FROM doctorSpecilization WHERE id='$id'");
                                            while ($row = mysqli_fetch_array($sql)) { ?>   
                                                <input type="text" id="specInput" name="doctorspecilization" class="form-control" value="<?php echo $row['specilization']; ?>" >
                                            <?php } ?>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-o btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != ''): ?>
                    <script>
                        Swal.fire({
                            icon: '<?php echo $_SESSION['status']; ?>',
                            title: '<?php echo $_SESSION['status'] == "success" ? "Success" : "Error"; ?>',
                            text: '<?php echo $_SESSION['msg']; ?>',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed && '<?php echo $_SESSION['status']; ?>' === 'success') {
                                window.location.href = 'doctor-specilization.php';
                            }
                        });
                    </script>
                    <?php unset($_SESSION['msg'], $_SESSION['status']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
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
</script>
</body>
</html>
