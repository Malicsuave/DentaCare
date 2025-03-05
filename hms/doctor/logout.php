<?php
session_start();
include('include/config.php');

// Authentication and Session Management
if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}

date_default_timezone_set('Asia/Manila');
$ldate = date('d-m-Y h:i:s A', time());

// Secure Data Storage & Encryption
$stmt = $con->prepare("UPDATE doctorslog SET logout = ? WHERE uid = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("si", $ldate, $_SESSION['id']);
$stmt->execute();
$stmt->close();

session_unset();
session_destroy();

$_SESSION['errmsg'] = "You have successfully logged out.";
?>
<script language="javascript">
document.location="../../index.php";
</script>
