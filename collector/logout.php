<?php
session_name("collector_session");
session_start();
require_once '../dbcon.php'; // Ensure the correct path

if (isset($_SESSION['collector_username'])) {
    $username = $_SESSION['collector_username'];
    $logout_time = date('Y-m-d H:i:s');

    // Update the last login record with logout time
    $stmt = $con->prepare("UPDATE system_logs SET logout_time = ? 
                          WHERE username = ? AND logout_time IS NULL 
                          ORDER BY login_time DESC LIMIT 1");
    $stmt->bind_param("ss", $logout_time, $username);
    $stmt->execute();
    $stmt->close();
}

// Destroy the session
session_destroy();

// Redirect to login page after logout
header("Location: login.php");
exit();
?>
