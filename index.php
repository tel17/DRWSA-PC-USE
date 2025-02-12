<?php
include("header.php");
?>
<body>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darasa Rural Waterworks</title>


    <style>
        body {
            background: linear-gradient(to top, rgba(255, 255, 255, 3) 10%, rgb(38, 99, 184) 100%);
            background-color: transparent;
        }

        /* Primary buttons */
        .btn-primary {
            width: 200px;
            height: 55px;
            margin: 5px;
            border-radius: 6px;
        }

        /* Danger buttons */
        .btn-danger {
            width: 200px;
            height: 55px;
            margin: 5px;
            background-color: rgb(204, 23, 23);
            color: white;
            border-radius: 6px;
        }

        /* Center the buttons */
        .container.mt-3 {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Add background color to navbar section */
        .nav-container {
            background-color: rgb(40, 106, 199);
        }

        .row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            height: 100vh;
            margin: 0;
        }

        /* Ensure columns fill the available space */
        .column {
            padding: 20px;
            text-align: center;
            height: 100%;
        }

        img {
            max-width: 100%;
            margin-top: 10%;
            height: auto;
        }

        P,
        h5 {
            font-size: 25px;
            margin-top: 20px;
        }

        .modal-body .form-group {
            margin-bottom: auto;
        }

        .modal-body .form-label {
            font-weight: bold;
        }

        .modal-body .form-input {
            width: 100%;
        }

        .modal-body .row-2 {
            display: flex;
            justify-content: space-between;
        }

        .modal-body .row-2 .form-group {
            flex: 1;
            margin-right: 1rem;
        }

        .modal-body .row-2 .form-group:last-child {
            margin-right: 0;
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <br>
        <!-- Navbar -->
        <div class="container navbar-buttons">
            <button class="btn btn-primary" onclick="window.location.href='summary_of_reading.php'">SUMMARY OF READING</button>
            <button class="btn btn-primary" onclick="window.location.href='account.php'">ACCOUNT</button>
           
            <button class="btn btn-primary" data-toggle="modal" data-target="#officialReceiptModal">OFFICIAL RECEIPT</button>

            <button class="btn btn-danger" onclick="window.location.href='daily-collection-report.html'">DAILY COLLECTION REPORT</button>
        </div>

        <!-- Secondary Buttons -->
        <div class="container secondary-buttons">
            
            <button class="btn btn-primary" onclick="window.location.href='summary_ndrm.php'">SUMMARY NRDM</button>
        </div>
        <br>
    </div>

    <!-- Updated grid layout for columns -->
    <div class="row-grid">
        <div class="column">
            <!-- <h2>Column 1</h2>
            <p>Some text..</p> -->
        </div>
        <div class="column">
            <img src="./admin/assets/img/NEW-LOGO.png">
        </div>

        <div class="column">
            <div class="container ">
                <div class="row-content">
                    <br>
                    <br>
                    <br>
                    <h5 style="text-transform: uppercase;">Darasa Rural Waterworks and Sanitation Association, Inc.</h5>
                    <p style="color:blue;"><strong>907 Darasa, Tanauan City, Batangas</strong>
                        <br><br>
                        <strong>Mobile No:</strong> +639228940992<br>
                        <strong>Mobile No:</strong> +639209704531<br>
                        <strong>Tel No:</strong> (043) 778-7219<br>
                        <strong>TIN No:</strong> 005-739-474 NON VAT</p>
                    <br>
                    <p><strong>EST. AUGUST 01, 1983</strong></p>
                </div>
            </div>
        </div>
    </div>

   <!-- Official Receipt Modal -->
   <div class="modal fade" id="officialReceiptModal" tabindex="-1" role="dialog" aria-labelledby="officialReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="officialReceiptModalLabel">Login Official Receipt</h5>
            </div>
            <form id="loginForm" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>








   
<!-- dito end -->

<script>
 document.getElementById("loginForm").addEventListener("submit", function(event) {
    // Prevent form from submitting the traditional way
    event.preventDefault();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username === "vina" && password === "vina123") {
        // Redirect to service_invoice_reports.php with the username in the URL
        window.location.href = "service_invoice_reports.php?username=" + encodeURIComponent(username);
    } else {
        alert("Invalid username or password.");
    }
});

</script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper.js -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <link href="assets/vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />


</body>

</html>
