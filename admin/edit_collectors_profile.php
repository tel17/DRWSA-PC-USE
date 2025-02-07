<?php
include("header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted values
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Update query to store the hashed password
    $query = "UPDATE tbl_collectors_profile SET fullname = ?, username = ?, password = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('sssi', $fullname, $username, $password_hashed, $id);
    $stmt->execute();

    // Redirect or give feedback
    if ($stmt->affected_rows > 0) {
        header("Location: collectors_profile_reports.php");
        exit();
    } else {
        echo "No changes made.";
    }
}
?>