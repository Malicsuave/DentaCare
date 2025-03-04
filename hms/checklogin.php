<?php
function check_login()
{
    // Ensure session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in
    if (empty($_SESSION['login'])) {
        // Log the unauthorized access attempt
        error_log("Unauthorized access attempt detected", 3, "/var/log/app_errors.log");

        // Redirect to a custom error page instead of exposing system details
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "../error.php"; // Custom error page
        $_SESSION["login"] = "";
        header("Location: https://$host$uri/$extra");
        exit();
    }
}
?>