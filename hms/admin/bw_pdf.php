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

require_once('../TCPDF-main/tcpdf.php'); // Update with the correct path

$fdate = sanitize_input($_POST['fromdate']);
$tdate = sanitize_input($_POST['todate']);

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DentaCare');
$pdf->SetTitle('Patients Report');
$pdf->SetSubject('Patients Report');

// Set header data
$pdf->SetHeaderData('', 0, 'DentaCare', 'User Session Logs', array(0, 64, 255), array(0, 64, 128)); // Header title and subtitle

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

// Add HTML content
$html = '<h1>User Session Logs</h1>';
$html .= '<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #4CAF50; /* Green header */
        color: white;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2; /* Zebra stripe */
    }
    tr:hover {
        background-color: #ddd; /* Highlight on hover */
    }
</style>';

$html .= '<table>';
$html .= '<tr>
            <th>#</th>
            <th>Patient Name</th>
            <th>Contact Number</th>
            <th>Gender</th>
            <th>Creation Date</th>
            <th>Updation Date</th>
          </tr>';

$sql = mysqli_prepare($con, "SELECT * FROM tblpatient WHERE date(CreationDate) BETWEEN ? AND ?");
mysqli_stmt_bind_param($sql, 'ss', $fdate, $tdate);
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);
$cnt = 1;

// Add table data
while ($row = mysqli_fetch_array($result)) {
    $html .= '<tr>
                <td>' . $cnt . '</td>
                <td>' . htmlentities($row['PatientName']) . '</td>
                <td>' . htmlentities($row['PatientContno']) . '</td>
                <td>' . htmlentities($row['PatientGender']) . '</td>
                <td>' . htmlentities($row['CreationDate']) . '</td>
                <td>' . htmlentities($row['UpdationDate']) . '</td>
              </tr>';
    $cnt++;
}

$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Finalize and output the PDF
$pdf->Output('patients_report.pdf', 'I'); // Download the PDF
exit;
?>
