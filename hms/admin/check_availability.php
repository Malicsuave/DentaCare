<?php
session_start();
require_once("include/config.php");

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Input validation and data sanitation
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if (!empty($_POST["emailid"])) {
    $email = sanitize_input($_POST["emailid"]);

    $result = mysqli_prepare($con, "SELECT docEmail FROM doctors WHERE docEmail=?");
    mysqli_stmt_bind_param($result, 's', $email);
    mysqli_stmt_execute($result);
    mysqli_stmt_store_result($result);
    $count = mysqli_stmt_num_rows($result);

    if ($count > 0) {
        echo "<span style='color:red'> Email already exists.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color:green'> Email available for Registration.</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }
    mysqli_stmt_close($result);
}
?>
