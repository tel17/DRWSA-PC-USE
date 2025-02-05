<?php
include("header.php"); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
  
    $name = $_POST['name'];
    $area = $_POST['area'];
    $block_lot = $_POST['block_lot'];
    $old_reading = $_POST['old_reading'];
    $new_reading = $_POST['new_reading'];
    $serial_number = $_POST['serial_number'];
    $date_filed = $_POST['date_filed'];
    $year = $_POST['year'];
    $remarks = $_POST['remarks'];
    $mid = $_POST['mid'];
   
    // SQL Insert Query
    $query = "INSERT INTO tbl_meter_replacement (
         name, area, block_lot, old_reading, new_reading, serial_number, date_filed, year, 
        remarks, mid
    ) VALUES (
         '$name', '$area', '$block_lot', '$old_reading', '$new_reading', '$serial_number', '$date_filed', '$year', 
        '$remarks', '$mid'
    )";

    // Execute the query
    if ($con->query($query) === TRUE) {
        header("Location: meter_replacement.php");
        exit();
    } else {
        // If there's an error in the query
        $message = "Error: " . $con->error;
        $alert_type = "error";
    }
}
?>