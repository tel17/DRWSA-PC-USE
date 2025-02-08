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
    <h1>Reading Reports</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Reading</a></li>
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
            <h5 class="card-title">Reading<span>| Reports</span></h5>
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div>
              
              </div>
              <div>
              <div>
                
              <a href="add_reading.php" class="btn btn-success" title="Edit Information">
                      <i class="bi bi-pencil-square"></i> 
                    </a>
              </div>
              </div>
            </div>
            <table class="table table-borderless datatable" id="Customer_Manager_Report">
                            <thead>
                                <tr>
                                <th scope="col" style="text-align: center;">#</th>
                                <th scope="col" style="text-align: center;">ACCOUNT NUMBER</th>
                                <th scope="col" style="text-align: center;">NAME</th>
                                <th scope="col" style="text-align: center;">AREA</th>
                                <th scope="col" style="text-align: center;">BLOCK AND LOT</th>
                                <th scope="col" style="text-align: center;">PRESENT 1</th>
                                <th scope="col" style="text-align: center;">PREVIOUS 1</th>
                                <th scope="col" style="text-align: center;">PRESENT 2</th>
                                <th scope="col" style="text-align: center;">PREVIOUS 2</th>
                                <th scope="col" style="text-align: center;">CONSUMED</th>
                                <th scope="col" style="text-align: center;">REMARKS</th>
                                <th scope="col" style="text-align: center;">TOTAL CONSUMED</th>
                                <th scope="col" style="text-align: center;">AMOUNT</th>
                                <th scope="col" style="text-align: center;">SENIOR DISCOUNT</th>
                                <th scope="col" style="text-align: center;">FREE OF CHARGE</th>
                                <th scope="col" style="text-align: center;">DISCOUNT</th>
                                <th scope="col" style="text-align: center;">MONTH</th>
                                <th scope="col" style="text-align: center;">CATEGORY</th>
                                <th scope="col" style="text-align: center;">DUE DATE</th>
                                <th scope="col" style="text-align: center;">DISC DATE</th>
                                <th scope="col" style="text-align: center;">BILLING PERIOD</th>
                                <th scope="col" style="text-align: center;">GRAND TOTAL</th>
                                <th scope="col" style="text-align: center;">READER NAME</th>

                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Query to fetch data from tbl_reading
                                    $query = "SELECT * FROM tbl_reading";
                                    $result = $con->query($query);

                                    // Check if any rows are returned
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td style="text-align: center; width:50px;"><?php echo $row["id"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["account_number"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["name"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["blk_lot"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["present_1"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["previous_1"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["present_2"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["previous_2"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["consumed"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["remarks"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["total_consumed"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["amount"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["sc_discount"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["free_of_charge"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["discount"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["month"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["category"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["due_date"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["disc_date"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["billing_period"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["grand_total"]; ?></td>
                                    <td style="text-align: center;"><?php echo $row["reader_name"]; ?></td>
                                    <td style="text-align: center; width:50px;">
                                    <button class="btn btn-danger delete-btn" data-id="<?php echo $row['id']; ?>">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>

                                    <a href="print.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" id="printButton<?php echo $row['id']; ?>" onclick="printReceipt(<?php echo $row['id']; ?>)">
                                            <i class="bi bi-printer"></i> Print
                                        </a>




                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                <tr>
                                    <td colspan="30">
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
