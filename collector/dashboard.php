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
          <h5>Total Number of Unpaid</h5>
        </div>
        <div class="card-body" style="height:5px;">
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
                echo "<p>" . $row['unpaid_count'] . "</p>"; // Display the count
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
        </div>
        <div class="card-header">
          <h5>Total Grand Total of Unpaid</h5>
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
          <h5>Total Number of Paid to Collector</h5>
        </div>
        <div class="card-body"style="height:5px;" >
          <?php
            // Modify the query to count 'Paid to Collector' records
            $query = "SELECT COUNT(*) AS paid_to_collector_count FROM tbl_reading WHERE payment_status = 'collector'";
            if ($areaFilter && $areaFilter != 'all') {
                $query .= " AND area = '$areaFilter'";
            }

            $result = $con->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p>" . $row['paid_to_collector_count'] . "</p>"; // Display the count
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
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
          <h5>Total Number of Paid to Cashier</h5>
        </div>
        <div class="card-body" style="height:5px;">
          <?php
            // Modify the query to count 'Paid to Cashier' records
            $query = "SELECT COUNT(*) AS paid_to_cashier_count FROM tbl_reading WHERE payment_status = 'cashier'";
            if ($areaFilter && $areaFilter != 'all') {
                $query .= " AND area = '$areaFilter'";
            }

            $result = $con->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p>" . $row['paid_to_cashier_count'] . "</p>"; // Display the count
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
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
          <h5>Total Number of Free of Charge</h5>
        </div>
        <div class="card-body" style="height:5px;">
          <?php
            // Modify the query to count 'Free of Charge' records
            $query = "SELECT COUNT(*) AS free_of_charge_count FROM tbl_reading WHERE payment_status = 'free'";
            if ($areaFilter && $areaFilter != 'all') {
                $query .= " AND area = '$areaFilter'";
            }

            $result = $con->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo "<p>" . $row['free_of_charge_count'] . "</p>"; // Display the count
            } else {
                echo "<p>Error fetching data.</p>";
            }
          ?>
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

</body>
</html>
