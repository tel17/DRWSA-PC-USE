<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
?>
<body>

<?php
include("topbar.php");
?>

<?php
include("sidebar.php");
?>
<style>
.datatable-top .datatable-search {
    display: none !important;
}
</style>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Water Rate</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Water Rate</a></li>
        <li class="breadcrumb-item active">Reports</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Water Rate<span>| Reports</span></h5>
           

<!-- Filter Inputs -->
<div class="row mb-2 align-items-center">
    <div class="col-md-3">
        <input type="text" class="form-control" id="filterName" placeholder="Filter by Name">
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" id="filterBlockLot" placeholder="Filter by Block & Lot">
    </div>
    
    <!-- Button should be right-aligned and vertically centered -->
    <div class="col-md-6 text-end">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDataModal">
            <i class="bi bi-plus"></i> Add Data
        </button>
    </div>
</div>

            <table class="table table-borderless datatable" id="Customer_Manager_Report">
              <thead>
                <tr>
                  <th scope="col" style="text-align: center;">#</th>
                  <th scope="col" style="text-align: center;">ACCOUNT NUMBER</th>
                  <th scope="col" style="text-align: center;">NAME</th>
                  <!-- <th scope="col" style="text-align: center;">CONSUMER STATUS</th> -->
                  <th scope="col" style="text-align: center;">AREA</th>
                  <th scope="col" style="text-align: center;">BLK/LOT</th>
                  <th scope="col" style="text-align: center;">READING</th>
                  <th scope="col" style="text-align: center;">DATE RECON</th>
                  <th scope="col" style="text-align: center;">MONTH</th>
                  <th scope="col" style="text-align: center;">MAINTENANCE</th>
                  <th scope="col" style="text-align: center;">REMARKS</th>
                  <th scope="col" style="text-align: center;">YEAR</th>
                  <th scope="col" style="text-align: center;">Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      // Query to fetch data from tbl_disconnected
                      $query = "SELECT * FROM tbl_active";
                      $result = $con->query($query);

                      // Check if any rows are returned
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                      <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["account_number_active"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["name"]; ?></td>
                      <!-- <td style="text-align: center;"><?php echo $row["consumer_status_active"]; ?></td> -->
                      <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["blk_lot"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["reading"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["date_reconnected"]; ?></td>
                      <td style="text-align: center;">
                            <?php 
                                // Assuming $row["billing_month"] is in the DATE format (YYYY-MM-DD)
                                echo date("F Y", strtotime($row["month"])); // Format as 'Month Year' (e.g., February 2025)
                            ?>
                        </td>
                      <td style="text-align: center;"><?php echo $row["maintenance"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["remarks"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["year"]; ?></td>
                     
                      <td>
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
                      <td colspan="11">
                          <center>No data available at the moment.</center>
                      </td>
                  </tr>
                  <?php
                      }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- End Recent Sales -->
    </div>
  </section>
</main>
<!-- End Main -->

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
                    <input list="account_numbers" class="form-control" id="account_number_active" name="account_number_active" required>
                    <datalist id="account_numbers">
                        <option value="">Select an Account Number</option>
                        <?php
                        // Fetch data from database
                        $sql = "SELECT account_number, name, consumer_status, area, block FROM tbl_members_profile";
                        $result = $con->query($sql);

                        // Prepare JavaScript object for mapping
                        $accountData = [];

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $account_number = htmlspecialchars($row["account_number"]);
                                $name = htmlspecialchars($row["name"]);
                                $consumer_status = htmlspecialchars($row["consumer_status"]);
                                $area = htmlspecialchars($row["area"]);
                                $blk_lot = htmlspecialchars($row["block"]);

                                echo '<option value="' . $account_number . '"></option>';

                                // Store account data in array for JavaScript use
                                $accountData[$account_number] = [
                                    "name" => $name,
                                    "consumer_status" => $consumer_status,
                                    "area" => $area,
                                    "blk_lot" => $blk_lot
                                ];
                            }
                        }
                        ?>
                    </datalist>
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Rate per Cubic</label>
                    <input type="text" class="form-control" id="name" name="name" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <!-- <div class="col-md-6">
                    <label for="consumer_status_active" class="form-label">Consumer Status Active</label>
                    <input type="text" class="form-control" id="consumer_status_active" name="consumer_status_active" readonly>
                </div> -->

                <div class="col-md-6">
                   
         
                    <label for="area" class="form-label">AREA</label>
                    <select class="form-control" id="area" name="area" required>
                      <option selected disabled>--SELECT AREA--</option>
                      <?php 
                        $query = "SELECT * FROM tbl_area";
                        $result = $con->query($query);
                        if(mysqli_num_rows($result) > 0){
                          while ($userResult = $result->fetch_assoc()){
                      ?>
                            <option data-tokens="<?php echo $userResult['area']; ?>"><?php echo $userResult['area']; ?></option>
                      <?php 
                          }
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
                    <label for="reading" class="form-label">Reading</label>
                    <input type="text" class="form-control" id="reading" name="reading" required>
                </div>
                <div class="col-md-6">
                    <label for="date_reconnected" class="form-label">Date Reconnected</label>
                    <input type="date" class="form-control" id="date_reconnected" name="date_reconnected" required>
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
                <div class="col-md-6">
                    <label for="year" class="form-label" hidden>Year</label>
                    <input type="text" class="form-control" id="year" name="year" required readonly hidden>
                </div>
                
            </div>

            <div class="row mb-3">
               

                <div class="col-md">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" class="form-control" id="remarks" name="remarks">
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
  // Trigger SweetAlert after form submission
  document.getElementById('addForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission to show SweetAlert first

    // Show SweetAlert Success message
    Swal.fire({
      title: 'Data Added Successfully!',
      text: 'Data for Active  has been added.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Submit the form after closing the SweetAlert
        this.submit();
      }
    });
  });

  





</script>

</body>
</html>
