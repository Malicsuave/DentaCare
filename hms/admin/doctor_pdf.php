<?php
session_start();
require_once('../TCPDF-main/tcpdf.php'); 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DentaCare');
$pdf->SetTitle('Doctor Session Logs');
$pdf->SetSubject('Session Logs');

// Set header data
$pdf->SetHeaderData('', 0, 'DentaCare', 'Doctor Session Logs', array(0, 64, 255), array(0, 64, 128)); // Header title and subtitle

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Fetch data from the database
include('../include/config.php'); // Ensure this path is correct
$sql = mysqli_query($con, "SELECT * FROM doctorslog");
$html = '<h1>Doctor Session Logs</h1>';
$html .= '<table border="1" cellpadding="5">';
$html .= '<tr><th>#</th><th>User ID</th><th>Username</th><th>User IP</th><th>Login Time</th><th>Logout Time</th><th>Status</th></tr>';

$cnt = 1;
while ($row = mysqli_fetch_array($sql)) {
    $html .= '<tr>';
    $html .= '<td>' . $cnt . '</td>';
    $html .= '<td>' . $row['uid'] . '</td>';
    $html .= '<td>' . $row['username'] . '</td>';
    $html .= '<td>' . $row['userip'] . '</td>';
    $html .= '<td>' . $row['loginTime'] . '</td>';
    $html .= '<td>' . $row['logout'] . '</td>';
    $html .= '<td>' . ($row['status'] == 1 ? 'Success' : 'Failed') . '</td>';
    $html .= '</tr>';
    $cnt++;
}
$html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
$pdf->Output('doctor_session_logs.pdf', 'I'); // Output to browser
?>
 