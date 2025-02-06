<?php
include("header.php"); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $account_number_disconnected = $_POST['account_number_disconnected'];
    $name = $_POST['name'];
    $area = $_POST['area'];
    $blk_lot = $_POST['blk_lot'];
    $reading = $_POST['reading'];
    $date_disconnected = $_POST['date_disconnected'];
    $month = $_POST['month'];
    $disconnector = $_POST['disconnector'];
    $remarks = $_POST['remarks'];
    $year = $_POST['year'];

    // SQL Insert Query
    $query = "INSERT INTO tbl_disconnected (
        account_number_disconnected, name,  area, blk_lot, 
        reading, date_disconnected, month, year, disconnector, remarks
    ) VALUES (
        '$account_number_disconnected', '$name', '$area', '$blk_lot', 
        '$reading', '$date_disconnected', '$month', '$year', '$disconnector', '$remarks'
    )";

    // Execute the query
    if ($con->query($query) === TRUE) {
        // Redirect upon success
        header("Location: disconnected_reports.php");
        exit();
    } else {
        echo "Error: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>
