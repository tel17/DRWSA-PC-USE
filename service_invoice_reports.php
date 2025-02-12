<?php
// Retrieve the username from the query parameter
$username = isset($_GET['username']) ? $_GET['username'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Invoice Reports</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href=" js\simple-datatables\style.css" rel="stylesheet">
   
</head>
<body>

    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Darasa Rural Waterworks</a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Welcome, <?php echo htmlspecialchars($username); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" onclick="logout()">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>



    <script>
        function logout() {
            // Redirect the user to the index.php page
            window.location.href = "index.php";
        }
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<?php include("dbcon.php"); ?>

<body>




  <main id="main" class="main">

    <div class="pagetitle">
    
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
            if ($row["teller_name"] == $username ) {
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
  <!-- Add Data Modal -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataModalLabel">Add New OR / Service Invoice</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  method="POST" id="addForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date_received">Date Received</label>
                        <input type="date" class="form-control" name="date_received" required>
                    </div>
                    <div class="form-group">
                        <label for="teller_name">Teller/Collector Name</label>
                        <input type="text" class="form-control" name="teller_name" value="<?php echo htmlspecialchars($username); ?>" class="form-control" readonly required>
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
    // Populate edit form with data when edit button is clicked
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".editBtn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-id").value = this.getAttribute("data-id");
            document.getElementById("edit-date_received").value = this.getAttribute("data-date_received");
            document.getElementById("edit-teller_name").value = this.getAttribute("data-teller_name");
            document.getElementById("edit-series").value = this.getAttribute("data-series");
            document.getElementById("edit-service_invoice").value = this.getAttribute("data-service_invoice");
        });
    });
});


  </script>

</body>
</html>
<?php
if (isset($_POST['add_data'])) {
    $date_received = $_POST['date_received'];
    $teller_name = $_POST['teller_name'];
    $series = $_POST['series'];
    $service_invoice = $_POST['service_invoice'];

    $insertQuery = "INSERT INTO tbl_or_service_invoice (date_received, teller_name, series, service_invoice) VALUES ('$date_received', '$teller_name', '$series', '$service_invoice')";
    
    if ($con->query($insertQuery)) {
        echo "<script>
            window.location.href = 'service_invoice_reports.php?username=$username';
        </script>";
    } else {
        echo "<script>
            alert('Failed to add the record.');
        </script>";
    }
}
?>
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
            window.location.href = 'service_invoice_reports.php?username=$username';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update the record.');
        </script>";
    }
}
?>
