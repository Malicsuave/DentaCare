<?php
session_start();
include('../include/config.php');
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php");
    exit();
}

require_once('../TCPDF-main/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DentaCare');
$pdf->SetTitle('Doctor Session Logs');

// Set header data
$pdf->SetHeaderData('', 0, 'DentaCare', 'Doctor Session Logs', array(0, 64, 255), array(0, 64, 128));

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
$pdf->SetFont('helvetica', '', 10);

// Add HTML content
$html = '<h1>Doctor Session Logs</h1>';
$html .= '<table border="1" cellpadding="4">
            <tr style="background-color: #f5f5f5; font-weight: bold;">
                <th>#</th>
                <th>User ID</th>
                <th>Username</th>
                <th>User IP</th>
                <th>Login Time</th>
                <th>Logout Time</th>
                <th>Status</th>
            </tr>';

$sql = mysqli_query($con, "SELECT * FROM doctorslog ORDER BY loginTime DESC");
$cnt = 1;
while($row = mysqli_fetch_array($sql)) {
    $status = ($row['status'] == 1) ? 'Success' : 'Failed';
    $html .= '<tr>
                <td>'.$cnt.'</td>
                <td>'.$row['uid'].'</td>
                <td>'.$row['username'].'</td>
                <td>'.$row['userip'].'</td>
                <td>'.$row['loginTime'].'</td>
                <td>'.$row['logout'].'</td>
                <td>'.$status.'</td>
              </tr>';
    $cnt++;
}

$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('doctor_session_logs.pdf', 'I');
?>
