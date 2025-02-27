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
    <h1>Meter Replacement</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Meter Replacement</a></li>
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
            <h5 class="card-title">Meter Replacement<span>| Reports</span></h5>
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
            <br>
               <!-- Filter Inputs -->
          <!-- Filter Inputs -->
<div class="row mb-2">
    <div class="col-md-3">
        <input type="text" class="form-control" id="filterName" placeholder="Filter by Name">
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" id="filterArea" placeholder="Filter by Area">
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" id="filterBlockLot" placeholder="Filter by Block & Lot">
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" id="filterYear" placeholder="Filter by Year">
    </div>
</div>

            <table class="table table-borderless datatable" id="Customer_Manager_Report">
              <thead>
                <tr>
                  <th scope="col" style="text-align: center;">#</th>
                  <th scope="col" style="text-align: center;">NAME</th>
                  <th scope="col" style="text-align: center;">AREA</th>
                  <th scope="col" style="text-align: center;">BLK&LOT</th>
                  <th scope="col" style="text-align: center;">OLD READING</th>
                  <th scope="col" style="text-align: center;">NEW READING</th>
                  <th scope="col" style="text-align: center;">SERIAL NUMBER</th>
                  <th scope="col" style="text-align: center;">DATE FILED</th>
                  <th scope="col" style="text-align: center;">YEAR</th>
                  <th scope="col" style="text-align: center;">REMARKS</th>
                  <th scope="col" style="text-align: center;">MID</th>
                  <th scope="col" style="text-align: center;">STATUS</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      // Query to fetch data from tbl_maintenance
                      $query = "SELECT * FROM tbl_meter_replacement";
                      $result = $con->query($query);

                      // Check if any rows are returned
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                      <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["name"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["block_lot"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["old_reading"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["new_reading"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["serial_number"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["date_filed"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["year"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["remarks"]; ?></td>
                      <td style="text-align: center;"><?php echo $row["mid"]; ?></td>
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
        <form action="add_meter_replacement.php" method="POST" id="addForm">
          <div class="mb-3">
            <label for="name" class="form-label">NAME</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="mb-3">
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

         
          <div class="mb-3">
            <label for="block_lot" class="form-label">BLOCK&LOT</label>
            <input type="text" class="form-control" id="block_lot" name="block_lot" required>
          </div>

          <div class="mb-3">
            <label for="old_reading" class="form-label">OLD READING</label>
            <input type="text" class="form-control" id="old_reading" name="old_reading" required>
          </div>

          <div class="mb-3">
            <label for="new_reading" class="form-label">NEW READING</label>
            <input type="text" class="form-control" id="new_reading" name="new_reading" required>
          </div>

          <div class="mb-3">
            <label for="serial_number" class="form-label">SERIAL NUMBER</label>
            <input type="text" class="form-control" id="serial_number" name="serial_number" required>
          </div>

          <div class="mb-3">
            <label for="date_filed" class="form-label">DATE FILED</label>
            <input type="date" class="form-control" id="date_filed" name="date_filed" required>
          </div>

          <div class="mb-3">
                    <label for="year" class="form-label" hidden>Year</label>
                    <input type="text" class="form-control" id="year" name="year" required readonly hidden>
          </div>

          <div class="mb-3">
            <label for="remarks" class="form-label">REMARKS</label>
            <input type="text" class="form-control" id="remarks" name="remarks" required>
          </div>

          <div class="mb-3">
            <label for="mid" class="form-label">MID</label>
            <input type="number" class="form-control" id="mid" name="mid" required>
          </div>

          
          
          <div style="float:right;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit</button>
            
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
      text: 'Meter Replacement  has been added.',
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


document.addEventListener("DOMContentLoaded", function () {
    // Initialize Simple DataTable
    const table = new simpleDatatables.DataTable("#Customer_Manager_Report");

    // Function to apply column-based filtering
    function applyFilter() {
        let nameFilter = document.getElementById("filterName").value.toLowerCase();
        let areaFilter = document.getElementById("filterArea").value.toLowerCase();
        let blockLotFilter = document.getElementById("filterBlockLot").value.toLowerCase();
        let yearFilter = document.getElementById("filterYear").value.toLowerCase();

        // Get all table rows
        document.querySelectorAll("#Customer_Manager_Report tbody tr").forEach(row => {
            let nameCell = row.cells[1].textContent.toLowerCase();
            let areaCell = row.cells[2].textContent.toLowerCase();
            let blockLotCell = row.cells[3].textContent.toLowerCase();
            let yearCell = row.cells[8].textContent.toLowerCase();

            // Match filters, if empty, allow all
            let showRow = 
                (nameFilter === "" || nameCell.includes(nameFilter)) &&
                (areaFilter === "" || areaCell.includes(areaFilter)) &&
                (blockLotFilter === "" || blockLotCell.includes(blockLotFilter)) &&
                (yearFilter === "" || yearCell.includes(yearFilter));

            row.style.display = showRow ? "" : "none"; // Hide or show row
        });
    }

    // Attach event listeners to filter inputs
    document.getElementById("filterName").addEventListener("input", applyFilter);
    document.getElementById("filterArea").addEventListener("input", applyFilter);
    document.getElementById("filterBlockLot").addEventListener("input", applyFilter);
    document.getElementById("filterYear").addEventListener("input", applyFilter);
});
// for getting year today
document.getElementById('year').value = new Date().getFullYear();
</script>

</body>
</html>
