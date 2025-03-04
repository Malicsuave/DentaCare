<?php
session_start();
include('include/config.php');
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php");
    exit();
}

// Set headers for Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=doctor_session_logs.xls");

// Start the HTML table
echo '<table border="1">';
echo '<tr>
        <th style="background-color: #f5f5f5; font-weight: bold;">#</th>
        <th style="background-color: #f5f5f5; font-weight: bold;">User ID</th>
        <th style="background-color: #f5f5f5; font-weight: bold;">Username</th>
        <th style="background-color: #f5f5f5; font-weight: bold;">User IP</th>
        <th style="background-color: #f5f5f5; font-weight: bold;">Login Time</th>
        <th style="background-color: #f5f5f5; font-weight: bold;">Logout Time</th>
        <th style="background-color: #f5f5f5; font-weight: bold;">Status</th>
      </tr>';

$sql = mysqli_query($con, "SELECT * FROM doctorslog ORDER BY loginTime DESC");
if (!$sql) {
    die('Query Failed: ' . mysqli_error($con));
}

$cnt = 1;
while($row = mysqli_fetch_array($sql)) {
    $status = ($row['status'] == 1) ? 'Success' : 'Failed';
    echo '<tr>
            <td>'.$cnt.'</td>
            <td>'.htmlspecialchars($row['uid']).'</td>
            <td>'.htmlspecialchars($row['username']).'</td>
            <td>'.htmlspecialchars($row['userip']).'</td>
            <td>'.htmlspecialchars($row['loginTime']).'</td>
            <td>'.htmlspecialchars($row['logout']).'</td>
            <td>'.$status.'</td>
          </tr>';
    $cnt++;
}

echo '</table>';
?>
