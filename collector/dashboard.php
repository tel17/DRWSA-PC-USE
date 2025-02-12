<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

<?php include("topbar.php"); ?>
<?php include("sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Dashboard Data</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <div class="container">
    <!-- Area Filter Section -->
    <form method="GET" action="">
      <div class="row mb-3">
        <div class="col-lg-3">
          <label for="area">Filter by Area:</label>
          <select name="area" id="area" class="form-control" onchange="this.form.submit()">
            <option value="">-SELECT AREA-</option>
            <option value="all" <?php echo (isset($_GET['area']) && $_GET['area'] == 'all') ? 'selected' : ''; ?>>All</option>
            <?php
              // Fetch all unique areas from the database
              $areaQuery = "SELECT DISTINCT area FROM tbl_reading";
              $areaResult = $con->query($areaQuery);
              while ($areaRow = $areaResult->fetch_assoc()) {
                $selected = isset($_GET['area']) && $_GET['area'] == $areaRow['area'] ? 'selected' : '';
                echo "<option value='" . $areaRow['area'] . "' $selected>" . $areaRow['area'] . "</option>";
              }
            ?>
          </select>
        </div>
      </div>
    </form>

    <div class="card-container">
      <!-- Card 1: Total Number of Unpaid -->
      <div class="card">
        <div class="card-header">
       
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>Total Number of Unpaid:</span>
            <?php
                // Get the selected area from the GET request
                $areaFilter = isset($_GET['area']) ? $_GET['area'] : '';

                // Modify the query to filter by area if an area is selected
                $query = "SELECT COUNT(*) AS unpaid_count FROM tbl_reading WHERE payment_status = 'unpaid'";
                if ($areaFilter && $areaFilter != 'all') {
                    $query .= " AND area = '$areaFilter'";
                }

                $result = $con->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo "<span>" . $row['unpaid_count'] . "</span>"; // Display the count
                } else {
                    echo "<span>Error fetching data.</span>";
                }
            ?>
        </div>

        </div>
        
        <div class="card-header">
          <h5>Amount to be collected </h5>
        </div>
        <div class="card-body">
          <?php
            // Modify the query to sum grand_total and filter by area
            $query = "SELECT SUM(grand_total) AS total_grand_total FROM tbl_reading WHERE payment_status = 'unpaid'";
            if ($areaFilter && $areaFilter != 'all') {
                $query .= " AND area = '$areaFilter'";
            }

            $result = $con->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p>" . number_format($row['total_grand_total'], 2) . "</p>"; // Display the sum formatted
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
        </div>
      </div>

      
      <!-- Card 3: Paid to Collector -->
      <div class="card">
        <div class="card-header">
        
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span>Total Number of Paid to Collector:</span>
                <?php
                    // Modify the query to count 'Paid to Collector' records
                    $query = "SELECT COUNT(*) AS paid_to_collector_count FROM tbl_reading WHERE payment_status = 'collector'";
                    if ($areaFilter && $areaFilter != 'all') {
                        $query .= " AND area = '$areaFilter'";
                    }

                    $result = $con->query($query);
                    if ($result) {
                        $row = $result->fetch_assoc();
                        echo "<span>" . $row['paid_to_collector_count'] . "</span>"; // Display the count
                    } else {
                        echo "<span>Error fetching data.</span>";
                    }
                ?>
            </div>

        </div>

        <div class="card-header">
          <h5>Total Grand Total of Paid to Collector</h5>
        </div>
        <div class="card-body">
          <?php
            // Modify the query to sum grand_total for 'Paid to Collector' records
            $query = "SELECT SUM(grand_total) AS paid_to_collector_grand_total FROM tbl_reading WHERE payment_status = 'collector'";
            if ($areaFilter && $areaFilter != 'all') {
                $query .= " AND area = '$areaFilter'";
            }

            $result = $con->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p>" . number_format($row['paid_to_collector_grand_total'], 2) . "</p>"; // Display the sum formatted
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
        </div>
      </div>

      <!-- Card 4: Paid to Cashier -->
      <div class="card">
        <div class="card-header">
       
          <div style="display: flex; justify-content: space-between; align-items: center;">
              <span>Total Number of Paid to Cashier:</span>
              <?php
                  // Modify the query to count 'Paid to Cashier' records
                  $query = "SELECT COUNT(*) AS paid_to_cashier_count FROM tbl_reading WHERE payment_status = 'cashier'";
                  if ($areaFilter && $areaFilter != 'all') {
                      $query .= " AND area = '$areaFilter'";
                  }

                  $result = $con->query($query);
                  if ($result) {
                      $row = $result->fetch_assoc();
                      echo "<span>" . $row['paid_to_cashier_count'] . "</span>"; // Display the count
                  } else {
                      echo "<span>Error fetching data.</span>";
                  }
              ?>
          </div>

        </div>

        <div class="card-header">
          <h5>Total Grand Total of Paid to Cashier</h5>
        </div>
        <div class="card-body">
          <?php
            // Modify the query to sum grand_total for 'Paid to Cashier' records
            $query = "SELECT SUM(grand_total) AS paid_to_cashier_grand_total FROM tbl_reading WHERE payment_status = 'cashier'";
            if ($areaFilter && $areaFilter != 'all') {
                $query .= " AND area = '$areaFilter'";
            }

            $result = $con->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p>" . number_format($row['paid_to_cashier_grand_total'], 2) . "</p>"; // Display the sum formatted
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
        </div>
      </div>

 
      <!-- Card 5: Free of Charge -->
      <div class="card">
        <div class="card-header">
      
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>Total Number of Free of Charge:</span>
            <?php
                // Modify the query to count 'Free of Charge' records
                $query = "SELECT COUNT(*) AS free_of_charge_count FROM tbl_reading WHERE payment_status = 'free'";
                if ($areaFilter && $areaFilter != 'all') {
                    $query .= " AND area = '$areaFilter'";
                }

                $result = $con->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo "<span>" . $row['free_of_charge_count'] . "</span>"; // Display the count
                } else {
                    echo "<span>Error fetching data.</span>";
                }
            ?>
        </div>

        </div>
      </div>

    
      <!-- Card 8: Total Grand Total of Free of Charge -->
      <!-- <div class="card">
        <div class="card-header">
          <h5>Total Grand Total of Free of Charge</h5>
        </div>
        <div class="card-body">
          <?php
            // Modify the query to sum grand_total for 'Free of Charge' records
            $query = "SELECT SUM(grand_total) AS free_of_charge_grand_total FROM tbl_reading WHERE payment_status = 'free'";
            if ($areaFilter && $areaFilter != 'all') {
                $query .= " AND area = '$areaFilter'";
            }

            $result = $con->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p>" . number_format($row['free_of_charge_grand_total'], 2) . "</p>"; // Display the sum formatted
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
        </div>
      </div> -->
    </div>
  </div>

  <div class="card "style="width:100%">
  <div class="card-header"style="width:100%">
    <h5 style="text-align:center;">System Logs</h5>
  </div>
  <div class="card-body"style="width:100%">
  <table class="table table-borderless datatable" id="logsTable">
      <thead>
        <tr>
          
          <th style="text-align:center;">Username</th>
          <th style="text-align:center;">Login Time</th>
          <th style="text-align:center;">Logout Time</th>
        </tr>
      </thead>
      <tbody>
      <?php
