<?php
include('header.php'); // Include your DB connection file

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Delete query
    $query = "DELETE FROM tbl_reading WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "success"; // Return success message if deletion is successful
    } else {
        echo "error"; // Return error message if something went wrong
    }
}
?>
