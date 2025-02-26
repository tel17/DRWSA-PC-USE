<?php
include("header.php"); // Ensure database connection

// Ensure $con is set
if (!isset($con) || !$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submission securely
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['account_number'], $_POST['present_2'], $_POST['previous_bill'])) {
    $account_number = $_POST['account_number'];
    $present2 = $_POST['present_2'];
    $previous_bill = $_POST['previous_bill'];

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("UPDATE tbl_members_profile 
                           SET previous_reading = ?, previous_bill = ? 
                           WHERE account_number = ?");
    $stmt->bind_param("sss", $present2, $previous_bill, $account_number);
    if (!$stmt->execute()) {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch member profiles
$query = "SELECT account_number, name, area, block, previous_reading, previous_bill FROM tbl_members_profile";
$result = mysqli_query($con, $query);

$accounts = [];
$names = [];

while ($row = mysqli_fetch_assoc($result)) {
    $accounts[$row['account_number']] = $row;
    $names[$row['name']] = $row;
}

// List of specified areas
$specifiedAreas = ["Pilar Ville", "Colbella", "Prima Phase 1", "Prima Phase 2", "Cambridge", 
                   "Romanville", "San Bernardo", "Amare", "St. Matthews", "Ramonita"];
$specifiedAreas2 = ["Silangan", "Kanluran", "Railroad"];

// Fetch the latest billing period


$billingResult = $con->query("SELECT billing_period FROM tbl_billing_period ORDER BY id DESC LIMIT 1");
if ($billingResult && $billingRow = $billingResult->fetch_assoc()) {
    $billingPeriod = $billingRow['billing_period'];
}



// Fetch all disconnection dates for different areas
$disc_dates = [];
$discResult = $con->query("SELECT id, disconnection_date FROM tbl_disconnection_date");
while ($discRow = $discResult->fetch_assoc()) {
    $disc_dates[$discRow['id']] = $discRow['disconnection_date'];
}

// Close the database connection
$con->close();
?>

<form method="POST">
    <div class="row">
        <div class="col-lg-3">
            <label for="account_number">Account Number:</label>
            <input type="text" name="account_number" id="account_number" class="form-control" required autocomplete="off">
        </div>

        <div class="col-lg-3">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required autocomplete="off">
            <div id="name-suggestions" class="dropdown-menu" style="display: none; position: absolute; width: 100%;"></div>
        </div>

        <div class="col-lg-3">
            <label for="area">Area:</label>
            <input type="text" name="area" id="area" class="form-control" required readonly>
        </div>

        <div class="col-lg-3">
            <label for="disc_date">Disconnection Date:</label>
            <input type="date" name="disc_date" id="disc_date" class="form-control">
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
            <label for="previous_bill">Previous Bill:</label>
            <input type="text" id="previous_bill" name="previous_bill" class="form-control" readonly>
        </div>

        <div class="col-lg-3">
            <label for="present2">Present (Old Meter):</label>
            <input type="number" id="present2" name="present_2" class="form-control" oninput="calculateTotalConsumed(), calculateConsumedCuM(), calculateTariff()">
        </div>

        <div class="col-lg-3">
            <label for="date-range">Billing Period:</label>
            <input type="text" id="date-range" name="billing_period" class="form-control" value="<?= htmlspecialchars($billingPeriod); ?>">
        </div>

        <div class="col-lg-3">
            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date" id="due_date" class="form-control" >
        </div>

        <div class="col-lg-3">
            <button type="submit" class="btn btn-primary mt-4">Update Reading</button>
        </div>
    </div>
</form>

<script>
    var accounts = <?= json_encode($accounts); ?>;
    var names = <?= json_encode($names); ?>;
    var discDates = <?= json_encode($disc_dates); ?>;
    
    document.getElementById("account_number").addEventListener("input", function() {
        var data = accounts[this.value.trim()] || {};
        document.getElementById("name").value = data.name || "";
        document.getElementById("area").value = data.area || "";
        document.getElementById("block").value = data.block || "";
        document.getElementById("previous2").value = data.previous_reading || "";
        document.getElementById("previous_bill").value = data.previous_bill || "";

        // Update disconnection date based on area
        updateDisconnectionDate(data.area);
    });

    document.getElementById("name").addEventListener("input", function() {
        var inputValue = this.value.toLowerCase().trim();
        var suggestions = document.getElementById("name-suggestions");
        suggestions.innerHTML = "";
        suggestions.style.display = "none";

        if (inputValue.length > 0) {
            var matches = Object.keys(names).filter(name => name.toLowerCase().includes(inputValue));

            if (matches.length > 0) {
                suggestions.style.display = "block";
                matches.forEach(match => {
                    var suggestionItem = document.createElement("div");
                    suggestionItem.className = "dropdown-item";
                    suggestionItem.textContent = match;
                    suggestionItem.onclick = function() {
                        document.getElementById("name").value = match;
                        suggestions.style.display = "none";

                        var data = names[match] || {};
                        document.getElementById("account_number").value = data.account_number || "";
                        document.getElementById("area").value = data.area || "";
                        document.getElementById("block").value = data.block || "";
                        document.getElementById("previous2").value = data.previous_reading || "";
                        document.getElementById("previous_bill").value = data.previous_bill || "";

                        // Update disconnection date based on area
                        updateDisconnectionDate(data.area);
                    };
                    suggestions.appendChild(suggestionItem);
                });
            }
        }
    });

    function updateDisconnectionDate(area) {
    // Normalize: Remove extra spaces and convert to lowercase
    var normalizedArea = area.replace(/\s+/g, ' ').trim().toLowerCase(); 
    
    // Define valid areas with standardized spacing
    var validAreas = ["pilar ville", "colbella", "prima phase 1", "prima phase 2", "cambridge", "romanville", "san bernardo", "amare", "st. matthews", "ramonita"];
    
    // Check if normalized area matches any valid area
    var rowId = validAreas.includes(normalizedArea) ? "1" : "2";
    
    // Update disconnection date
    document.getElementById("disc_date").value = discDates[rowId] || "";
}


</script>
