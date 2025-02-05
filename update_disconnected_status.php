<?php
include("dbcon.php"); // Ensure your database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Prepare the update query
    $query = "UPDATE tbl_members_profile SET consumer_status = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $status, $id); // 's' for string (status), 'i' for integer (id)

    // Execute the query
    if ($stmt->execute()) {
        echo "success"; // Response for AJAX success handling
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid request";
}
?>
