<?php
session_start();
$_SESSION['msg'] = "Payment cancelled.";
$_SESSION['msg_type'] = "error";
header("Location: book-appointment.php");
exit();
?>