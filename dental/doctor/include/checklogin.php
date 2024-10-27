<?php
function check_login()
{
    if (strlen($_SESSION['login']) == 0) {	
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "dentacare/dental/user-login.php";		
        header("Location: http://$host/$extra");
        exit(); // Ensure no further code is executed after redirection
    }
}

?>