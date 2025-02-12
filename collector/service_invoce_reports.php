<!DOCTYPE html>
<html lang="en">

<?php include("header.php"); ?>

<body>

  <?php include("topbar.php"); ?>

  <?php include("sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>OR/SERVICE INVOICE Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Or / Service Invoice</a></li>
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
              <h5 class="card-title">OR Service Invoice<span>| Reports</span></h5>
              <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                  <!-- buttons for print dito -->
                </div>
                <div>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDataModal">
                    <i class="bi bi-plus"></i> Add Data
                  </button>
                </div>
              </div>
              <table class="table table-borderless datatable" id="Customer_Manager_Report">
                <thead>
                  <tr>
                    <th scope="col" style="text-align: center;">#</th>
                    <th scope="col" style="text-align: center;">DATE RECEIVED</th>
                    <th scope="col" style="text-align: center;">TELLER/COLLECTOR NAME</th>
                    <th scope="col" style="text-align: center;">SERIES</th>
                    <th scope="col" style="text-align: center;">SERVICE INVOICE NUMBER</th>
                    <th scope="col" style="text-align: center;">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                <?php
    // Query to fetch data from tbl_or_service_invoice
    $query = "SELECT * FROM tbl_or_service_invoice";
    $result = $con->query($query);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Check if the teller name is equal to the logged-in collector username
            if ($row["teller_name"] == $collector_username) {
?>
                <tr>
                    <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["date_received"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["teller_name"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["series"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["service_invoice"]; ?></td>
                    <!-- Show the Edit button only if teller name matches -->
                    <td>
                    <button type="button" class="btn btn-warning editBtn" 
                            data-toggle="modal" data-target="#editDataModal"
                            data-id="<?php echo $row['id']; ?>"
                            data-date_received="<?php echo $row['date_received']; ?>"
                            data-teller_name="<?php echo $row['teller_name']; ?>"
                            data-series="<?php echo $row['series']; ?>"
                            data-service_invoice="<?php echo $row['service_invoice']; ?>">
                            <i class="bi bi-pencil"></i> Edit Data
                        </button>
                    </td>
                </tr>
<?php
            } else {
?>
                <!-- No edit button for this row -->
                <tr>
                    <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["date_received"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["teller_name"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["series"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["service_invoice"]; ?></td>
                    <!-- No Edit button -->
                    <td></td>
                </tr>
<?php
            }
        }
    } else {
?>
        <tr>
            <td colspan="6">
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

  <!-- Add Data Modal -->
  <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDataModalLabel">Add New OR / Service Invoice</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="insert_invoice.php" method="POST" id="addForm">
          <div class="modal-body">
            <div class="form-group">
              <label for="date_received">Date Received</label>
              <input type="date" class="form-control" name="date_received" required>
            </div>
            <div class="form-group">
              <label for="teller_name">Teller/Collector Name</label>
              <input type="text" class="form-control" name="teller_name" value="<?php echo htmlspecialchars($collector_username); ?>" class="form-control" readonly required>
            </div>
            <div class="form-group">
              <label for="series">Series</label>
              <input type="text" class="form-control" name="series" required>
            </div>
            <div class="form-group">
              <label for="service_invoice">Service Invoice Number</label>
              <input type="text" class="form-control" name="service_invoice" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add_data" class="btn btn-primary">Save Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Data Modal -->
  <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDataModalLabel">Edit OR / Service Invoice</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id" id="edit-id">
            <div class="form-group">
              <label for="edit-date_received">Date Received</label>
              <input type="date" class="form-control" name="date_received" id="edit-date_received" required>
            </div>
            <div class="form-group">
              <label for="edit-teller_name">Teller/Collector Name</label>
              <input type="text" class="form-control" name="teller_name" id="edit-teller_name" readonly required>
            </div>
            <div class="form-group">
              <label for="edit-series">Series</label>
              <input type="text" class="form-control" name="series" id="edit-series" required>
            </div>
            <div class="form-group">
              <label for="edit-service_invoice">Service Invoice Number</label>
              <input type="text" class="form-control" name="service_invoice" id="edit-service_invoice" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>

  <script>
document.addEventListener("DOMContentLoaded", function() {
   document.querySelectorAll(".editBtn").forEach(button => {
       button.addEventListener("click", function() {
           console.log(this.getAttribute("data-id"));
           document.getElementById("edit-id").value = this.getAttribute("data-id");
           document.getElementById("edit-date_received").value = this.getAttribute("data-date_received");
           document.getElementById("edit-teller_name").value = this.getAttribute("data-teller_name");
           document.getElementById("edit-series").value = this.getAttribute("data-series");
           document.getElementById("edit-service_invoice").value = this.getAttribute("data-service_invoice");
       });
   });
});



    // Handle the update process
    document.getElementById('addForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission to show SweetAlert first

        // Show SweetAlert Success message
        Swal.fire({
            title: 'Data added Successfully!',
            text: 'OR/SERVICE INVOICE has been added.',
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

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $date_received = $_POST['date_received'];
    $teller_name = $_POST['teller_name'];
    $series = $_POST['series'];
    $service_invoice = $_POST['service_invoice'];

    $updateQuery = "UPDATE tbl_or_service_invoice SET date_received='$date_received', teller_name='$teller_name', series='$series', service_invoice='$service_invoice' WHERE id='$id'";

    if ($con->query($updateQuery)) {
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Record updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                   
                    window.location.href = 'service_invoce_reports.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update the record.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

?>
