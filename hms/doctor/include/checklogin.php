<?php
session_start(); // Make sure session is started before checking

function check_login()
{
    // Check if the 'login' session variable is empty or not set
    if (empty($_SESSION['dlogin'])) {	
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "dentacare/hms/doctor/index.php";
        
        // Redirect and ensure no further code runs
        header("Location: http://$host/$extra");
        exit();
    }
}
?>
