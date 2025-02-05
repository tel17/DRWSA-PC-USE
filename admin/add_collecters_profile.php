<?php
include("header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using password_hash (Secure)
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $insert_query = "INSERT INTO tbl_collectors_profile (fullname, username, password)
                     VALUES ('$fullname', '$username', '$password_hashed')";

    // Execute the query
    if ($con->query($insert_query) === TRUE) {
        // Redirect to another page on success
        header("Location: collectors_profile_reports.php?message=New delivery added successfully");
        exit();
    } else {
        // Display error if query fails
        echo "Error: " . $con->error;
    }
}

include("footer.php");
?>
