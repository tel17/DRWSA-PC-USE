<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
 // Ensure database connection
?>
<body>
<?php
include("topbar.php");
include("sidebar.php");
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Water Rate Residential</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Water Rate Residential</a></li>
        <li class="breadcrumb-item active">Reports</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Water Rate Residential <span>| Reports</span></h5>
            <table class="table table-borderless datatable" id="Customer_Manager_Report">
              <thead>
                <tr>
                  <th style="text-align: center;" >#</th>
                  <th style="text-align: center;" >CATEGORY</th>
                  <th style="text-align: center;" >0 - 5 CuM</th>
                  <th style="text-align: center;" >6 - 10 CuM</th>
                  <th style="text-align: center;" >11 - 20 CuM</th>
                  <th style="text-align: center;" >21 - 30 CuM </th>
                  <th style="text-align: center;" >31 - 40 CuM</th>
                  <th style="text-align: center;" >41 - 50 CuM</th>
                  <th style="text-align: center;" >Over 50 CuM</th>
                  <th style="text-align: center; wdith: 15px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      $query = "SELECT * FROM tb_tariff";
                      $result = $con->query($query) or die("Error: " . $con->error);
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                      <td style="text-align: center;" ><?php echo $row["id"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["category"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["first"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["second"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["third"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["fourth"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["fifth"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["sixth"]; ?></td>
                      <td style="text-align: center;" ><?php echo $row["last"]; ?></td>
                      <td style="text-align: center; wdith: 15px;">
                      <button type="button" class="btn btn-warning editBtn" data-toggle="modal" data-target="#editModal" 
                          data-id="<?php echo $row["id"]; ?>" 
                          data-category="<?php echo $row["category"]; ?>"
                          data-first="<?php echo $row["first"]; ?>"
                          data-second="<?php echo $row["second"]; ?>"
                          data-third="<?php echo $row["third"]; ?>"
                          data-fourth="<?php echo $row["fourth"]; ?>"
                          data-fifth="<?php echo $row["fifth"]; ?>"
                          data-sixth="<?php echo $row["sixth"]; ?>"
                          data-last="<?php echo $row["last"]; ?>">
                          <i class="bi bi-pencil-square"></i> UPDATE PRICE
                      </button>
                  </td>

                  </tr>
                  <?php
                          }
                      } else {
                  ?>
                  <tr>
                      <td colspan="10" class="text-center">No data available at the moment.</td>
                  </tr>
                  <?php
                      }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Water Rate</h5>
           
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" id="edit-category" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>First</label>
                        <input type="text" name="first" id="edit-first" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Second</label>
                        <input type="text" name="second" id="edit-second" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Third</label>
                        <input type="text" name="third" id="edit-third" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fourth</label>
                        <input type="text" name="fourth" id="edit-fourth" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fifth</label>
                        <input type="text" name="fifth" id="edit-fifth" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Sixth</label>
                        <input type="text" name="sixth" id="edit-sixth" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Last</label>
                        <input type="text" name="last" id="edit-last" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".editBtn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-id").value = this.getAttribute("data-id");
            document.getElementById("edit-category").value = this.getAttribute("data-category");
            document.getElementById("edit-first").value = this.getAttribute("data-first");
            document.getElementById("edit-second").value = this.getAttribute("data-second");
            document.getElementById("edit-third").value = this.getAttribute("data-third");
            document.getElementById("edit-fourth").value = this.getAttribute("data-fourth");
            document.getElementById("edit-fifth").value = this.getAttribute("data-fifth");
            document.getElementById("edit-sixth").value = this.getAttribute("data-sixth");
            document.getElementById("edit-last").value = this.getAttribute("data-last");
        });
    });
});
</script>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $first = $_POST['first'];
    $second = $_POST['second'];
    $third = $_POST['third'];
    $fourth = $_POST['fourth'];
    $fifth = $_POST['fifth'];
    $sixth = $_POST['sixth'];
    $last = $_POST['last'];

    $updateQuery = "UPDATE tb_tariff SET category='$category', first='$first', second='$second', third='$third', fourth='$fourth', fifth='$fifth', sixth='$sixth', last='$last' WHERE id='$id'";
    
    if ($con->query($updateQuery)) {
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Record updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'water_rate_reports_residential.php';
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

<?php include("footer.php"); ?>
</body>
</html>
