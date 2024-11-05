<?php
session_start();
include('include/config.php');
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Set headers for Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=patients_report.xls");

// Fetch data from the tblpatient table
$fdate = $_POST['fromdate']; // Assuming these values are being passed via a form
$tdate = $_POST['todate'];

$sql = mysqli_query($con, "SELECT * FROM tblpatient WHERE date(CreationDate) BETWEEN '$fdate' AND '$tdate'"); // Adjust query as needed
if (!$sql) {
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
while ($row = mysqli_fetch_array($sql)) {
    echo '<tr>';
    echo '<td>' . $cnt . '</td>';
    echo '<td>' . htmlentities($row['PatientName']) . '</td>'; // Adjust this if the Patient Name column name differs
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
