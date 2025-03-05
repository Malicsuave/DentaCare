<?php
session_start();
include('include/config.php');

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Input validation and data sanitation
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Set headers for Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=patients_report.xls");

// Fetch data from the tblpatient table
$fdate = sanitize_input($_POST['fromdate']);
$tdate = sanitize_input($_POST['todate']);

$sql = mysqli_prepare($con, "SELECT * FROM tblpatient WHERE date(CreationDate) BETWEEN ? AND ?");
mysqli_stmt_bind_param($sql, 'ss', $fdate, $tdate);
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);

if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

// Output the table headers
echo '<table border="1">';
echo '<thead>';
echo '<tr>';
echo '<th>#</th>';
echo '<th>Patient Name</th>';
echo '<th>Contact Number</th>';
echo '<th>Gender</th>';
echo '<th>Creation Date</th>';
echo '<th>Updation Date</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Output the data rows
$cnt = 1;
while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td>' . $cnt . '</td>';
    echo '<td>' . htmlentities($row['PatientName']) . '</td>';
    echo '<td>' . htmlentities($row['PatientContno']) . '</td>';
    echo '<td>' . htmlentities($row['PatientGender']) . '</td>';
    echo '<td>' . htmlentities($row['CreationDate']) . '</td>';
    echo '<td>' . htmlentities($row['UpdationDate']) . '</td>';
    echo '</tr>';
    $cnt++;
}

echo '</tbody>';
echo '</table>';
?>
