<?php
session_start();
require_once('../TCPDF-main/tcpdf.php'); // Adjusted path

// Authentication and Session Management
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DentaCare');
$pdf->SetTitle('User Session Logs');
$pdf->SetSubject('Session Logs');

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

// Fetch data from the database with error handling
include('../include/config.php'); // Ensure this path is correct

// Prepare the SQL statement
$sql = $con->prepare("SELECT * FROM userlog");
if (!$sql) {
    die('Query Failed: ' . $con->error);
}
$sql->execute();
$result = $sql->get_result();

// Create the HTML for the table
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
$html .= '<tr><th>#</th><th>User ID</th><th>Username</th><th>User IP</th><th>Login Time</th><th>Logout Time</th><th>Status</th></tr>';

$cnt = 1;
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $cnt . '</td>';
    $html .= '<td>' . htmlentities($row['uid']) . '</td>'; // Adjust this if user ID column name differs
    $html .= '<td>' . htmlentities($row['username']) . '</td>';
    $html .= '<td>' . htmlentities($row['userip']) . '</td>';
    $html .= '<td>' . htmlentities($row['loginTime']) . '</td>';
    $html .= '<td>' . htmlentities($row['logout']) . '</td>';
    $html .= '<td>' . ($row['status'] == 1 ? 'Success' : 'Failed') . '</td>';
    $html .= '</tr>';
    $cnt++;
}
$html .= '</table>';

$sql->close();
$con->close(); // Close the database connection

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
$pdf->Output('user_session_logs.pdf', 'I'); // Output to browser
?>
