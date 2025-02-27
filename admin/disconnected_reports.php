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
    <h1>Disconnected</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Disconnected</a></li>
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
            <h5 class="card-title">Disconnected<span>| Reports</span></h5>
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div>
                <button type="button" class="btn btn-light" id="printBtn" title="Print Table">PRINT</button>
                <button type="button" class="btn btn-light" id="pdfBtn" title="Download PDF">PDF</button>
                <button type="button" class="btn btn-light" id="excelBtn" title="Download Excel">EXCEL</button>
              </div>
             
            </div><br>

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
                  <th scope="col" style="text-align: center;">DATE DISCON</th>
                  <th scope="col" style="text-align: center;">MONTH</th>
                  <th scope="col" style="text-align: center;">YEAR</th>
                  <th scope="col" style="text-align: center;">DISCONNECTOR</th>
                  <th scope="col" style="text-align: center;">REMARKS</th>
             
                  <th scope="col" style="text-align: center;">Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      // Query to fetch data from tbl_disconnected
                      $query = "SELECT * FROM tbl_disconnected";
                      $result = $con->query($query);

                      // Check if any rows are returned
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                      <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["account_number_disconnected"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["name"]; ?></td>
                      <!-- <td style="text-align: center;"><?php echo $row["consumer_status_disconnected"]; ?></td> -->
                      <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["blk_lot"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["reading"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["date_disconnected"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["month"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["year"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["disconnector"]; ?></td>
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
        <form action="add_disconnected_reports.php" method="POST" id="addForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="account_number_disconnected" class="form-label">Account Number Disconnected</label>
                    <input list="account_numbers" class="form-control" id="account_number_disconnected" name="account_number_disconnected" required>
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
                <!-- <div class="col-md-6">
                    <label for="consumer_status_disconnected" class="form-label">Consumer Status Disconnected</label>
                    <input type="text" class="form-control" id="consumer_status_disconnected" name="consumer_status_disconnected" readonly>
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
                    <label for="date_disconnected" class="form-label">Date Disconnected</label>
                    <input type="date" class="form-control" id="date_disconnected" name="date_disconnected" required>
                </div>
            </div>

            <div class="row mb-3">
               

                <div class="col-md-6">
                    <label for="month" class="form-label">Billing Month</label>
                    <input type="month" class="form-control" id="month" name="month" required>
                </div>  
                <div class="col-md-6">
                    <label for="disconnector" class="form-label">Disconnector</label>
                    <input type="text" class="form-control" id="disconnector" name="disconnector" required>
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
      text: 'Disconnected  has been added.',
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




// to show data

var accountData = <?php echo json_encode($accountData); ?>;

document.getElementById("account_number_disconnected").addEventListener("input", function () {
    var selectedAccount = this.value;

    // Check if the selected account number exists in the accountData
    if (selectedAccount && accountData[selectedAccount]) {
        // Populate the fields with the selected account's data
        document.getElementById("name").value = accountData[selectedAccount]?.name || "";
        // document.getElementById("consumer_status_disconnected").value = accountData[selectedAccount]?.consumer_status || "";
        document.getElementById("area").value = accountData[selectedAccount]?.area || "";
        document.getElementById("blk_lot").value = accountData[selectedAccount]?.blk_lot || "";
    } else {
        // Clear the fields if no account number is selected or not valid
        document.getElementById("name").value = "";
        // document.getElementById("consumer_status_disconnected").value = "";
        document.getElementById("area").value = "";
        document.getElementById("blk_lot").value = "";
    }
});



// for filtering 

document.addEventListener("DOMContentLoaded", function () {
    // Function to apply column-based filtering
    function applyFilter() {
        let nameFilter = document.getElementById("filterName").value.trim().toLowerCase();
        let blockLotFilter = document.getElementById("filterBlockLot").value.trim().toLowerCase();

        // Get all table rows
        document.querySelectorAll("#Customer_Manager_Report tbody tr").forEach(row => {
            let nameCell = row.cells[2].textContent.trim().toLowerCase(); // NAME column
            let blockLotCell = row.cells[4].textContent.trim().toLowerCase(); // BLOCK & LOT column

            // Check if Name matches, then refine with Block & Lot
            let nameMatches = nameFilter === "" || nameCell.includes(nameFilter);
            let blockLotMatches = blockLotFilter === "" || blockLotCell.includes(blockLotFilter);

            // Show row only if both conditions match
            row.style.display = (nameMatches && blockLotMatches) ? "" : "none";
        });
    }

    // Attach event listeners to filter inputs
    document.getElementById("filterName").addEventListener("input", applyFilter);
    document.getElementById("filterBlockLot").addEventListener("input", applyFilter);
});
// for getting year today
document.getElementById('year').value = new Date().getFullYear();
</script>

</script>

</body>
</html>
