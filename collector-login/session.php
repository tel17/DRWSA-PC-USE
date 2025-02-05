<?php
session_name("collector_session"); // Set unique session for collectors
session_start();

if (!isset($_SESSION['collector_id'])) {
    $_SESSION['error'] = "Please log in first!";
    header("Location: login.php");
    exit();
}

$collector_id = $_SESSION['collector_id'];
$collector_name = $_SESSION['collector_name'];
?>
