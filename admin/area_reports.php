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
    <h1>AREA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">AREA</a></li>
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
            <h5 class="card-title">AREA<span>| Reports</span></h5>
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div>
              
              </div>
              <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDataModal"><i class="bi bi-plus"></i> Add Area</button>
              </div>
            </div>
            <table class="table table-borderless datatable" id="Customer_Manager_Report">
                            <thead>
                                <tr>
                                <th scope="col" style="text-align: center;">#</th>
                                <th scope="col" style="text-align: center;">AREA NAME</th>
                                <th scope="col" style="text-align: center;">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Query to fetch data from tbl_area
                                    $query = "SELECT * FROM tbl_area";
                                    $result = $con->query($query);

                                    // Check if any rows are returned
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td style="text-align: center; width:50px;"><?php echo $row["id"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                                    <td style="text-align: center; width:50px;">
                                    <button class="btn btn-danger delete-btn" data-id="<?php echo $row['id']; ?>">
    <i class="bi bi-trash"></i> Delete
</button>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                <tr>
                                    <td colspan="3">
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
</main>x
<!-- End Main -->

<?php 
include("footer.php");
?>

<!-- Modal for Adding Data -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">Add Area</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="add_area.php" method="POST" id="addForm">
          <div class="mb-3">
            <label for="area" class="form-label">AREA</label>
            <input type="text" class="form-control" id="area" name="area" required 
                oninput="this.value = this.value.toUpperCase();" 
                pattern="[A-Za-z]+" title="Only letters are allowed">

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
document.addEventListener("DOMContentLoaded", function () {
    // Handle form submission with SweetAlert
    const addForm = document.getElementById("addForm");
    if (addForm) {
        addForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default submission

            Swal.fire({
                title: "Data Added Successfully!",
                text: "Area has been added.",
                icon: "success",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit after alert
                }
            });
        });
    }

    // Handle delete confirmation with SweetAlert
    document.body.addEventListener("click", function (event) {
        let button = event.target.closest(".delete-btn");
        if (button) {
            let areaId = button.getAttribute("data-id");
            let row = button.closest("tr");

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("delete_area.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "id=" + encodeURIComponent(areaId)
                    })
                    .then(response => response.text())
                    .then(data => {
    data = data.trim(); // ✅ Remove extra spaces
    console.log("Server Response:", data); // Debugging

    if (data === "error") {
        Swal.fire("Error!", "Failed to delete the area.", "error");
    } else {
        row.remove();
        Swal.fire("Deleted!", "The area has been deleted.", "success").then(() => {
            // After the Swal closes, redirect to the area_reports.php page
            window.location.href = "area_reports.php";
        });
    }
})
                    .catch(error => {
                        console.error("Fetch error:", error);
                        Swal.fire("Error!", "There was an issue with the deletion.", "error");
                    });
                }
            });
        }
    });
});

</script>

</body>
</html>
