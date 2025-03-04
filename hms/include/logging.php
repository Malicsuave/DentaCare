<?php
function log_action($con, $uid, $username, $action, $status) {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $time = date('Y-m-d H:i:s');

    $stmt = $con->prepare("INSERT INTO userlog (uid, username, userip, loginTime, action, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $uid, $username, $user_ip, $time, $action, $status);
    $stmt->execute();
    $stmt->close();
}


?>