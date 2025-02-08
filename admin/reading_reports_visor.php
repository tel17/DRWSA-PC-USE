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
                            <tbody id="link_wrapper">
                                <tr>
                            </tr>
                                <!-- Data will be dynamically inserted here by the XHR request -->
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
// Function to load data dynamically using XMLHttpRequest
function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("link_wrapper").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "fetch_data_reading_reports.php", true);
  xhttp.send();
}

// Set interval to refresh data every 1 second (1000 milliseconds)
setInterval(function(){
  loadXMLDoc();
}, 1000);

// Load data on page load
window.onload = loadXMLDoc;
</script>

</body>
</html>
