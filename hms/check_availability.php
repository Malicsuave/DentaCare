<?php 
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict',
]);

require_once("include/config.php");

if (!empty($_POST["email"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the SQL statement
        $stmt = $con->prepare("SELECT email FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                echo "<span style='color:red'> Email already exists.</span>";
                echo "<script>$('#submit').prop('disabled',true);</script>";
            } else {
                echo "<span style='color:green'> Email available for Registration.</span>";
                echo "<script>$('#submit').prop('disabled',false);</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<span style='color:red'> Error preparing statement.</span>";
        }
    } else {
        echo "<span style='color:red'> Invalid email format.</span>";
    }
}
