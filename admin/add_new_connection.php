<?php
include("header.php"); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $account_number_new_connection = $_POST['account_number_new_connection'];
    $name = $_POST['name'];
    $area = $_POST['area'];
    $blk_lot = $_POST['blk_lot'];
    $meter = $_POST['meter'];
    $date_connect = $_POST['date_connect'];
    $month = $_POST['month'];
    $new_connect_maintenance = $_POST['new_connect_maintenance'];
    $remarks = $_POST['remarks'];

    // SQL Insert Query
    $query = "INSERT INTO tbl_newconnection (
        account_number_new_connection,
        name,
        area,
        blk_lot,
        meter,
        date_connect,
        month,
        new_connect_maintenance,
        remarks
    ) VALUES (
        '$account_number_new_connection', '$name', '$area', '$blk_lot', 
        '$meter', '$date_connect', '$month', '$new_connect_maintenance', '$remarks'
    )";

    // Execute the query
    if ($con->query($query) === TRUE) {
        // Redirect to another page (new_connection_reports.php) upon successful insert
        header("Location: new_connection_reports.php");
        exit(); // Ensure the script stops executing after the redirect
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>
