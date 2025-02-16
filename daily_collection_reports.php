<?php
include("dbcon.php");
include("header.php");
?>
<body>

<main  class="main">
  <div class="pagetitle">
    <h1>Daily Collection Reports</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Daily Collection</a></li>
        <li class="breadcrumb-item active">Reports</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Daily Collection<span>| Reports</span></h5>
            
           <!-- Filter Form -->
<form method="GET" action="" id="filterForm">
  <div class="row">
    <div class="col-md-4">
      <label for="month">Month:</label>
      <select name="month" class="form-control auto-submit">
        <option value="">All</option>
        <?php for ($m = 1; $m <= 12; $m++): ?>
          <option value="<?php echo $m; ?>" <?php echo (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : ''; ?>>
            <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
          </option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="col-md-4">
      <label for="day">Day:</label>
      <select name="day" class="form-control auto-submit">
        <option value="">All</option>
        <?php for ($d = 1; $d <= 31; $d++): ?>
          <option value="<?php echo $d; ?>" <?php echo (isset($_GET['day']) && $_GET['day'] == $d) ? 'selected' : ''; ?>>
            <?php echo $d; ?>
          </option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="col-md-4">
      <label for="year">Year:</label>
      <select name="year" class="form-control auto-submit">
        <option value="">All</option>
        <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
          <option value="<?php echo $y; ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $y) ? 'selected' : ''; ?>>
            <?php echo $y; ?>
          </option>
        <?php endfor; ?>
      </select>
    </div>
  </div>
</form>

            <br>
            
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Account Number</th>
                  <th>Name</th>
                  <th>Month</th>
                  <th>O.R #</th>
                  <th>Amount</th>
                  <th>Penalty</th>
                  <th>SC</th>
                  <th>Discount</th>
                  <th>Blk/Lot</th>
                  <th>Area</th>
                  <!-- <th>CREATED AT </th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM tbl_daily_collection_report WHERE 1=1";
                
                if (!empty($_GET['month'])) {
                    $query .= " AND MONTH(created_at) = ".intval($_GET['month']);
                }
                if (!empty($_GET['day'])) {
                    $query .= " AND DAY(created_at) = ".intval($_GET['day']);
                }
                if (!empty($_GET['year'])) {
                    $query .= " AND YEAR(created_at) = ".intval($_GET['year']);
                }
                
                $result = $con->query($query);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $row["id"]; ?></td>
                  <td><?php echo $row["account_number"]; ?></td>
                  <td><?php echo $row["name"]; ?></td>
                  <td><?php echo date('F', strtotime($row["created_at"])); ?></td>
                  <td><?php echo $row["or_number"]; ?></td>
                  <td><?php echo $row["amount"]; ?></td>
                  <td><?php echo $row["penalty"]; ?></td>
                  <td><?php echo $row["SC"]; ?></td>
                  <td><?php echo $row["discount"]; ?></td>
                  <td><?php echo $row["blk_lot"]; ?></td>
                  <td><?php echo $row["area"]; ?></td>
                  <!-- <td><?php echo $row["created_at"]; ?></td> -->
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                <tr>
                <td colspan="12" class="text-center">No records found.</td>
                </tr>

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
<?php include("footer.php"); ?>


<script>
 

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.auto-submit').forEach(function (select) {
      select.addEventListener('change', function () {
        document.getElementById('filterForm').submit();
      });
    });
  });


</script>

</body>
</html>
