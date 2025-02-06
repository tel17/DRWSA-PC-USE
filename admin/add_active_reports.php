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
    $month = $_POST['month'] . "-01"; // Add day to match date format (YYYY-MM-01)
    $maintenance = $_POST['maintenance'];
    $remarks = $_POST['remarks'];
    $year = $_POST['year'];

    // SQL Insert Query
    $query = "INSERT INTO tbl_active (account_number_active, name, consumer_status_active, area, blk_lot, reading, date_reconnected, month, maintenance, remarks, year) 
              VALUES ('$account_number_active', '$name', '$consumer_status_active', '$area', '$blk_lot', '$reading', '$date_reconnected', '$month', '$maintenance', '$remarks', '$year')";

    // Execute the query
    if ($con->query($query) === TRUE) {
        // Redirect to another page (active_reports.php) upon successful insert
        header("Location: active_reports.php");
        exit(); // Stop script execution after redirect
    } else {
        echo "Error: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>
