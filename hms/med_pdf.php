<?php
include ('include/config.php');
require_once('vendor/tcpdf/tcpdf.php'); // Make sure the path is correct based on your structure

function generatePDF($patientDetails, $medicalHistory) {
    // Create new PDF document
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Clinic Name');
    $pdf->SetTitle('Medical History');
    $pdf->SetSubject('Patient Medical History');
    $pdf->SetKeywords('TCPDF, PDF, medical, history, patient');

    // Set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Medical History', 'Your Clinic Name');

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

    // Create the content for the PDF
    $html = '<h1>Patient Details</h1>';
    $html .= '<strong>Name:</strong> ' . $patientDetails['PatientName'] . '<br>';
    $html .= '<strong>Email:</strong> ' . $patientDetails['PatientEmail'] . '<br>';
    $html .= '<strong>Mobile Number:</strong> ' . $patientDetails['PatientContno'] . '<br>';
    $html .= '<strong>Address:</strong> ' . $patientDetails['PatientAdd'] . '<br>';
    $html .= '<strong>Gender:</strong> ' . $patientDetails['PatientGender'] . '<br>';
    $html .= '<strong>Age:</strong> ' . $patientDetails['PatientAge'] . '<br>';
    $html .= '<strong>Registration Date:</strong> ' . $patientDetails['CreationDate'] . '<br>';
    
    // Medical history table
    $html .= '<h2>Medical History</h2>';
    $html .= '<table border="1" cellpadding="5"><tr>
                <th>#</th>
                <th>Blood Pressure</th>
                <th>Weight</th>
                <th>Blood Sugar</th>
                <th>Body Temperature</th>
                <th>Medical Prescription</th>
                <th>Chronic Conditions</th>
                <th>Previous Dental Treatments</th>
                <th>Visit Date</th>
              </tr>';
              
    $cnt = 1;
    foreach ($medicalHistory as $history) {
        $html .= '<tr>
                    <td>' . $cnt++ . '</td>
                    <td>' . $history['BloodPressure'] . '</td>
                    <td>' . $history['Weight'] . '</td>
                    <td>' . $history['BloodSugar'] . '</td>
                    <td>' . $history['Temperature'] . '</td>
                    <td>' . $history['MedicalPres'] . '</td>
                    <td>' . $history['ChronicCond'] . '</td>
                    <td>' . $history['PrevDen'] . '</td>
                    <td>' . $history['CreationDate'] . '</td>
                  </tr>';
    }
    $html .= '</table>';

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('medical_history.pdf', 'I'); // Output the PDF inline in the browser
}


?>