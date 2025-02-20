<?php
include("header.php"); // Ensure database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['account_number'], $_POST['present_2'])) {
    $account_number = $_POST['account_number'];
    $present2 = $_POST['present_2'];

    // Update the database
    $updateQuery = "UPDATE tbl_members_profile SET previous_reading = '$present2' WHERE account_number = '$account_number'";
    mysqli_query($con, $updateQuery);
}
?>

<form method="POST">
    <div class="row">
        <div class="col-lg-3">
            <?php
            // Fetch data
            $query = "SELECT account_number, name, area, block, previous_reading FROM tbl_members_profile";
            $result = mysqli_query($con, $query);

            $accounts = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $accounts[$row['account_number']] = [
                    "name" => $row['name'], 
                    "area" => $row['area'], 
                    "block" => $row['block'],
                    "previous_reading" => $row['previous_reading']
                ];
            }
            ?>

            <label for="account_number">Account Number:</label>
            <input type="text" name="account_number" id="account_number" class="form-control" required>

            <script>
                var accounts = <?= json_encode($accounts); ?>;
                document.getElementById("account_number").addEventListener("input", function() {
                    var data = accounts[this.value.trim()] || { name: "", area: "", block: "", previous_reading: "" };
                    document.getElementById("name").value = data.name;
                    document.getElementById("area").value = data.area;
                    document.getElementById("block").value = data.block;
                    document.getElementById("previous2").value = data.previous_reading;
                });
            </script>
        </div>

        <div class="col-lg-3">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required readonly>
        </div>

        <div class="col-lg-3">
            <label for="area">Area:</label>
            <input type="text" name="area" id="area" class="form-control" required readonly>
        </div>

        <div class="col-lg-3">
            <label for="block">Block:</label>
            <input type="text" name="block" id="block" class="form-control" required readonly>
        </div>

        <div class="col-lg-3">
            <label for="previous2">Previous (Old Meter):</label>
            <input type="number" id="previous2" name="previous_2" class="form-control" readonly>
        </div>

        <div class="col-lg-3">
            <label for="present2">Present (Old Meter):</label>
            <input type="number" id="present2" name="present_2" class="form-control" oninput="calculateTotalConsumed(), calculateConsumedCuM(), calculateTariff()">
        </div>

        <div class="col-lg-3">
            <button type="submit" class="btn btn-primary mt-4">Update Reading</button>
        </div>
    </div>
</form>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Range Picker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>

    <label for="date-range">Select Date Range:</label>
    <input type="text" id="date-range" name="date-range" placeholder="YYYY-MM-DD to YYYY-MM-DD">

   
    <script>
      flatpickr("#date-range", {
            mode: "range",
            dateFormat: "m/d/Y", // Format changed to MM/DD/YYYY
            altInput: true,
            altFormat: "F j, Y" // Optional: Display a user-friendly format
        });
    </script>

</body>
</html>
