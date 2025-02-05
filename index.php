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
            <button class="btn btn-primary" onclick="window.location.href='summary-of-reading.html'">SUMMARY OF READING</button>
            <button class="btn btn-primary" onclick="window.location.href='account.php'">ACCOUNT</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#readingEntryModal">READING</button>
            <!-- <button class="btn btn-primary" onclick="window.location.href='members_profile.php'">MEMBER'S PROFILE</button> -->
            <button class="btn btn-primary" onclick="window.location.href='official-receipt.html'">OFFICIAL RECEIPT</button>
            <button class="btn btn-danger" onclick="window.location.href='daily-collection-report.html'">DAILY COLLECTION REPORT</button>
        </div>

        <!-- Secondary Buttons -->
        <div class="container secondary-buttons">
            <button class="btn btn-primary" onclick="window.location.href='water-rate.html'">WATER RATE</button>
            <button class="btn btn-primary" onclick="window.location.href='summary-nrdm.html'">SUMMARY NRDM</button>
            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#consumerModal">
                                                                                                    STATEMENT OF ACCOUNT
                                                                                                </button> -->
            <button class="btn btn-primary" onclick="window.location.href='disconnected.php'">DISCONNECTED</button>
            <button class="btn btn-primary" onclick="window.location.href='active.php'">ACTIVE</button>
            <!-- <button class="btn btn-primary" onclick="window.location.href='meter-replacement.html'">METER REPLACEMENT</button> -->
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

    <!-- Modal Trigger Button -->

    <!-- Modal HTML -->
    <div class="modal fade" id="readingEntryModal" tabindex="-1" role="dialog" aria-labelledby="readingEntryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <button type="button" class="close position-absolute" style="right: 10px;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content -->
                    <div class="nav-container">
                        <h1>READING ENTRY AND COMPUTATION</h1>
                    </div>
                    <div class="container d-flex justify-content-between align-items-center mb-3">
                        <p id="date" class="date mb-0" style="font-weight: bold;"></p>
                        <p id="time" class="time mb-0" style="font-weight: bold;"></p>
                    </div>
                    <div class="row">
                        <!-- First Column -->
                            <!-- First Row with two inputs -->
                            <div class="form-group">
                                <label for="accountNum" class="form-label">ACCOUNT NO.:</label>
                                <input type="text" id="account" class="form-input form-control" placeholder="Account number" required>
                            </div>

                            <!-- Second Row with two inputs -->
                            <div class="form-group">
                                <label for="name" class="form-label">NAME:</label>
                                <input type="text" id="name" class="form-input form-control" placeholder="Enter consumer name" required>
                            </div>

                            <!-- Third Row with two inputs -->
                            <div class="row-2">
                                <div class="form-group">
                                    <label for="area" class="form-label">AREA:</label>
                                    <input type="text" id="area" class="form-input form-control" placeholder="Enter consumer area" required>
                                </div>

                                <div class="form-group">
                                    <label for="block" class="form-label">BLK/LOT:</label>
                                    <input type="text" id="block" class="form-input form-control" placeholder="Enter the blk/lot" required>
                                </div>
                            </div>

                            <!-- Fourth Row with two inputs -->
                            <p style="padding-left: 550px; font-weight: bold;">OLD READING</p>
                            <div class="row-2">
                                <div class="form-group">
                                    <label for="presentReading" class="form-label">PRESENT:</label>
                                    <input type="number" id="presentReading" class="form-input form-control" placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label for="oldReading" class="form-label"><br></label>
                                    <input type="number" id="oldReading" class="form-input form-control" placeholder="" required>
                                </div>
                            </div>

                            <!-- Fifth Row with two inputs -->
                            <div class="row-2">
                                <div class="form-group">
                                    <label for="previousReading" class="form-label">PREVIOUS:</label>
                                    <input type="number" id="previousReading" class="form-input form-control" placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label for="check" class="form-label"><br></label>
                                    <input type="number" id="check" class="form-input form-control" placeholder="" required>
                                </div>
                            </div>

                            <!-- Sixth Row with two inputs -->
                            <div class="row-2">
                                <div class="form-group">
                                    <label for="consumed" class="form-label">CONSUMED:</label>
                                    <input type="number" id="consumed" class="form-input form-control" placeholder="Enter consumed amount" required>
                                </div>

                                <div class="form-group">
                                    <label for="remarks" class="form-label">REMARKS:</label>
                                    <input type="text" id="remarks" class="form-input form-control" placeholder="Enter remarks" required>
                                </div>
                            </div>

                            <!-- Seventh Row -->
                            <div class="form-group">
                                <label for="totalCorrection" class="form-label">TOTAL COR:</label>
                                <input type="number" id="totalCorrection" class="form-input form-control" placeholder="" required>
                            </div>

                            <!-- Eighth Row -->
                            <div class="form-group">
                                <label for="amount" class="form-label">AMOUNT:</label>
                                <input type="number" id="amount" class="form-input form-control" placeholder="Enter amount" required>
                            </div>

                            <div class="row-2">
                                <div class="form-group">
                                    <label for="scDiscount" class="form-label">S.C DISCOUNT:</label>
                                    <input type="number" id="scDiscount" class="form-input form-control" placeholder="Enter discount" required>
                                </div>
                                <div class="form-group">
                                    <label for="freeCharge" class="form-label">FREE OF CHARGE:</label>
                                    <input type="text" id="freeCharge" class="form-input form-control" placeholder="Enter free charge" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="percentDiscount" class="form-label">% DISCOUNT:</label>
                                <input type="text" id="percentDiscount" class="form-input form-control" placeholder="Enter discount percentage" required>
                            </div>

                            <div class="form-group">
                                <label for="month" class="form-label">MONTH:</label>
                               <select name="month" id="month" class="form-control">
                                    <option value="" disabled selected>Choose a month</option>
                                    <?php
                                    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                    foreach ($months as $month) {
                                        echo '<option value="' . $month . '">' . $month . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category" class="form-label">CATEGORY:</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dueDate" class="form-label">DUE DATE:</label>
                                <input type="date" id="dueDate" class="form-input form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="discDate" class="form-label">DISC. DATE:</label>
                                <input type="date" id="discDate" class="form-input form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="billingPeriod" class="form-label">BILLING PERIOD:</label>
                                <input type="date" id="billingPeriod" class="form-input form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="others" class="form-label">OTHERS:</label>
                                <input type="text" id="others" class="form-input form-control" placeholder="Enter other details" required>
                            </div>

                            <div class="form-group">
                                <label for="grandtotal" class="form-label">GRAND TOTAL:</label>
                                <input type="text" id="grandtotal" class="form-input form-control" placeholder="" readonly>
                            </div>

                            <div class="form-group">
                                <label for="searchByName" class="form-label">SEARCH BY NAME:</label>
                                <input type="search" id="searchByName" class="form-input form-control" placeholder="Enter consumer name to search">
                            </div>

                            <div class="form-group">
                                <label for="reader" class="form-label">READER:</label>
                                <input type="text" id="reader" class="form-input form-control" placeholder="Enter reader's name">
                            </div>
                            <!-- Buttons -->
                            <div class="form-group mt-4">
                              <button id="update" class="btn btn-success">UPDATE</button>
                              <button id="compute" class="btn btn-info">COMPUTE</button>
                              <button id="print" class="btn btn-warning" onclick="printReceipt()">PRINT</button>
                              <button id="scDiscountButton" class="btn btn-success">S.C DISCOUNT</button>
                              <button id="percentDiscountButton" class="btn btn-info">% DISCOUNT</button>
                              <button id="oldMeterReading" class="btn btn-warning">OLD METER READING</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- modal for consumer account  -->
     <!-- Modal -->
<div class="modal fade" id="consumerModal" tabindex="-1" aria-labelledby="consumerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consumerModalLabel">Enter Consumer Name</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="consumerName" class="form-control" placeholder="Enter consumer name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="redirectToConsumer()">Proceed</button>
            </div>
        </div>
    </div>
</div>
<!-- dito end -->

<script>
function redirectToConsumer() {
        let consumerName = document.getElementById('consumerName').value.trim();
        if (consumerName === "") {
            alert("Please enter the consumer name.");
        } else {
            window.location.href = "consumer_account.php?name=" + encodeURIComponent(consumerName);
        }
    }
</script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <link href="assets/vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />


</body>

</html>
