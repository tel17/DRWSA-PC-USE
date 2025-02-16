<?php
include("header.php");
include("dbcon.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['account_number'])) {
    $account_number = $_POST['account_number'];
    if (!empty($account_number)) {
        $payment_status = 'cashier'; // Always set to Cashier as per requirements

        $query = "UPDATE tbl_reading SET payment_status = ? WHERE account_number = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $payment_status, $account_number);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    function searchConsumers(query) {
        // Reset search results display
        var searchResults = document.getElementById('search_results');
        searchResults.style.display = 'block';
        searchResults.style.opacity = '1';
        
        if (query.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    searchResults.innerHTML = this.responseText;
                    searchResults.style.display = 'block';
                }
            };
            xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
            xhr.send();
        } else {
            searchResults.innerHTML = '';
            searchResults.style.display = 'none';
        }
    }


    function populateForm(element) {
        // Explicitly populate each field to ensure they get set
        document.getElementById('account_number').value = element.getAttribute('data-account') || '';
        document.getElementById('total_amount').value = element.getAttribute('data-grand_total') || '';
        document.getElementById('senior_citizen').value = element.getAttribute('data-sc_discount') || '';
        document.getElementById('payment_status').value = element.getAttribute('data-payment_status') || '';
        document.getElementById('update_payment_status').value = element.getAttribute('data-payment_status') === 'unpaid' ? 'cashier' : element.getAttribute('data-payment_status') || '';
        
        // Populate other fields
        document.getElementById('name').value = element.getAttribute('data-name') || '';
        document.getElementById('area').value = element.getAttribute('data-area') || '';
        document.getElementById('discount').value = element.getAttribute('data-discount') || '';
        document.getElementById('blk_lot').value = element.getAttribute('data-blk_lot') || '';
        document.getElementById('or_number').value = element.getAttribute('data-or_number') || '';
        
        // Handle amount in words
        document.getElementById('amount_in_words').value = numberToWords(element.getAttribute('data-grand_total') || 0);

        // Handle payment status field
        var updatePaymentStatus = document.getElementById('update_payment_status');
        updatePaymentStatus.disabled = element.getAttribute('data-payment_status') === 'collector';

        // Clear and hide search results with animation
        const searchResults = document.getElementById('search_results');
        searchResults.style.opacity = '1';
        let opacity = 1;
        const fadeOut = setInterval(() => {
            opacity -= 0.1;
            searchResults.style.opacity = opacity;
            if (opacity <= 0) {
                clearInterval(fadeOut);
                searchResults.innerHTML = '';
                searchResults.style.display = 'none';
            }
        }, 50);
        
        // Clear search input
        document.querySelector('input[name="search_query"]').value = '';

    }


    </script>

    <style>
        label {
            font-size: 25;
        }
        #search_results {
        position: absolute;
        z-index: 1000;
        background: white;
        border: 1px solid #ccc;
        width: 100%; /* Set width to 100% of parent element */
        max-width: 700px; /* Set max-width to match search bar width */
        max-height: 300px;
        overflow-y: auto;
        display: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        left: 15px; /* Align with search bar */
        right: 15px; /* Align with search bar */
        margin: auto; /* Center horizontally */
    }


        .list-group-item {
            padding: 10px;
            cursor: pointer;
        }
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>

</head>

<main class="main" style="margin: 20px;">

    <section class="section dashboard">
        <div class="row">
            <!-- Start of Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title" style="text-align: center; font-size: 40;">Confirmation</h1>
                            <div class="row">
                                <div class="col-lg-6 offset-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="text" name="search_query" class="form-control" placeholder="Search by account number, name, or area..." onkeyup="searchConsumers(this.value)">
                                        </div>
                                        
                                    </div>
                                    <div id="search_results"></div>
                                </div>
                            </div>
                        </div>
                        </form>
