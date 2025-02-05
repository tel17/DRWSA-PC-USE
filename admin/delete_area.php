<?php
include("header.php");
include("dbcon.php"); // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Validate ID to prevent SQL injection
    if (!empty($id) && is_numeric($id)) {
        $query = "DELETE FROM tbl_area WHERE id = '$id'";
        if ($con->query($query) === TRUE) {
            echo "success";  // ✅ Only return "success"
        } else {
            echo "error";
        }
    } else {
        echo "error"; // Return error for invalid IDs
    }
}

exit(); // ✅ Prevent any additional output
?>
