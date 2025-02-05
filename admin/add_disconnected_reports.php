<?php
include("header.php"); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $account_number_disconnected = $_POST['account_number_disconnected'];
    $name = $_POST['name'];
    $consumer_status_disconnected = $_POST['consumer_status_disconnected'];
    $area = $_POST['area'];
    $blk_lot = $_POST['blk_lot'];
    $reading = $_POST['reading'];
    $date_disconnected = $_POST['date_disconnected'];
    $billing_month = $_POST['billing_month'];
    $disconnector = $_POST['disconnector'];
    $remarks = $_POST['remarks'];

    // SQL Insert Query
    $query = "INSERT INTO tbl_disconnected (
        account_number_disconnected,
        name,
        consumer_status_disconnected,
        area,
        blk_lot,
        reading,
        date_disconnected,
        billing_month,
        disconnector,
        remarks
    ) VALUES (
        '$account_number_disconnected', '$name', '$consumer_status_disconnected', '$area', '$blk_lot', 
        '$reading', '$date_disconnected', '$billing_month', '$disconnector', '$remarks'
    )";

    // Execute the query
    if ($con->query($query) === TRUE) {
        // Redirect to another page (disconnected_reports.php) upon successful insert
        header("Location: disconnected_reports.php");
        exit(); // Ensure the script stops executing after the redirect
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>
