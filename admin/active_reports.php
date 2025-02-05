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

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Active</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Active</a></li>
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
            <h5 class="card-title">Active<span>| Reports</span></h5>
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div>
                <button type="button" class="btn btn-light" id="printBtn" title="Print Table">PRINT</button>
                <button type="button" class="btn btn-light" id="pdfBtn" title="Download PDF">PDF</button>
                <button type="button" class="btn btn-light" id="excelBtn" title="Download Excel">EXCEL</button>
              </div>
              <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDataModal"><i class="bi bi-plus"></i> Add Data</button>
              </div>
            </div>
            <table class="table table-borderless datatable" id="Customer_Manager_Report">
              <thead>
                <tr>
                  <th scope="col" style="text-align: center;">#</th>
                  <th scope="col" style="text-align: center;">ACCOUNT NUMBER</th>
                  <th scope="col" style="text-align: center;">NAME</th>
                  <th scope="col" style="text-align: center;">CONSUMER STATUS</th>
                  <th scope="col" style="text-align: center;">AREA</th>
                  <th scope="col" style="text-align: center;">BLK/LOT</th>
                  <th scope="col" style="text-align: center;">READING</th>
                  <th scope="col" style="text-align: center;">DATE RECON</th>
                  <th scope="col" style="text-align: center;">MONTH</th>
                  <th scope="col" style="text-align: center;">MAINTENANCE</th>
                  <th scope="col" style="text-align: center;">REMARKS</th>
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
                      <td style="text-align: center;"><?php echo $row["consumer_status_active"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["blk_lot"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["reading"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["date_reconnected"]; ?></td>
                      <td style="text-align: center;">
                            <?php 
                                // Assuming $row["billing_month"] is in the DATE format (YYYY-MM-DD)
                                echo date("F Y", strtotime($row["billing_month"])); // Format as 'Month Year' (e.g., February 2025)
                            ?>
                        </td>
                      <td style="text-align: center;"><?php echo $row["maintenance"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["remarks"]; ?></td>
          
                     
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
                    <label for="account_number_active" class="form-label">Account Number</label>
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
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="consumer_status_active" class="form-label">Consumer Status Active</label>
                    <input type="text" class="form-control" id="consumer_status_active" name="consumer_status_active" readonly>
                </div>

                <div class="col-md-6">
                    <label for="area" class="form-label">Area</label>
                    <input type="text" class="form-control" id="area" name="area" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="blk_lot" class="form-label">Blk/Lot</label>
                    <input type="text" class="form-control" id="blk_lot" name="blk_lot" readonly>
                </div>

                <div class="col-md-6">
                    <label for="reading" class="form-label">Reading</label>
                    <input type="text" class="form-control" id="reading" name="reading" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date_reconnected" class="form-label">Date Reconnected</label>
                    <input type="date" class="form-control" id="date_reconnected" name="date_reconnected" required>
                </div>

                <div class="col-md-6">
                    <label for="billing_month" class="form-label">Billing Month</label>
                    <input type="month" class="form-control" id="billing_month" name="billing_month" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="maintenance" class="form-label">Maintenance</label>
                    <input type="text" class="form-control" id="maintenance" name="maintenance" required>
                </div>

                <div class="col-md-6">
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

<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- jsPDF-AutoTable (plugin for tables in PDF) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.17/jspdf.plugin.autotable.min.js"></script>
<!-- XLSX.js for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>


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

  // Print Functionality
  document.getElementById('printBtn').addEventListener('click', function() {
    const table = document.getElementById('Customer_Manager_Report');
    const cloneTable = table.cloneNode(true);

    // Remove last column (buttons) from clone
    const rows = cloneTable.querySelectorAll('tr');
    rows.forEach(row => {
        const cells = row.querySelectorAll('td, th');
        if (cells.length === 7) {
            row.removeChild(cells[6]); // Remove last cell
        }
    });

    // Replace interactive elements in the header with plain text
    const headerCells = cloneTable.querySelectorAll('thead th');
    headerCells.forEach((headerCell) => {
        const button = headerCell.querySelector('button');
        if (button) {
            headerCell.textContent = button.textContent; // Replace with button text
        }
    });

    // Create a print-friendly window
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
      <html>
        <head>
          <title>Customer Manager Report</title>
          <style>
            body { font-family: Arial, sans-serif; padding: 20px; }
            table { width: 100%; border-collapse: collapse; }
            table, th, td { border: 1px solid black; }
            th, td { padding: 8px; text-align: left; }
          </style>
        </head>
        <body>
          <h1>Customer Manager Report</h1>
          ${cloneTable.outerHTML}
        </body>
      </html>
    `);
    printWindow.document.close();
    printWindow.print();
  });

  // PDF Download Functionality
  document.getElementById('pdfBtn').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape');

    doc.text('Customer Manager Report', 10, 10);

    doc.autoTable({
      html: '#Customer_Manager_Report',
      startY: 20,
      columnStyles: {
        6: { cellWidth: 0 }
      },
    });

    // Get the current date in YYYY-MM-DD format
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0]; // '2025-01-14'

    // Append the date to the file name
    const fileName = `Customer_Manager_Report${formattedDate}.pdf`;

    // Save the file with the new name
    doc.save(fileName);
});

  // Excel Download Functionality
  document.getElementById('excelBtn').addEventListener('click', function () {
    const table = document.getElementById('Customer_Manager_Report');
    const ws = XLSX.utils.table_to_sheet(table, { raw: true });

    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Customer_Manager_Report');

    // Get the current date in YYYY-MM-DD format
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0]; // '2025-01-14'

    // Append the date to the file name
    const fileName = `Customer_Manager_Report_${formattedDate}.xlsx`;

    // Save the file with the new name
    XLSX.writeFile(wb, fileName);
});





// Pass the PHP array to JavaScript
var accountData = <?php echo json_encode($accountData); ?>;

document.getElementById("account_number_active").addEventListener("input", function () {
    var selectedAccount = this.value;

    // Check if the selected account number exists in the accountData
    if (selectedAccount && accountData[selectedAccount]) {
        // Populate the fields with the selected account's data
        document.getElementById("name").value = accountData[selectedAccount]?.name || "";
        document.getElementById("consumer_status_active").value = accountData[selectedAccount]?.consumer_status || "";
        document.getElementById("area").value = accountData[selectedAccount]?.area || "";
        document.getElementById("blk_lot").value = accountData[selectedAccount]?.blk_lot || "";
    } else {
        // Clear the fields if no account number is selected or not valid
        document.getElementById("name").value = "";
        document.getElementById("consumer_status_active").value = "";
        document.getElementById("area").value = "";
        document.getElementById("blk_lot").value = "";
    }
});
</script>

</body>
</html>
