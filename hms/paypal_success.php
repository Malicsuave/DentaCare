<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

require '../vendor/autoload.php'; // Ensure PayPal SDK is loaded

use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

$clientId = 'AY-gfl-uXBUXsyYEhwRyW6p-wgZv_GBeZsV8AEWLgj8NOOcIkD-xPH--HlcwESe4v9HA3jW68NhXRU1I';
$clientSecret = 'ENjXYuxvihqYfX7tWwt84K4OL1PAtJlz8N4Bp303H-MAhV8bTGXGg31YHZc6B-twIMxjt6UYEXU9-CHs';

$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $request = new OrdersCaptureRequest($token);
    $request->prefer('return=representation');

    try {
        $response = $client->execute($request);

        if ($response->result->status == 'COMPLETED') {
            if (isset($_SESSION['id'], $_SESSION['Doctorspecialization'], $_SESSION['doctor'], $_SESSION['fees'], $_SESSION['appdate'], $_SESSION['apptime'])) {
                $userid = $_SESSION['id'];
                $specilization = $_SESSION['Doctorspecialization'];
                $doctorid = $_SESSION['doctor'];
                $fees = $_SESSION['fees'];
                $appdate = $_SESSION['appdate'];
                $time = $_SESSION['apptime'];
                $userstatus = 1;
                $docstatus = 1;

                // Insert payment details into DB
                $stmt = $con->prepare("INSERT INTO payments (user_id, amount, transaction_id, status) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("idss", $userid, $fees, $response->result->id, $response->result->status);
                $stmt->execute();
                $stmt->close();

                // Insert appointment details
                $stmt = $con->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $specilization, $doctorid, $userid, $fees, $appdate, $time, $userstatus, $docstatus);
                $stmt->execute();
                $stmt->close();

                $_SESSION['msg'] = "Payment and appointment booking successful!";
                $_SESSION['msg_type'] = "success";
                header("Location: success_page.php"); // Redirect to success page
                exit();
            } else {
                $_SESSION['msg'] = "Session variables not set.";
                $_SESSION['msg_type'] = "error";
                header("Location: book-appointment.php");
                exit();
            }
        } else {
            $_SESSION['msg'] = "Payment failed. Please try again.";
            $_SESSION['msg_type'] = "error";
            header("Location: book-appointment.php");
            exit();
        }
    } catch (Exception $ex) {
        $_SESSION['msg'] = "Error processing payment: " . $ex->getMessage();
        $_SESSION['msg_type'] = "error";
        header("Location: book-appointment.php");
        exit();
    }
} else {
    $_SESSION['msg'] = "Payment cancelled.";
    $_SESSION['msg_type'] = "error";
    header("Location: book-appointment.php");
    exit();
}



