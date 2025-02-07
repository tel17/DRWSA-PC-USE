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
    <h1>Collector's Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Collector's Profile</a></li>
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
            <h5 class="card-title">Collector's Profile<span>| Reports</span></h5>
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
                  <th scope="col" style="text-align: center;">FULLNAME</th>
                  <th scope="col" style="text-align: center;">USERNAME</th>
                  <th scope="col" style="text-align: center;">PASSWORD</th>
                  <th scope="col" style="text-align: center;">Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      // Query to fetch data from tbl_maintenance
                      $query = "SELECT * FROM tbl_collectors_profile";
                      $result = $con->query($query);

                      // Check if any rows are returned
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                  ?>
                 <tr>
                    <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["fullname"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["username"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["password"]; ?></td>

                    <!-- Edit Button -->
                    <td>
                    
                    <td>
    <button type="button" class="btn btn-primary edit-btn"
        data-id="<?php echo $row['id']; ?>"
        data-fullname="<?php echo $row['fullname']; ?>"
        data-username="<?php echo $row['username']; ?>"
        data-password="<?php echo $row['password']; ?>"
        data-toggle="modal"
        data-target="#editDataModal">
        <i class="bi bi-pencil"></i> EDIT DATA
    </button>
</td>
  
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
        <form action="add_collecters_profile.php" method="POST" id="addForm">
          <div class="mb-3">
            <label for="fullname" class="form-label">fullname</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
         
         
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" required>
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


<!-- Modal for Editing Data -->
<!-- Modal for Editing Data -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editDataModalLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="edit_collectors_profile.php" method="POST" id="editForm">
          <input type="hidden" id="editId" name="id">

          <div class="mb-3">
            <label for="editFullname" class="form-label">Fullname</label>
            <input type="text" class="form-control" id="editFullname" name="fullname" required>
          </div>

          <div class="mb-3">
            <label for="editUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="editUsername" name="username" required>
          </div>

          <div class="mb-3">
            <label for="editPassword" class="form-label">Password</label>
            <input type="text" class="form-control" id="editPassword" name="password" required>
          </div>

          <div style="float:right;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save Changes</button>
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
      text: 'Collectors profile  has been added.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Submit the form after closing the SweetAlert
        this.submit();
      }
    });
  });
   // Trigger SweetAlert after form submission
   document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission to show SweetAlert first

    // Show SweetAlert Success message
    Swal.fire({
      title: 'Data Updated Successfully!',
      text: 'Collectors profile  has been updated.',
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
    // Get all edit buttons
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Get data from button attributes
            const id = this.getAttribute("data-id");
            const fullname = this.getAttribute("data-fullname");
            const username = this.getAttribute("data-username");
            const password = this.getAttribute("data-password");

            // Set modal input fields
            document.getElementById("editId").value = id;
            document.getElementById("editFullname").value = fullname;
            document.getElementById("editUsername").value = username;
            document.getElementById("editPassword").value = password;
        });
    });
});

</script>

</body>
</html>
