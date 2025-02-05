<?php
include("dbcon.php"); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $status = $_POST['status']; // Get the status from the POST request

    // Prepare the update query
    $query = "UPDATE tbl_members_profile SET consumer_status = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $status, $id); // Bind status ('s' for string) and id ('i' for integer)

    // Execute the query
    if ($stmt->execute()) {
        echo "success"; // Return success message if update is successful
    } else {
        echo "error"; // Return error message if update fails
    }

    $stmt->close();
    $con->close();
} else {
    echo "invalid"; // Return invalid response if parameters are missing
}
?>
