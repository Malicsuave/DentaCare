<?php
session_start();
include('include/config.php');

// Set headers for Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=doctor_logs.xls");

// Fetch data from the doctorslog table
$sql = mysqli_query($con, "SELECT * FROM doctorslog");
if (!$sql) {
    die('Query Failed: ' . mysqli_error($con));
}

// Output the table headers
echo '<table border="1">';
echo '<thead>';
echo '<tr>';
echo '<th>#</th>';
echo '<th>User ID</th>';
echo '<th>Username</th>';
echo '<th>User IP</th>';
echo '<th>Login Time</th>';
echo '<th>Logout Time</th>';
echo '<th>Status</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Output the data rows
$cnt = 1;
while ($row = mysqli_fetch_array($sql)) {
    echo '<tr>';
    echo '<td>' . $cnt . '</td>';
    echo '<td>' . htmlentities($row['uid']) . '</td>';
    echo '<td>' . htmlentities($row['username']) . '</td>';
    echo '<td>' . htmlentities($row['userip']) . '</td>';
    echo '<td>' . htmlentities($row['loginTime']) . '</td>';
    echo '<td>' . htmlentities($row['logout']) . '</td>';
    echo '<td>' . ($row['status'] == 1 ? "Success" : "Failed") . '</td>';
    echo '</tr>';
    $cnt++;
}

echo '</tbody>';
echo '</table>';
?>
