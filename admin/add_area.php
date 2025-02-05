<?php
include("header.php"); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $area = $_POST['area'];

    // SQL Insert Query
    $query = "INSERT INTO tbl_area (area) VALUES ('$area')";

    // Execute the query
    if ($con->query($query) === TRUE) {
        header("Location: area_reports.php"); // Redirect to an area list page after successful insertion
        exit();
    } else {
        // If there's an error in the query
        echo "Error: " . $con->error;
    }
}
?>
