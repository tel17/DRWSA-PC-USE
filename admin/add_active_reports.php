<?php
include("header.php"); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $account_number_active = $_POST['account_number_active'];
    $name = $_POST['name'];
    $consumer_status_active = $_POST['consumer_status_active'];
    $area = $_POST['area'];
    $blk_lot = $_POST['blk_lot'];
    $reading = $_POST['reading'];
    $date_reconnected = $_POST['date_reconnected'];
    $billing_month = $_POST['billing_month'] . "-01"; // Add day to match date format (YYYY-MM-01)
    $maintenance = $_POST['maintenance'];
    $remarks = $_POST['remarks'];

    // SQL Insert Query
    $query = "INSERT INTO tbl_active (
        account_number_active,
        name,
        consumer_status_active,
        area,
        blk_lot,
        reading,
        date_reconnected,
        billing_month,
        maintenance,
        remarks
    ) VALUES (
        '$account_number_active', '$name', '$consumer_status_active', '$area', '$blk_lot', 
        '$reading', '$date_reconnected', '$billing_month', '$maintenance', '$remarks'
    )";

    // Execute the query
    if ($con->query($query) === TRUE) {
        // Redirect to another page (active_reports.php) upon successful insert
        header("Location: active_reports.php");
        exit(); // Ensure the script stops executing after the redirect
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>
