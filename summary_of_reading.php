<?php include("dbcon.php"); ?>
<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darasa Rural Waterworks</title>

    <!-- Bootstrap CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <style>
        .nav-container {
            background-color: #1a68d6;
            text-align: center;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
            padding: 10px;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: calc(100vh - 60px);
            margin-top: 50px;
            padding: 20px;
            padding-top: 100px;
            gap: 20px;
            justify-items: center;
        }

        .column {
            padding: 20px;
            text-align: center;
            height: 100%;
            overflow-y: auto;
            width: 80%;
        }

        .column-right {
            width: 100%;
        }

        .form-input, .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            color: #333;
        }
        .form-container {
        width: 100%;
        max-width: 500px;
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    
        #Customer_Manager_Report_filter {
            display: none;
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <h1>SUMMARY OF READINGS</h1>
        <div class="form-group">
            <label for="date" class="form-label" style="font-size: 20px;">DATE: <p id="date" class="date-time"></p></label>
            <label for="time" class="form-label" style="font-size: 20px; margin-left:250px;">TIME: <p id="time" class="date-time"></p></label>
        </div>
    </div>

    <div class="row">
    

<div class="column">
<h3>Customer Information</h3>
    <div class="form-container">
       
        <div class="form-group">
            <label for="account_number">ACCOUNT NUMBER:</label>
            <input type="text" id="account_number" class="form-control" placeholder="Account number">
        </div>

        <div class="form-group">
            <label for="name">NAME:</label>
            <input type="text" id="name" class="form-control" placeholder="Name">
        </div>

        <div class="form-group">
            <label for="blk_lot">BLOCK AND LOT:</label>
            <input type="text" id="blk_lot" class="form-control" placeholder="Block and Lot">
        </div>

        <div class="form-group">
            <label for="timestamp">YEAR:</label>
            <input type="number" id="timestamp" class="form-control" placeholder="Year">
        </div>
    </div>
</div>

        <div class="column column-right">
            <h3>Account Data</h3>
            <table class="table table-borderless" id="Customer_Manager_Report">
                <thead>
                <tr>
                  <th>STATUS</th>
                  <th>ACCOUNT NUMBER</th>
                  <th>NAME</th>
                  <th>AREA</th>
                  <th>BLOCK AND LOT</th>
                  <th>PRESENT 1</th>
                  <th>PREVIOUS 1</th>
                  <th>PRESENT 2</th>
                  <th>PREVIOUS 2</th>
                  <th>CONSUMED</th>
                  <th>REMARKS</th>
                  <th>TOTAL CONSUMED</th>
                  <th>AMOUNT</th>
                  <th>SENIOR DISCOUNT</th>
                  <th>FREE OF CHARGE</th>
                  <th>DISCOUNT</th>
                  <th>MONTH</th>
                  <th>CATEGORY</th>
                  <th>DUE DATE</th>
                  <th>DISC DATE</th>
                  <th>BILLING PERIOD</th>
                  <th>GRAND TOTAL</th>
                  <th>READER NAME</th>
                  <th>TIMESTAMP</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM tbl_reading";
                    $result = $con->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo '<td style="text-align: center; width:50px;">';
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
                            echo '</td>';
                            
                            echo "<td>".$row["account_number"]."</td>";
                            echo "<td>".$row["name"]."</td>";
                            echo "<td>".$row["area"]."</td>";
                            echo "<td>".$row["blk_lot"]."</td>";
                            echo "<td>".$row["present_1"]."</td>";
                            echo "<td>".$row["previous_1"]."</td>";
                            echo "<td>".$row["present_2"]."</td>";
                            echo "<td>".$row["previous_2"]."</td>";
                            echo "<td>".$row["consumed"]."</td>";
                            echo "<td>".$row["remarks"]."</td>";
                            echo "<td>".$row["total_consumed"]."</td>";
                            echo "<td>".$row["amount"]."</td>";
                            echo "<td>".$row["sc_discount"]."</td>";
                            echo "<td>".$row["free_of_charge"]."</td>";
                            echo "<td>".$row["discount"]."</td>";
                            echo "<td>".$row["month"]."</td>";
                            echo "<td>".$row["category"]."</td>";
                            echo "<td>".$row["due_date"]."</td>";
                            echo "<td>".$row["disc_date"]."</td>";
                            echo "<td>".$row["billing_period"]."</td>";
                            echo "<td>".$row["grand_total"]."</td>";
                            echo "<td>".$row["reader_name"]."</td>";
                            echo "<td>".$row["timestamp"]."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No data available.</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#Customer_Manager_Report').DataTable();

            $('#account_number, #name, #blk_lot, #timestamp').on('keyup change', function() {
                let columnIdx = $(this).attr('id') === 'account_number' ? 1 :
                               $(this).attr('id') === 'name' ? 2 :
                               $(this).attr('id') === 'blk_lot' ? 4 : 23; // Timestamp column

                table.column(columnIdx).search(this.value).draw();
            });
        });

        function updateDateTime() {
            document.getElementById('date').innerText = new Date().toLocaleDateString();
            document.getElementById('time').innerText = new Date().toLocaleTimeString();
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
</body>
</html>
