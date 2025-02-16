<?php
include('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $readingId = $_POST['readingId'];
    $orNumber = $_POST['orNumber'];
    $remarks = $_POST['remarks'];
    $paymentStatus = $_POST['paymentStatus'];

    // Validate input
    if (empty($readingId) || empty($orNumber) || empty($paymentStatus)) {
        echo 'error';
        exit;
    }

    // Prepare update query
    $query = "UPDATE tbl_reading SET 
              payment_status = ?,
              or_number = ?,
              remarks = ?
              WHERE id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param('sssi', $paymentStatus, $orNumber, $remarks, $readingId);

    // Execute query
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
} else {
    echo 'error';
}
?>