// Set the default time zone for PHP
date_default_timezone_set('Asia/Manila'); // Replace with your desired time zone if different

$query = "SELECT id, username, login_time, logout_time FROM system_logs ORDER BY login_time DESC";
$result = $con->query($query);

while ($row = $result->fetch_assoc()) {
    // Convert login time from UTC to Asia/Manila time zone
    $login_time = new DateTime($row['login_time'], new DateTimeZone('UTC'));
    $login_time->setTimezone(new DateTimeZone('Asia/Manila')); // Convert to Asia/Manila time zone
    
    // Manually adjust time by subtracting 1 hour (if necessary)
    $login_time->modify('-1 hour'); // Adjust time by subtracting 1 hour

    // Convert logout time from UTC to Asia/Manila time zone
    $logout_time = $row['logout_time'] ? new DateTime($row['logout_time'], new DateTimeZone('UTC')) : null;
    if ($logout_time) {
        $logout_time->setTimezone(new DateTimeZone('Asia/Manila')); // Convert to Asia/Manila time zone
        
        // Manually adjust logout time by subtracting 1 hour (if necessary)
        $logout_time->modify('-1 hour'); // Adjust time by subtracting 1 hour
    }

    // Display the times with the desired format
    echo "<tr>
        <td style='text-align: center;'>{$row['username']}</td>
        <td style='text-align: center;'>" . $login_time->format('F j, Y g:i A') . "</td>
        <td style='text-align: center;'>" . ($logout_time ? $logout_time->format('F j, Y g:i A') : '<span class="text-danger">Still Logged In</span>') . "</td>
      </tr>";

}
?>





      </tbody>
    </table>
  </div>
</div>

</main>


<?php include("footer.php"); ?>

<!-- Custom CSS -->
<style>
  .card-container {
    display: flex;
    justify-content: space-between; /* Distributes space evenly */
    flex-wrap: wrap; /* Ensures responsiveness */
  }

  .card {
    width: 23%; /* Adjusted to display 4 cards in a row */
    margin-top: 20px;
  }
</style>
<script>
  $(document).ready(function () {
    $('#logsTable').DataTable({
      "scrollX": true, // Enables horizontal scrolling if needed
      "paging": true, // Enables pagination
      "searching": true, // Enables search
      "order": [[2, "desc"]], // Orders by login time (most recent first)
      "pageLength": 5, // Shows only 5 rows on the first page
      "lengthMenu": [5, 10, 25, 50, 100] // Options for the user to select page size
    });
  });
</script>


</body>
</html>
