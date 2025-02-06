<?php 
include("dbcon.php"); 
include("header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area List</title>
</head>
<body>

<div class="container mt-4">
    <h1>SUMMARY NDRM</h1>
    <h2 class="text-center">List of Areas</h2>

    <!-- Form for filtering by month and year -->
    <form method="GET" action="" class="mb-3">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <label for="month" class="form-label">Select Month</label>
                <select class="form-select" id="month" name="month" required>
                    <option value="">Choose...</option>
                    <?php
                    // Populate month options
                    for ($m = 1; $m <= 12; $m++) {
                        $monthName = date("F", mktime(0, 0, 0, $m, 1));
                        $selected = (isset($_GET['month']) && $_GET['month'] == $m) ? "selected" : "";
                        echo "<option value='$m' $selected>$monthName</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="year" class="form-label">Select Year</label>
                <select class="form-select" id="year" name="year" required>
                    <option value="">Choose...</option>
                    <?php
                    // Populate year options (current year and previous 5 years)
                    $currentYear = date("Y");
                    for ($y = $currentYear; $y >= $currentYear - 5; $y--) {
                        $selected = (isset($_GET['year']) && $_GET['year'] == $y) ? "selected" : "";
                        echo "<option value='$y' $selected>$y</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Table displaying the filtered results -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Area Name</th>
                <th style="text-align: center;">Active</th> <!-- Count from tbl_active -->
                <th style="text-align: center;">Disconnected</th> <!-- Count from tbl_disconnected -->
                <th style="text-align: center;">Meter Replacement</th> <!-- Count from tbl_meter_replacement -->
                <th style="text-align: center;">New Connections</th> <!-- Count from tbl_newconnection -->
                <th style="text-align: center;">Month</th> 
                <th style="text-align: center;">Year</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            // Get selected month and year from GET request or default to current month and year
            $selectedMonth = isset($_GET['month']) ? (int) $_GET['month'] : date("m");
            $selectedYear = isset($_GET['year']) ? (int) $_GET['year'] : date("Y");

            // Convert month number to month name
            $monthName = date("F", mktime(0, 0, 0, $selectedMonth, 1));

            // Fetch all areas from tbl_area
            $query = "SELECT * FROM tbl_area";
            $result = $con->query($query);

            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    $area_name = $row['area'];

                    // Fetch count of active users per area, filtered by selected month and year
                    $activeQuery = "SELECT COUNT(*) AS active_count FROM tbl_active 
                                    WHERE area = '$area_name' 
                                    AND MONTH(date_reconnected) = '$selectedMonth'
                                    AND YEAR(date_reconnected) = '$selectedYear'";
                    $activeResult = $con->query($activeQuery);
                    $activeRow = $activeResult->fetch_assoc();
                    $activeCount = $activeRow['active_count'] ?? 0;

                    // Fetch count of disconnected users per area, filtered by selected month and year
                    $disconnectedQuery = "SELECT COUNT(*) AS disconnected_count FROM tbl_disconnected 
                                          WHERE area = '$area_name' 
                                          AND MONTH(date_disconnected) = '$selectedMonth'
                                          AND YEAR(date_disconnected) = '$selectedYear'";
                    $disconnectedResult = $con->query($disconnectedQuery);
                    $disconnectedRow = $disconnectedResult->fetch_assoc();
                    $disconnectedCount = $disconnectedRow['disconnected_count'] ?? 0;

                    // Fetch count of meter replacements per area, filtered by selected month and year
                    $meterReplacementQuery = "SELECT COUNT(*) AS meter_replacement_count FROM tbl_meter_replacement 
                                              WHERE area = '$area_name' 
                                              AND MONTH(date_filed) = '$selectedMonth'
                                              AND YEAR(date_filed) = '$selectedYear'";
                    $meterReplacementResult = $con->query($meterReplacementQuery);
                    $meterReplacementRow = $meterReplacementResult->fetch_assoc();
                    $meterReplacementCount = $meterReplacementRow['meter_replacement_count'] ?? 0;

                    // Fetch count of new connections per area, filtered by selected month and year
                    $newConnectionQuery = "SELECT COUNT(*) AS new_connection_count FROM tbl_newconnection 
                                           WHERE area = '$area_name' 
                                           AND MONTH(date_connect) = '$selectedMonth'
                                           AND YEAR(date_connect) = '$selectedYear'";
                    $newConnectionResult = $con->query($newConnectionQuery);
                    $newConnectionRow = $newConnectionResult->fetch_assoc();
                    $newConnectionCount = $newConnectionRow['new_connection_count'] ?? 0;

                    // Output the data in a table row
                    echo "<tr>
                            <td style='text-align: center;'>{$count}</td>
                            <td style='text-align: center;'>{$area_name}</td>
                            <td style='text-align: center;'>{$activeCount}</td>
                            <td style='text-align: center;'>{$disconnectedCount}</td>
                            <td style='text-align: center;'>{$meterReplacementCount}</td>
                            <td style='text-align: center;'>{$newConnectionCount}</td>
                            <td style='text-align: center;'>{$monthName}</td>
                            <td style='text-align: center;'>{$selectedYear}</td>
                          </tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No areas found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
