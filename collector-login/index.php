<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['collector_username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
