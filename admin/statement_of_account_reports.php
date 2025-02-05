<?php
include("header.php");
?>
<main>
<title>DRWSA/STATEMENT OF ACCOUNT</title>
</main>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      
      <a href="#" class="logo d-flex align-items-center">

        <img src="./assets/img/NEW-LOGO.png" alt="">
        <span class="d-none d-lg-block">D</span>
        <span class="d-none d-lg-block">RWSA</span>
        <small>|</small>
        <small>&nbsp;STATEMENT OF ACCOUNT</small>
      </a>
     
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <!-- Add any navigation links here if needed -->
      </ul>
    </nav>

  </header><!-- End Header -->

  <section class="section dashboard">
    <div class="row">
      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Enter Details</h5>
            
            <form method="GET" action="">
    <div class="row align-items-center">
        <!-- Input Field for Name -->
        <div class="col-md-8">
            <label for="name" class="form-label">NAME</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" required>
        </div>

        <!-- Buttons on the Right -->
        <div class="col-md-4 d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary me-2" name="search_active">Search By Active</button>
            <button type="submit" class="btn btn-primary me-2" name="search_disconnected">Search By Disconnected</button>
            <button type="submit" class="btn btn-primary" name="search_meter_replacement">Search By Meter Replacement</button>
        </div>
    </div>
</form>


          </div>
        </div>
      </div>
     

    </div>
  </section>
  <?php
// Initialize variables
$search_name = isset($_GET['name']) ? mysqli_real_escape_string($con, trim($_GET['name'])) : '';
$show_active = false;
$show_disconnected = false;
$show_meter_replacement = false;

// Determine which table to show
if (isset($_GET['search_active']) && !empty($search_name)) {
    $query = "SELECT * FROM tbl_active WHERE name LIKE '%$search_name%' ORDER BY name ASC";
    $show_active = true;
} elseif (isset($_GET['search_disconnected']) && !empty($search_name)) {
    $query = "SELECT * FROM tbl_disconnected WHERE name LIKE '%$search_name%' ORDER BY name ASC";
    $show_disconnected = true;
} elseif (isset($_GET['search_meter_replacement']) && !empty($search_name)) {
    $query = "SELECT * FROM tbl_meter_replacement WHERE name LIKE '%$search_name%' ORDER BY name ASC";
    $show_meter_replacement = true;
}

// Execute query only if a valid search is made
if ($show_active || $show_disconnected || $show_meter_replacement) {
    $result = $con->query($query);
}
?>

<!-- table for active -->
<?php if ($show_active): ?>
<table class="table table-borderless datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>ACCOUNT NUMBER</th>
            <th>NAME</th>
            <th>CONSUMER STATUS</th>
            <th>AREA</th>
            <th>BLK/LOT</th>
            <th>READING</th>
            <th>DATE RECON</th>
            <th>MONTH</th>
            <th>MAINTENANCE</th>
            <th>REMARKS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['account_number_active']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['consumer_status_active']}</td>
                    <td>{$row['area']}</td>
                    <td>{$row['blk_lot']}</td>
                    <td>{$row['reading']}</td>
                    <td>{$row['date_reconnected']}</td>
                    <td>" . date("F Y", strtotime($row['billing_month'])) . "</td>
                    <td>{$row['maintenance']}</td>
                    <td>{$row['remarks']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='11'><center>No matching data found.</center></td></tr>";
        }
        ?>
    </tbody>
</table>
<?php endif; ?>


<!-- table disconnected -->
<?php if ($show_disconnected): ?>
<table class="table table-borderless datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>ACCOUNT NUMBER</th>
            <th>NAME</th>
            <th>CONSUMER STATUS</th>
            <th>AREA</th>
            <th>BLK/LOT</th>
            <th>READING</th>
            <th>DATE DISCONNECTED</th>
            <th>MONTH</th>
            <th>DISCONNECTOR</th>
            <th>REMARKS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['account_number_disconnected']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['consumer_status_disconnected']}</td>
                    <td>{$row['area']}</td>
                    <td>{$row['blk_lot']}</td>
                    <td>{$row['reading']}</td>
                    <td>{$row['date_disconnected']}</td>
                    <td>" . date("F Y", strtotime($row['billing_month'])) . "</td>
                    <td>{$row['disconnector']}</td>
                    <td>{$row['remarks']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='11'><center>No matching data found.</center></td></tr>";
        }
        ?>
    </tbody>
</table>
<?php endif; ?>
<!-- table for meter replacement -->

<?php if ($show_meter_replacement): ?>
<table class="table table-borderless datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>NAME</th>
            <th>AREA</th>
            <th>BLK/LOT</th>
            <th>OLD READING</th>
            <th>NEW READING</th>
            <th>SERIAL NUMBER</th>
            <th>DATE FILED</th>
            <th>YEAR</th>
            <th>REMARKS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['area']}</td>
                    <td>{$row['block_lot']}</td>
                    <td>{$row['old_reading']}</td>
                    <td>{$row['new_reading']}</td>
                    <td>{$row['serial_number']}</td>
                    <td>{$row['date_filed']}</td>
                    <td>{$row['year']}</td>
                    <td>{$row['remarks']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='10'><center>No matching data found.</center></td></tr>";
        }
        ?>
    </tbody>
</table>
<?php endif; ?>

<script>
document.getElementById("name").addEventListener("input", function() {
        var nameValue = this.value.trim();
        
        // If input is cleared, remove URL parameters and reload page
        if (nameValue === "") {
            window.location.href = window.location.pathname;
        }
    });
</script>