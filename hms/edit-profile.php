<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
$target_dir = "uploads/"; 
check_login();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Initialize message variable
$msg = "";

// Handle profile picture upload
// Handle profile picture upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $$target_dir = "uploads/"; // Ensure this directory exists and is writable

    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

    // Check if the uploads directory is writable
    if (!is_writable($target_dir)) {
        die("The uploads directory is not writable.");
    }

    // Check if the file is an actual image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Update the user's profile picture path in the database
            $sql = mysqli_query($con, "UPDATE users SET profile_picture='$target_file' WHERE id='" . $_SESSION['id'] . "'");
            if ($sql) {
                $msg = "Profile picture updated successfully.";
                $_SESSION['profile_picture'] = $target_file; // Update session variable
            } else {
                $msg = "Error updating profile picture.";
            }
        } else {
            $msg = "Error uploading file.";
        }
    } else {
        $msg = "File is not an image.";
    }
}


// Handle profile information update
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    // Use the uploaded picture if present
    $profilepic = $_SESSION['profile_picture'] ?? null; // Default to current picture

    // Update user information in the database
    $sql = mysqli_query($con, "UPDATE users SET fullName='$fname', address='$address', city='$city', gender='$gender', profile_picture='$profilepic' WHERE id='" . $_SESSION['id'] . "'");
    if ($sql) {
        $msg = "Your Profile updated Successfully";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Edit Profile</title>
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
        <div class="app-content">
            <?php include('include/header.php');?>

            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">User | Edit Profile</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>User </span>
                                </li>
                                <li class="active">
                                    <span>Edit Profile</span>
                                </li>
                            </ol>
                        </div>
                    </section>

                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: green; font-size:18px;">
                                    <?php if($msg) { echo htmlentities($msg);}?> 
                                </h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Profile</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php 
                                                $sql = mysqli_query($con, "SELECT * FROM users WHERE id='" . $_SESSION['id'] . "'");
                                                while ($data = mysqli_fetch_array($sql)) {
                                                ?>
                                                <h4><?php echo htmlentities($data['fullName']);?>'s Profile</h4>
                                                <p><b>Profile Reg. Date: </b><?php echo htmlentities($data['regDate']);?></p>
                                                <?php if ($data['updationDate']) {?>
                                                    <p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']);?></p>
                                                <?php } ?>
                                                <hr />
                                                <form role="form" name="edit" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="fname">User Name</label>
                                                        <input type="text" name="fname" class="form-control" value="<?php echo htmlentities($data['fullName']);?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="profile_picture">Profile Picture</label>
                                                        <input type="file" name="profile_picture" class="form-control" accept="image/*">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <textarea name="address" class="form-control"><?php echo htmlentities($data['address']);?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input type="text" name="city" class="form-control" required="required" value="<?php echo htmlentities($data['city']);?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" class="form-control" required="required">
                                                            <option value="<?php echo htmlentities($data['gender']);?>"><?php echo htmlentities($data['gender']);?></option>
                                                            <option value="male">Male</option>	
                                                            <option value="female">Female</option>	
                                                            <option value="other">Other</option>	
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">User Email</label>
                                                        <input type="email" name="uemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']);?>">
                                                        <a href="change-emaild.php">Update your email id</a>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Update</button>
                                                </form>
                                                <?php } ?>
                                            </div>
                                        </div>
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
            $(document).ready(function() {
                Main.init();
                FormElements.init();
            });
        </script>
		  <script>
            $(document).ready(function() {
                // Check if there is a message to display
                var msg = "<?php echo $msg; ?>";
                if (msg) {
                    // Show SweetAlert based on the message
                    Swal.fire({
                        title: 'Notification',
                        text: msg,
                        icon: msg.includes('Error') ? 'error' : 'success',
                        confirmButtonText: 'OK'
                    });
                }
            });
        </script>
    </div>
</body>
</html>
