<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

<?php include("topbar.php"); ?>

<?php include("sidebar.php"); ?>


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

            <!-- Filters -->
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div>
                <form method="GET" action="">
                  <!-- Area Filter -->
                  <label for="areaFilter">Filter by Area:</label>
                  <select name="areaFilter" id="areaFilter" onchange="this.form.submit()">
                    <option value="">ALL</option>
                    <?php
                    // Fetch areas from tbl_area
                    $areaQuery = "SELECT DISTINCT area FROM tbl_area";
                    $areaResult = $con->query($areaQuery);
                    while ($areaRow = $areaResult->fetch_assoc()) {
                        $selected = (isset($_GET['areaFilter']) && $_GET['areaFilter'] == $areaRow['area']) ? 'selected' : '';
                        echo "<option value='{$areaRow['area']}' {$selected}>{$areaRow['area']}</option>";
                    }
                    ?>
                  </select>
                  
                  <!-- Status Filter -->
                  <label for="statusFilter">Filter by Status:</label>
                  <select name="statusFilter" id="statusFilter" onchange="this.form.submit()">
                    <option value="">ALL</option>
                    <option value="unpaid" <?php echo (isset($_GET['statusFilter']) && $_GET['statusFilter'] == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>
                    <option value="collector" <?php echo (isset($_GET['statusFilter']) && $_GET['statusFilter'] == 'collector') ? 'selected' : ''; ?>>Paid to Collector</option>
                    <option value="cashier" <?php echo (isset($_GET['statusFilter']) && $_GET['statusFilter'] == 'cashier') ? 'selected' : ''; ?>>Paid to Cashier</option>
                    <option value="free" <?php echo (isset($_GET['statusFilter']) && $_GET['statusFilter'] == 'free') ? 'selected' : ''; ?>>Free of Charge</option>
                  </select>
                </form>
              </div>

              <a href="add_reading.php?areaFilter=<?php echo isset($_GET['areaFilter']) ? $_GET['areaFilter'] : ''; ?>" class="btn btn-success" title="Edit Information">
                <i class="bi bi-plus-square"></i> 
              </a>
            </div>

            <table class="table table-borderless datatable" id="Customer_Manager_Report">
              <thead>
                <tr>
                  <th scope="col" style="text-align: center;">ACTION</th>
                  <th scope="col" style="text-align: center;">STATUS</th>
                  <th scope="col" style="text-align: center;">DATE PAID</th>
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
                  <th scope="col" style="text-align: center;">OR NUMBER</th>
                  <th scope="col" style="text-align: center;">GRAND TOTAL</th>
                  <th scope="col" style="text-align: center;">READER NAME</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    // Get selected filters
                    $areaFilter = isset($_GET['areaFilter']) ? $_GET['areaFilter'] : '';
                    $statusFilter = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : '';

                    // Modify query based on the filters
                    $query = "SELECT * FROM tbl_reading WHERE 1";

                    if ($areaFilter) {
                        $query .= " AND area = '$areaFilter'";
                    }
                    if ($statusFilter) {
                        $query .= " AND payment_status = '$statusFilter'";
                    }

                    $result = $con->query($query);

                    // Check if any rows are returned
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td style="text-align: center; width: 150px; display: flex; justify-content: space-between; align-items: center;">
                        <button class="btn btn-danger delete-btn" data-id="<?php echo $row['id']; ?>">
                            <i class="bi bi-trash"></i> 
                        </button>
                        <a href="print.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" id="printButton<?php echo $row['id']; ?>" onclick="printReceipt(<?php echo $row['id']; ?>)">
                            <i class="bi bi-printer"></i>
                        </a>
                        <button class="btn btn-warning edit-btn" data-toggle="modal" data-target="#editPaymentModal" 
                            data-status="<?php echo $row['payment_status']; ?>"
                            data-account-number="<?php echo $row['account_number']; ?>"
                            data-name="<?php echo $row['name']; ?>"
                            data-reading-id="<?php echo $row['id']; ?>"
                            <?php if ($row["payment_status"] !== 'unpaid') echo 'disabled title="Cannot edit paid records"'; ?>>
                            <i class="bi bi-pencil-square"></i>
                        </button>



                    </td>

                    <td style="text-align: center; width:50px;">
                        <?php 
                            $payment_status = $row["payment_status"]; 
                            // Determine the badge class based on payment status
                            if ($payment_status == "unpaid") {
                                echo '<span class="badge bg-danger">Unpaid</span>';
                            } elseif ($payment_status == "collector") {
                                echo '<span class="badge bg-warning">Paid to Collector</span>';
                            } elseif ($payment_status == "cashier") {
                                echo '<span class="badge bg-info">Paid to Cashier</span>';
                            } elseif ($payment_status == "free") {
                                echo '<span class="badge bg-success">Free of Charge</span>';
                            } else {
                                echo '<span class="badge bg-secondary">Unknown</span>';
                            }
                        ?>
                    </td>
                    <td style="text-align: center; center; width: 150px;"><?php echo $row["date_paid"]; ?></td>

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
                    <td style="text-align: center;"><?php echo $row["or_number"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["grand_total"]; ?></td>
                    <td style="text-align: center;"><?php echo $row["reader_name"]; ?></td>
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
// Handle delete confirmation with SweetAlert
document.addEventListener("DOMContentLoaded", function () {
    document.body.addEventListener("click", function (event) {
        let button = event.target.closest(".delete-btn");
        if (button) {
            let areaId = button.getAttribute("data-id");
            let row = button.closest("tr");

            // Get the area filter value from the URL
            let areaFilter = new URLSearchParams(window.location.search).get('areaFilter');
            let statusFilter = new URLSearchParams(window.location.search).get('statusFilter');

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
                    fetch("delete_reading.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "id=" + encodeURIComponent(areaId)
                    })
                    .then(response => response.text())
                    .then(data => {
                        data = data.trim(); // ✅ Remove extra spaces
                        console.log("Server Response:", data); // Debugging

                        if (data === "error") {
                            Swal.fire("Error!", "Failed to delete the record.", "error");
                        } else {
                            row.remove();
                            Swal.fire("Deleted!", "The record has been deleted.", "success").then(() => {
                                // After the Swal closes, redirect to the reading_reports.php page with filters
                                let newUrl = "reading_reports.php";
                                if (areaFilter) newUrl += "?areaFilter=" + encodeURIComponent(areaFilter);
                                if (statusFilter) newUrl += "&statusFilter=" + encodeURIComponent(statusFilter);
                                window.location.href = newUrl;
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

<?php include('edit_payment_modal.php'); ?>

<script>
$(document).ready(function() {
    // Ensure jQuery is loaded
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded!');
        return;
    }

    // Handle edit button click
    $(document).on('click', '.edit-btn', function(e) {
        try {
            if ($(this).is(':disabled')) {
                return false;
            }
            
            // Get data from the button
            var accountNumber = $(this).data('account-number');
            var name = $(this).data('name');
            var readingId = $(this).data('reading-id');
            
            console.log('Account Number:', accountNumber);
            console.log('Name:', name);
            console.log('Reading ID:', readingId);
            
            // Populate modal fields
            $('#account_number').val(accountNumber);
            $('#name').val(name);
            $('#readingId').val(readingId);
            
            // Debug: Check if fields are being set
            console.log('Modal Account Number:', $('#account_number').val());
            console.log('Modal Name:', $('#name').val());
            console.log('Modal Reading ID:', $('#readingId').val());
            
            // Ensure modal is properly initialized
            $('#editPaymentModal').modal('show');
        } catch (error) {
            console.error('Error in edit button click handler:', error);
        }
    });




});
</script>



</body>
</html>
