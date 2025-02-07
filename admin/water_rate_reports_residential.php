<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
include("dbcon.php"); // Ensure database connection is included
?>

<body>
<?php
include("topbar.php");
include("sidebar.php");
?>

<style>
    .datatable-top .datatable-search {
        display: none !important;
    }
</style>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Water Rate Residential</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Water Rate Residential</a></li>
        <li class="breadcrumb-item active">Reports</li>
      </ol>
    </nav>
  </div>

 

  <section class="section dashboard">
    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Water Rate Residential <span>| Reports</span></h5>
 <!-- Add Data Button -->
 <div class="d-flex justify-content-end mb-3">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDataModal">
          <i class="bi bi-plus"></i> Add Data
      </button>
  </div>
            <table class="table table-borderless datatable" id="Customer_Manager_Report">
              <thead>
                <tr>
                  <th style="text-align: center;">#</th>
                  <th style="text-align: center;">Min Consumed</th>
                  <th style="text-align: center;">Max Consumed</th>
                  <th style="text-align: center;">Rate Per Cubic</th>
                  <th style="text-align: center;">Base Rate</th>
                  <th style="text-align: center;">Actions</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      // Fetch data from the database
                      $query = "SELECT * FROM residential_tariff_structure";
                      $result = $con->query($query);

                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                      <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["min_consumed"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["max_consumed"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["rate_per_cubic"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["base_rate"]; ?></td>
                      <td style="text-align: center;">
                          <button type="button" class="btn btn-warning" title="Edit Information">
                              <i class="bi bi-pencil-square"></i> 
                          </button>
                      </td>
                  </tr>
                  <?php
                          }
                      } else {
                  ?>
                  <tr>
                      <td colspan="6" class="text-center">No data available at the moment.</td>
                  </tr>
                  <?php
                      }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php 
include("footer.php");
?>

<!-- Modal for Adding Data -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">Add Data</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="add_active_reports.php" method="POST" id="addForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="account_number_active" class="form-label">Base Rate</label>
                    <input type="text" class="form-control" id="account_number_active" name="account_number_active" required>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Rate per Cubic</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="area" class="form-label">AREA</label>
                    <select class="form-control" id="area" name="area" required>
                      <option selected disabled>--SELECT AREA--</option>
                      <?php 
                        $query = "SELECT * FROM tbl_area";
                        $result = $con->query($query);
                        while ($userResult = $result->fetch_assoc()){
                          echo "<option value='{$userResult['area']}'>{$userResult['area']}</option>";
                        }
                      ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="blk_lot" class="form-label">Blk/Lot</label>
                    <input type="text" class="form-control" id="blk_lot" name="blk_lot" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="month" class="form-label">Billing Month</label>
                    <input type="month" class="form-control" id="month" name="month" required>
                </div>
                <div class="col-md-6">
                    <label for="maintenance" class="form-label">Maintenance</label>
                    <input type="text" class="form-control" id="maintenance" name="maintenance" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('addForm').addEventListener('submit', function(event) {
    event.preventDefault();
    Swal.fire({
      title: 'Data Added Successfully!',
      text: 'Data has been added.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    });
});
</script>

</body>
</html>
