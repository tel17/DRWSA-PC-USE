<?php
include("header.php"); // Ensure this file contains your database connection.

$response = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date_received = $_POST["date_received"];
    $teller_name = $_POST["teller_name"];
    $series = $_POST["series"];
    $service_invoice = $_POST["service_invoice"];

    // Insert into the database
    $query = "INSERT INTO tbl_or_service_invoice (date_received, teller_name, series, service_invoice) 
              VALUES ('$date_received', '$teller_name', '$series', '$service_invoice')";
        // Execute the query
        if ($con->query($query) === TRUE) {
            // Redirect to another page on success
            header("Location: service_invoce_reports.php?message=New OR added successfully");
            exit();
        } else {
            // Display error if query fails
            echo "Error: " . $con->error;
        }
}

include("footer.php");
?>
