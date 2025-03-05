<?php 
require_once("include/config.php");

// Input Validation and Data Sanitation
if (!empty($_POST["email"])) {
    $email = htmlspecialchars(trim($_POST["email"]));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span style='color:red'> Invalid email format.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
        exit();
    }

    // Secure Data Storage & Encryption
    $stmt = $con->prepare("SELECT PatientEmail FROM tblpatient WHERE PatientEmail=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;

    if ($count > 0) {
        echo "<span style='color:red'> Email already exists.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> Email available for Registration.</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }

    $stmt->close();
}
?>