</div>
                            <form action="" method="POST" id="addForm">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="account_number">Account Number:</label>
                                        <input type="text" name="account_number" id="account_number" class="form-control" style="height: 50px;" readonly>
                                    </div>

                                    
                                    <div class="col-lg-3">
                                        <label for="or_number">O.R No.:</label>
                                        <input type="number" id="or_number" name="or_number" class="form-control" style="height: 50px;" required>
                                    </div>
                                    
                                    <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-3">
                                            <label for="senior_citizen" class="form-label"><h3>Senior Citizen:</h3></label>
                                        </div>
                                    </div>
                                                
                                    <div class="col-lg-3">
                                        <input type="text" name="senior_citizen" id="senior_citizen" class="form-control" style="height: 70px; margin-bottom: 10px; font-size: 30"  readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" style="height: 50px;" readonly>
                                    </div>
                                                
                                    <div class="col-lg-3">
                                        <label for="date">Date:</label>
                                        <input type="date" id="date" name="date" class="form-control" style="height: 50px;" required>
                                    </div>
                                                
                                    <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-3">
                                            <label for="average_bill" class="form-label"><h3>Average Bill:</h3></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <input type="text" name="average_bill" id="average_bill" class="form-control" style="height: 70px; margin-bottom: 10px; font-size: 30">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="area">Area:</label>
                                        <input type="text" name="area" id="area" class="form-control" readonly>
                                    </div>
                                                
                                    <div class="col-lg-3">
                                        <label for="blk_lot">BLK/LOT:</label>
                                        <input type="text" name="blk_lot" id="blk_lot" class="form-control" style="height: 50px;">
                                    </div>
                                                
                                    <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-3">
                                            <label for="payment_status" class="form-label"><h3>Paid to:</h3></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="payment_status" id="payment_status" class="form-control" style="height: 70px; font-size: 20; margin-bottom: 10px;" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="year">Year:</label>
                                        <select id="year" name="year" class="form-control">
                                            <?php
                                            $startYear = 1900;
                                            $endYear = date('Y');
                                            for ($i = $endYear; $i >= $startYear; $i--) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="tin_number">TIN Number:</label>
                                        <input type="number" id="tin_number" name="tin_number" class="form-control" style="height: 50px;" >
                                    </div>
                                    
                                    <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-3">
                                            <label for="discount" class="form-label"><h3>Discount:</h3></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="discount" id="discount" class="form-control" style="height: 60px; margin-bottom: 0px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="amount_in_words">A/IN WORDS:</label>
                                        <input type="text" name="amount_in_words" id="amount_in_words" class="form-control" style="height: 50px;" readonly>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="check_number">Check Number:</label>
                                        <input type="number" name="check_number" id="check_number" class="form-control" style="height: 50px;">
                                    </div>
                                    
                                   <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-2">
                                            <label for="payment_status" class="form-label"><h3> Update Payment Status:</h3></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="update_payment_status" id="update_payment_status" class="form-control" style="height: 60px; margin-bottom: 10px; font-size: 30">
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="style">Style:</label>
                                        <input type="text" id="style" name="style" class="form-control" style="height: 50px;">
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="remarks">Remarks:</label>
                                        <input type="text" name="remarks" id="remarks" class="form-control" style="height: 50px;">
                                    </div>
                                    
                                    <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-3">
                                            <label for="total_amount" class="form-label"><h3>Total Amount:</h3></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <input type="text" name="total_amount" id="total_amount" class="form-control" style="height: 70px; margin-bottom: 10px; font-size: 30" readonly>
                                    </div>
                                </div>
                               <div class="row">
                                    <div class="col-lg-1">
                                        <label for="month1">Month</label>
                                        <select name="month1" id="month1" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                            <option value="">Select Month</option>
                                            <?php
                                            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                            foreach ($months as $month) {
                                                echo '<option value="' . $month . '">' . $month . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="amounts1">Amount</label>
                                        <input type="number" name="amounts1" id="amounts1" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="penalty1">Penalty</label>
                                        <input type="number" name="penalty1" id="penalty1" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="senior1">Senior</label>
                                        <input type="number" name="senior1" id="senior1" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="recon1">Recon</label>
                                        <input type="number" name="recon1" id="recon1" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="materials1">Materials</label>
                                        <input type="number" name="materials1" id="materials1" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-3">
                                            <label for="payment_status" class="form-label"><h3>Cash:</h3></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="cash" id="cash" class="form-control" style="height: 70px; margin-bottom: 10px; font-size: 30" oninput="calculateChange()">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-1">
                                        <select name="month2" id="month2" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                            <option value="">Select Month</option>
                                            <?php
                                            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                            foreach ($months as $month) {
                                                echo '<option value="' . $month . '">' . $month . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="amounts2" id="amounts2" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="penalty2" id="penalty2" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="senior2" id="senior2" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="recon2" id="recon2" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="materials2" id="materials2" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-3" style="text-align: right;">
                                        <div class="mt-3">
                                            <label for="change" class="form-label"><h3>Change:</h3></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" name="change" id="change" class="form-control" style="height: 70px; margin-bottom: 10px; font-size: 30; color: black;" readonly>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-1">
                                        <select name="month3" id="month3" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                            <option value="">Select Month</option>
                                            <?php
                                            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                            foreach ($months as $month) {
                                                echo '<option value="' . $month . '">' . $month . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="amounts3" id="amounts3" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="penalty3" id="penalty3" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="senior3" id="senior3" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="recon3" id="recon3" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="materials3" id="materials3" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-1">
                                        <select name="month4" id="month4" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                            <option value="">Select Month</option>
                                            <?php
                                            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                            foreach ($months as $month) {
                                                echo '<option value="' . $month . '">' . $month . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="amounts4" id="amounts4" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="penalty4" id="penalty4" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="senior4" id="senior4" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="recon4" id="recon4" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="number" name="materials4" id="materials4" class="form-control" style="height: 50px; margin-bottom: 10px; font-size: 17">
                                    </div>
                                </div>
                                <div style="margin: 10px; padding: 20px; margin-left: 10px;">                           
                                    <span style="float: right;">
                                        <button type="submit" class="btn btn-primary " style="font-size: 20">Print</button>
                                        <button type="submit" class="btn btn-success" style="font-size: 20">Average</button>
                                        <button type="submit" class="btn btn-danger" style="font-size: 20">Daily Collection</button>
                                    </span>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

</body>
</html>
<script> 
function numberToWords(num) {
    if (!num) return 'Zero';
    
    const ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
    const teens = ["", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    const tens = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
    const thousands = ["", "Thousand", "Million", "Billion"];

    function convertLessThanThousand(num) {
        let words = "";
        if (num >= 100) {
            words += ones[Math.floor(num / 100)] + " Hundred ";
            num %= 100;
        }
        if (num >= 11 && num <= 19) {
            words += teens[num - 10] + " ";
        } else {
            if (num >= 10) {
                words += tens[Math.floor(num / 10)] + " ";
                num %= 10;
            }
            if (num > 0) {
                words += ones[num] + " ";
            }
        }
        return words.trim();
    }

    num = parseInt(num, 10);
    if (isNaN(num)) return "Invalid Number";

    let wordResult = "", i = 0;

    while (num > 0) {
        let chunk = num % 1000;
        if (chunk) {
            wordResult = convertLessThanThousand(chunk) + " " + thousands[i] + " " + wordResult;
        }
        num = Math.floor(num / 1000);
        i++;
    }

    return wordResult.trim();
}


// to get the change


    function calculateChange() {
        var cash = parseFloat(document.getElementById('cash').value) || 0;
        var totalAmount = parseFloat(document.getElementById('total_amount').value) || 0;
        var changeField = document.getElementById('change');

        var change = cash - totalAmount;
        changeField.value = change.toFixed(2); // Ensure two decimal places

        // Apply red color if change is negative
        if (change < 0) {
            changeField.style.color = 'red';
        } else {
            changeField.style.color = 'green'; // Reset to default color if positive
        }
    }
</script>
