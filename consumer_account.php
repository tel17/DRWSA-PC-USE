<?php


// Include header file
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consumer Account</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 40px;
        }
    </style>
</head>
<>
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center me-auto">
      <img src="./admin/assets/img/NEW-LOGO.png" alt="DRWSA" class="img-fluid me-2">
      <span class="logo-text d-none d-lg-block">DRWSA</span>
    </a>
  </div>
</header>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <h2>Account Details: </h2>
            <h4>Account Name: </h4>
            <h4>Account Number: </h4>
            <h4>Area: </h4>
            <h4>BLK/LOT: </h4>
            <h4>S.C: </h4>
            <h4>Remarks: </h4>
            <h4>Year: </h4>
        </div>

        <?php

// Define months array
$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

// Query to fetch consumer data
$query = "SELECT * FROM consumer_name";
$result = $con->query($query);

// Check if data exists
if (mysqli_num_rows($result) > 0) {
    // Fetch data
    $userData = $result->fetch_assoc();

    // Extract month data
    $monthData = array(
        'January' => $userData['jan'] ?? 'No data',
        'February' => $userData['feb'] ?? 'No data',
        'March' => $userData['mar'] ?? 'No data',
        'April' => $userData['apr'] ?? 'No data',
        'May' => $userData['may'] ?? 'No data',
        'June' => $userData['jun'] ?? 'No data',
        'July' => $userData['jul'] ?? 'No data',
        'August' => $userData['aug'] ?? 'No data',
        'September' => $userData['sep'] ?? 'No data',
        'October' => $userData['oct'] ?? 'No data',
        'November' => $userData['nov'] ?? 'No data',
        'December' => $userData['dec'] ?? 'No data'
    );
} else {
    // Handle no data scenario
    $monthData = array_fill_keys($months, 'No data');
}

// Query to fetch consumer data
$query = "SELECT * FROM conamount";
$result = $con->query($query);

// Check if data exists
if (mysqli_num_rows($result) > 0) {
    // Fetch data
    $userData = $result->fetch_assoc();

    // Extract month data
    $amount = array(
        'January' => $userData['jan'] ?? 'No data',
        'February' => $userData['feb'] ?? 'No data',
        'March' => $userData['mar'] ?? 'No data',
        'April' => $userData['apr'] ?? 'No data',
        'May' => $userData['may'] ?? 'No data',
        'June' => $userData['jun'] ?? 'No data',
        'July' => $userData['jul'] ?? 'No data',
        'August' => $userData['aug'] ?? 'No data',
        'September' => $userData['sep'] ?? 'No data',
        'October' => $userData['oct'] ?? 'No data',
        'November' => $userData['nov'] ?? 'No data',
        'December' => $userData['dec'] ?? 'No data'
    );
} else {
    // Handle no data scenario
    $monthData = array_fill_keys($months, 'No data');
}
// HTML table to display data
?>
                
<?php

// Define months array
$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

// Query to fetch consumer data
$query = "SELECT * FROM ordata";
$result = $con->query($query);

// Check if data exists
if (mysqli_num_rows($result) > 0) {
    // Fetch data
    $userData = $result->fetch_assoc();

    // Extract month data
    $orNumbers = array(
        'January' => $userData['jan'],
        'February' => $userData['feb'],
        'March' => $userData['mar'],
        'April' => $userData['apr'],
        'May' => $userData['may'],
        'June' => $userData['jun'],
        'July' => $userData['jul'],
        'August' => $userData['aug'],
        'September' => $userData['sep'],
        'October' => $userData['oct'],
        'November' => $userData['nov'],
        'December' => $userData['dec']
    );
    
} else {
    // Handle no data scenario
    $monthData = array_fill_keys($months, 'No data');
}
?>
<?php

// Define months array
$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

// Query to fetch consumer data
$query = "SELECT * FROM condate";
$result = $con->query($query);

// Check if data exists
if (mysqli_num_rows($result) > 0) {
    // Fetch data
    $userData = $result->fetch_assoc();

    // Extract month data
    $date = array(
        'January' => $userData['jan'],
        'February' => $userData['feb'],
        'March' => $userData['mar'],
        'April' => $userData['apr'],
        'May' => $userData['may'],
        'June' => $userData['jun'],
        'July' => $userData['jul'],
        'August' => $userData['aug'],
        'September' => $userData['sep'],
        'October' => $userData['oct'],
        'November' => $userData['nov'],
        'December' => $userData['dec']
    );
    
} else {
    // Handle no data scenario
    $monthData = array_fill_keys($months, 'No data');
}
?>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Consumer Account Details</h5>
                    <div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="bi bi-plus"></i> Add Data</button>
                    </div>
                    <table class="table table-bordered datatable" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">Month</th>
                                <th scope="col">Amount</th>
                                <th scope="col">O.R Number</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        <?php foreach ($months as $month) { ?>
            <tr>
                <td><?php echo $month; ?></td>
                <td><?php echo $amount[$month]; ?></td>
                <td><?php echo $orNumbers[$month]; ?></td>
                <td><?php echo date('m/d/Y', strtotime($date[$month])); ?></td>
            </tr>
        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</body>
</html>