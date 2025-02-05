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
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Area Name</th>
                <th style="text-align: center;">Active</th> <!-- Count from tbl_active -->
                <th style="text-align: center;">Disconnected</th> <!-- Count from tbl_disconnected -->
                <th style="text-align: center;">Meter Replacement</th> <!-- Count from tbl_meter_replacement -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all areas from tbl_area
            $query = "SELECT * FROM tbl_area";
            $result = $con->query($query);

            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    $area_name = $row['area'];

                    // Fetch count of active users per area from tbl_active
                    $activeQuery = "SELECT COUNT(*) AS active_count FROM tbl_active WHERE area = '$area_name'";
                    $activeResult = $con->query($activeQuery);
                    $activeRow = $activeResult->fetch_assoc();
                    $activeCount = $activeRow['active_count'] ?? 0;

                    // Fetch count of disconnected users per area from tbl_disconnected
                    $disconnectedQuery = "SELECT COUNT(*) AS disconnected_count FROM tbl_disconnected WHERE area = '$area_name'";
                    $disconnectedResult = $con->query($disconnectedQuery);
                    $disconnectedRow = $disconnectedResult->fetch_assoc();
                    $disconnectedCount = $disconnectedRow['disconnected_count'] ?? 0;

                    // Fetch count of meter replacements per area from tbl_meter_replacement
                    $meterReplacementQuery = "SELECT COUNT(*) AS meter_replacement_count FROM tbl_meter_replacement WHERE area = '$area_name'";
                    $meterReplacementResult = $con->query($meterReplacementQuery);
                    $meterReplacementRow = $meterReplacementResult->fetch_assoc();
                    $meterReplacementCount = $meterReplacementRow['meter_replacement_count'] ?? 0;

                    echo "<tr>
                            <td style='text-align: center;'>{$count}</td>
                            <td style='text-align: center;'>{$area_name}</td>
                            <td style='text-align: center;'>{$activeCount}</td>
                            <td style='text-align: center;'>{$disconnectedCount}</td>
                            <td style='text-align: center;'>{$meterReplacementCount}</td>
                          </tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No areas found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
