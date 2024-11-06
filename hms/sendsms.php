<?php
session_start();
error_reporting(0);
require_once '../vendor/autoload.php'; // Load Guzzle via Composer autoload
include('include/config.php');
include('include/checklogin.php');
check_login();

use GuzzleHttp\Client;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}

$alert_type = '';
$alert_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phoneNumber = $_POST['phone_number'];
    $messageText = $_POST['message'];

    // Format the phone number to ensure it includes the country code
    if (strpos($phoneNumber, '+') !== 0) {
        $phoneNumber = '+63' . ltrim($phoneNumber, '0'); // Assuming Philippines country code
    }

    if (empty($phoneNumber) || empty($messageText)) {
        $alert_type = 'error';
        $alert_message = "Please fill in all fields.";
    } else {
        try {
            // Set up Guzzle Client
            $client = new Client([
                'base_uri' => 'https://v39vd1.api.infobip.com', // Replace with your Infobip base URL
            ]);

            // Set API Key
            $apiKey = '39eab4b095373258ba4351e7f82a66da-8c639f41-eb30-4e43-baf2-49ee774bd33e'; // Replace with your API Key

            // Prepare message payload
            $smsMessage = [
                'messages' => [
                    [
                        'from' => 'DentaCare', // Sender name
                        'destinations' => [
                            [
                                'to' => $phoneNumber
                            ]
                        ],
                        'text' => $messageText
                    ]
                ]
            ];

            // Send request to Infobip API to send SMS
            $response = $client->post('/sms/2/text/advanced', [
                'headers' => [
                    'Authorization' => 'App ' . $apiKey,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json',
                ],
                'json' => $smsMessage,
            ]);

            // Handle response
            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody(), true);

            if ($statusCode == 200) {
                // Check if the message was successfully sent
                if (isset($responseBody['messages'][0]['status']['groupName']) &&
                    $responseBody['messages'][0]['status']['groupName'] === 'PENDING') {
                    $alert_type = 'success';
                    $alert_message = "SMS sent successfully!";
                } else {
                    $alert_type = 'error';
                    $alert_message = "SMS failed with status: " . $responseBody['messages'][0]['status']['description'];
                }
            } else {
                $alert_type = 'error';
                $alert_message = "Failed to send SMS. Response code: " . $statusCode;
            }

        } catch (Exception $e) {
            $alert_type = 'error';
            $alert_message = "Error sending SMS: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User | Send SMS</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="app"><?php include('include/footer.php');?>	
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Users | Send SMS</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Users</span></li>
                                <li class="active"><span>Send SMS</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Send <span class="text-bold">SMS</span></h5>
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Enter recipient's phone number" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" name="message" placeholder="Enter message text" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send SMS</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php include('include/setting.php');?>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();

            <?php if (!empty($alert_message)) { ?>
                Swal.fire({
                    icon: '<?php echo $alert_type; ?>',
                    title: '<?php echo ucfirst($alert_type); ?>',
                    text: '<?php echo $alert_message; ?>'
                });
            <?php } ?>
        });
    </script>
</body>
</html>
