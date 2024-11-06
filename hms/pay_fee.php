<?php
session_start();
require_once '../vendor/autoload.php';  // Updated path to the correct location
require_once 'include/config.php';

use Stripe\StripeClient;

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: error.php");
    exit();
}

// Check if appointment data exists in the session
if (!isset($_SESSION['appointment_data'])) {
    $_SESSION['msg'] = 'Invalid request. Please try booking an appointment again.';
    $_SESSION['msg_type'] = 'error';
    header("Location: book-appointment.php");
    exit();
}

$appointment = $_SESSION['appointment_data'];

// Set Stripe secret key using StripeClient
$stripeClient = new StripeClient('sk_test_51QG2QFLwfEoMpz35fXqLusItqUUavw2mahFfT03EB5OURzjKQWcl0sQieR4ab6SCh067hIji0ima4Whp938FqPty00jGgT4EC2');

// Create a new Stripe Checkout Session
try {
    $checkout_session = $stripeClient->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'php', // Changed currency to PHP
                'product_data' => [
                    'name' => 'Consultancy Fees - ' . htmlspecialchars($appointment['doctorSpecialization']),
                ],
                'unit_amount' => $appointment['consultancyFees'] * 100, // Amount in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/dentacare/hms/pay_fee.php?success=true',
        'cancel_url' => 'http://localhost/dentacare/hms/pay_fee.php?success=false',
    ]);

    // Redirect to Stripe Checkout page
    header("Location: " . $checkout_session->url);
    exit();
} catch (Exception $e) {
    $_SESSION['msg'] = 'Error creating payment session: ' . $e->getMessage();
    $_SESSION['msg_type'] = 'error';
    header("Location: book-appointment.php");
    exit();
}

// Handle success and failure after returning from Stripe
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    // Payment was successful, save appointment data to the database
    $stmt = $con->prepare("INSERT INTO appointment (doctorSpecialization, doctorId, userId, consultancyFees, appointmentDate, appointmentTime, userStatus, doctorStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $appointment['doctorSpecialization'], $appointment['doctorId'], $appointment['userId'], $appointment['consultancyFees'], $appointment['appointmentDate'], $appointment['appointmentTime'], $appointment['userStatus'], $appointment['doctorStatus']);

    if ($stmt->execute()) {
        $_SESSION['msg'] = 'Your appointment has been successfully booked and payment was successful.';
        $_SESSION['msg_type'] = 'success';
        unset($_SESSION['appointment_data']); // Clear session appointment data

        // Send email notification
        $to = $_SESSION['email']; // Assuming user's email is stored in session
        $subject = "Appointment Booking Confirmation";
        $message = "Dear User,\n\nYour appointment has been successfully booked and the payment was completed.\n\nDetails:\n";
        $message .= "Doctor Specialization: " . htmlspecialchars($appointment['doctorSpecialization']) . "\n";
        $message .= "Consultancy Fees: PHP " . number_format($appointment['consultancyFees'], 2) . "\n";
        $message .= "Appointment Date: " . $appointment['appointmentDate'] . "\n";
        $message .= "Appointment Time: " . $appointment['appointmentTime'] . "\n\n";
        $message .= "Thank you for using our service.\n\nBest Regards,\nDentacare Team";

        $headers = "From: noreply@dentacare.com";

        // Use mail function to send the email
        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['msg'] .= ' A confirmation email has been sent.';
        } else {
            $_SESSION['msg'] .= ' However, the email notification could not be sent.';
        }
    } else {
        $_SESSION['msg'] = 'Error booking appointment after payment: ' . $stmt->error;
        $_SESSION['msg_type'] = 'error';
    }

    $stmt->close();
    // Redirect to the dashboard after successful payment
    header("Location: dashboard.php");
    exit();
} elseif (isset($_GET['success']) && $_GET['success'] == 'false') {
    // Payment was cancelled
    $_SESSION['msg'] = 'Payment was cancelled. Please try again.';
    $_SESSION['msg_type'] = 'error';
    header("Location: book-appointment.php");
    exit();
}
?>
