<?php
session_start();
require_once '../dbcon.php'; // Ensure this path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username && $password) {
        // Query to check if username exists
        $stmt = $con->prepare("SELECT username, password FROM tbl_collectors_profile WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if username exists and password matches
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Use password_verify to check if entered password matches the hashed password
            if (password_verify($password, $row['password'])) {
                $_SESSION['collector_username'] = $row['username']; // Store username in session
                // Store success message in session
                $_SESSION['success'] = "Login Successfully!";
                header("Location: dashboard.php"); // Redirect to dashboard.php
                exit();
            } else {
                $_SESSION['error'] = "Username and password do not match."; // Store error in session
            }
        } else {
            $_SESSION['error'] = "Invalid username."; // Store error in session
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Please fill in all fields."; // Store error in session
    }

    // Redirect to login page without passing error in URL
    header("Location: login.php");
    exit();
}
