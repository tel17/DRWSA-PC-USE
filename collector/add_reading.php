<?php
include("header.php"); // Ensure your database connection is included (header.php contains the database connection)
include("topbar.php");
include("sidebar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $account_number = $_POST['account_number'];
    $name = $_POST['name'];
    $area = $_POST['area'];
    $blk_lot = $_POST['blk_lot'];
    $present_1 = $_POST['present_1'] ?? '';
    $previous_1 = $_POST['previous_1'] ?? '';
    $present_2 = $_POST['present_2'] ?? '';
    $previous_2 = $_POST['previous_2'];
    $remarks = $_POST['remarks'];
    $amount = $_POST['amount'];
    $sc_discount = $_POST['sc_discount'] ?? '';
    $free_of_charge = $_POST['free_of_charge'];
    $discount = $_POST['discount'] ?? '';
    $month = $_POST['month'];
    $category = $_POST['category'];
    $due_date = $_POST['due_date'];
    $disc_date = $_POST['disc_date'];
    $billing_period = $_POST['billing_period'];
    $reader_name = $_POST['reader_name'];
    $consumed = $_POST['consumed'];
    $total_consumed = $_POST['total_consumed'];
    $grand_total = $_POST['grand_total'];
    $payment_status = $_POST['payment_status'];

    // Corrected SQL Insert Query
    $query = "INSERT INTO tbl_reading (
        account_number, name, area, blk_lot, present_1, previous_1, present_2, previous_2, 
        consumed, remarks, total_consumed, amount, sc_discount, free_of_charge, discount, month, 
        category, due_date, disc_date, billing_period, grand_total, reader_name, payment_status
    ) VALUES (
        '$account_number', '$name', '$area', '$blk_lot', '$present_1', '$previous_1', '$present_2', '$previous_2', 
        '$consumed', '$remarks', '$total_consumed', '$amount', '$sc_discount', '$free_of_charge', '$discount', '$month', 
        '$category', '$due_date', '$disc_date', '$billing_period', '$grand_total', '$reader_name', '$payment_status'
    )";

  // Execute the query
  if ($con->query($query) === TRUE) {
    echo "<script>window.location.href = 'reading_reports.php';</script>";
    exit(); // Ensure the script stops executing after the redirect
} else {
    echo "Error: " . $query . "<br>" . $con->error;
}

   
}



// Function to calculate water tariff based on usage type
function calculateTariff($consumedCuM, $tariffData, $usageType) {
    $tariff = null;
    foreach ($tariffData as $data) {
        if ($data['category'] == $usageType) {
            $tariff = $data;
            break;
        }
    }

    if ($tariff === null) {
        http_response_code(500);
        echo "Failed to retrieve tariff rates for $usageType";
        exit();
    }

    if ($usageType == 'residential') {
        if ($consumedCuM <= 5) {
            return $tariff['first'];
        } elseif ($consumedCuM <= 10) {
            return ($tariff['second'] * ($consumedCuM - 5)) + $tariff['first'];
        } elseif ($consumedCuM <= 20) {
            return ($tariff['third'] * ($consumedCuM - 10)) + ($tariff['second'] * 5) + $tariff['first'];
        } elseif ($consumedCuM <= 30) {
            return ($tariff['fourth'] * ($consumedCuM - 20)) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        } elseif ($consumedCuM <= 40) {
            return ($tariff['fifth'] * ($consumedCuM - 30)) + ($tariff['fourth'] * 10) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        } elseif ($consumedCuM <= 50) {
            return ($tariff['sixth'] * ($consumedCuM - 40)) + ($tariff['fifth'] * 10) + ($tariff['fourth'] * 10) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        } else {
            return ($tariff['last'] * ($consumedCuM - 50)) + ($tariff['sixth'] * 10) + ($tariff['fifth'] * 10) + ($tariff['fourth'] * 10) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        }
    } elseif ($usageType == 'Commercial A' || $usageType == 'Commercial B') {
        // This will handle both 'Commercial A' and 'Commercial B'
        if ($consumedCuM <= 15) {
            return $tariff['first'];
        } elseif ($consumedCuM <= 30) {
            return ($tariff['second'] * ($consumedCuM - 15)) + $tariff['first'];
        } elseif ($consumedCuM <= 500) {
            return ($tariff['third'] * ($consumedCuM - 30)) + ($tariff['second'] * 15) + $tariff['first'];
        } elseif ($consumedCuM <= 1000) {
            return ($tariff['fourth'] * ($consumedCuM - 500)) + ($tariff['third'] * 470) + ($tariff['second'] * 15) + $tariff['first'];
        } else {
            return ($tariff['last'] * ($consumedCuM - 1000)) + ($tariff['fourth'] * 500) + ($tariff['third'] * 470) + ($tariff['second'] * 15) + $tariff['first'];
        }
    }
}

// Function to get current tariff rates
function getCurrentTariffRates($con) {
    $residentialQuery = "SELECT * FROM tb_tariff WHERE category = 'residential'";
    $commercialQuery = "SELECT * FROM tb_commercial_tariff WHERE category IN ('Commercial A', 'Commercial B')";

    $residentialResult = $con->query($residentialQuery);
    $commercialResult = $con->query($commercialQuery);

    if (!$residentialResult || !$commercialResult) {
        http_response_code(500);
        echo "Failed to retrieve tariff rates: " . $con->error;
        exit();
    }

    $currentTariffs = [];

    while ($row = $residentialResult->fetch_assoc()) {
        $currentTariffs[] = [
            'category' => $row['category'],
            'first' => $row['first'],
            'second' => $row['second'],
            'third' => $row['third'],
            'fourth' => $row['fourth'],
            'fifth' => $row['fifth'],
            'sixth' => $row['sixth'],
            'last' => $row['last']
        ];
    }

    while ($row = $commercialResult->fetch_assoc()) {
        $currentTariffs[] = [
            'category' => $row['category'],
            'first' => $row['first'],
            'second' => $row['second'],
            'third' => $row['third'],
            'fourth' => $row['fourth'],
            'last' => $row['last']
        ];
    }

    return $currentTariffs;
}

if (isset($_GET['consumedCuM']) && isset($_GET['usageType'])) {
    $consumedCuM = (float) $_GET['consumedCuM'];
    $usageType = $_GET['usageType'];

    if ($usageType == 'commercial_a') {
        $usageType = 'Commercial A';
    } elseif ($usageType == 'commercial_b') {
        $usageType = 'Commercial B';
    }

    $tariffData = getCurrentTariffRates($con);
    $tariff = calculateTariff($consumedCuM, $tariffData, $usageType);

    header('Content-Type: application/json');
    echo json_encode(['tariff' => $tariff]);
    exit();
}


$con->close();
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Reading</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Reading</a></li>
                <li class="breadcrumb-item active">Reading Information</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <!-- Start of Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Reading Data</h5>

                            <ul align="right">
                              <button type="button" class="btn btn-primary" onclick="window.history.back();"><i class="bi bi-arrow-left"></i>&nbsp;Back</button>                                    
                            </ul>

                            <form action="add_reading.php" method="POST" id="addForm">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="account_number">Account Number:</label>
                                        <input type="text" name="account_number" id="account_number" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="area">Area:</label>
                                        <input type="text" name="area" id="area" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="blk_lot">Block and Lot:</label>
                                        <input type="text" name="blk_lot" id="blk_lot" class="form-control" required>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="present1">Present (New Meter):</label>
                                    <input type="number" id="present1" name="present_1" class="form-control" oninput="calculateTotalConsumed(), calculateConsumedCuM(), calculateTariff()" value="" disabled>
                                </div>
                                    
                                <div class="col-lg-3 d-flex align-items-center">
                                    <div class="me-4">
                                        <label for="previous1" class="form-label">Previous (New Meter):</label>
                                        <input type="number" id="previous1" name="previous_1" class="form-control form-control-sm" oninput="calculateTotalConsumed(), calculateConsumedCuM(), calculateTariff()"  value="" disabled>
                                    </div>
                                    <div class="mt-5">
                                        <button type="button" id="newMeterButton" class="btn btn-sm btn-primary" onclick="toggleNewMeter()">Toggle New Meter</button>
                                    </div>
                                </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="present2">Present (Old Meter):</label>
                                        <input type="number" id="present2" name="present_2" class="form-control" oninput="calculateTotalConsumed(), calculateConsumedCuM(), calculateTariff()" >
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="previous2">Previous (Old Meter):</label>
                                        <input type="number" id="previous2" name="previous_2"  class="form-control" oninput="calculateTotalConsumed(), calculateConsumedCuM()" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="remarks">Remarks:</label>
                                        <input type="text" name="remarks" id="remarks" class="form-control">
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="amount">Amount:</label>
                                        <input type="number" name="amount" id="amount" class="form-control" readonly >
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="billing_period">Billing Period:</label>
                                        <input type="date" name="billing_period" id="billing_period" class="form-control" required>
                                    </div>

                                    <div class="col-lg-3">
                                    <label for="reader_name">Reader Name:</label>
                                    <input type="text" name="reader_name" id="reader_name" class="form-control" 
value="<?php echo htmlspecialchars($collector_username); ?>"class="form-control" required readonly
 required >
                                        
                                    </div>
                                    
                                    <div class="col-lg-3">
                                <label for="month">Month:</label>
                                <select name="month" id="month" class="form-control" required>
                                    <option value="">-SELECT MONTH-</option>
                                    <?php
                                        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                        foreach ($months as $month) {
                                            echo '<option value="' . $month . '">' . $month . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                                    <div class="col-lg-3">
                                    <label for="usageType">Select Usage Type:</label>
                                    <select id="usageType" name="category" class="form-control" required onchange="calculateTariff()">
                                        <option value="">-SELECT TARIFF TYPE-</option>
                                        <option value="residential">Residential</option>
                                        <option value="commercial_a">Commercial A</option>
                                        <option value="commercial_b">Commercial B</option>
                                    </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="due_date">Due Date:</label>
                                        <input type="date" name="due_date" id="due_date" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-lg-3">
                                        <label for="disc_date">Disconnection Date:</label>
                                        <input type="date" name="disc_date" id="disc_date" class="form-control" required>
                                    </div>
                                </div>

                                

                                
                                
                                
                                <div class="row">
                                <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="senior_discount_amount">Senior Discount Amount (5%):</label>
                                        <input type="number" id="senior_discount_amount" class="form-control" name="sc_discount" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-5">
                                            <button type="button" id="seniorDiscountButton" onclick="toggleSeniorDiscount()">Apply Senior Discount (5%)</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    
                                    <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="custom_discount_percentage">Custom Discount Percentage (%):</label>
                                        <input type="number" id="custom_discount_percentage" class="form-control" name="custom_discount_percentage" >
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="custom_discount_amount">Custom Discount Amount:</label>
                                        <input type="number" id="custom_discount_amount" class="form-control" name="discount" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mt-5">
                                            <button type="button" id="customDiscountButton" onclick="toggleCustomDiscount()">Apply/Remove Custom Discount</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <div class="col-lg-3">
                                        <label for="consumedCuM">Consumed:</label>
                                        <input type="number" id="consumedCuM" name="consumed"class="form-control"  readonly required>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="totalConsumed">Total Consumed:</label>
                                        <input type="number" id="totalConsumed" name="total_consumed" class="form-control" readonly>
                                    </div>
                                </div>


                                <div class="row mb-3">

                                <div class="col-lg-3">
                                        <label for="free_of_charge">Free of Charge:</label>
                                        <input type="text" id="free_of_charge" name="free_of_charge" class="form-control"  value="" readonly>
                                        <button type="button" id="freeOfChargeButton" onclick="applyFreeOfCharge()">Apply Free of Charge</button>
                                    </div>
                                    

                                <!-- Grand Total Section -->
                                    <div class="col-lg-5 text-right">
                                        <label for="grand_total">Grand Total:</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" name="grand_total" id="grand_total" class="form-control"  readonly>
                                        <select name="payment_status" class="form-control" required style="text-align:center; margin-top:10px;">
                                        <option class="bg-danger" value="unpaid">Unpaid</option>
                                        <option value="collector">Paid to Collector</option>
                                        <option value="cashier">Paid to Cashier</option>
                                    </select>
                                    </div>
                                    
                                </div>
                               
                                
                                <div class="row" style="float:right;">
                                    <div class="col-lg-12 text-right">
                                        <button type="button" class="btn btn-secondary mr-2" onclick="window.history.back();">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php include("footer.php"); ?>

<script>
      // Trigger SweetAlert after form submission
  document.getElementById('addForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission to show SweetAlert first

    // Show SweetAlert Success message
    Swal.fire({
      title: 'Data Added Successfully!',
      text: 'Reading been added.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then((result) => {
      if (result.isConfirmed) {
        // Submit the form after closing the SweetAlert
        this.submit();
      }
    });
  });

        let originalTotal = 0;
        let seniorDiscountApplied = false;
        let customDiscountApplied = false;
        let customDiscountPercentage = 0;
        let newMeter = false;

        // Call calculateTariff() when the page loads
calculateTariff();

// Call calculateTariff() when the user changes the consumedCuM or usageType fields
document.getElementById('consumedCuM').addEventListener('input', calculateTariff);
document.getElementById('usageType').addEventListener('change', calculateTariff);

function calculateTariff() {
    const consumedInput = document.getElementById('consumedCuM');
    const usageTypeInput = document.getElementById('usageType');
    const grandTotalInput = document.getElementById('grand_total');
    const amountInput = document.getElementById('amount');

    if (consumedInput.value && usageTypeInput.value) {
        const params = new URLSearchParams({
            consumedCuM: consumedInput.value,
            usageType: usageTypeInput.value
        });

        fetch(`tariff.php?${params.toString()}`)
        .then(response => response.json())
        .then(data => {
            if (data.tariff !== undefined) {
                grandTotalInput.value = data.tariff;
                originalTotal = parseFloat(data.tariff); // Update originalTotal
                amountInput.value = originalTotal.toFixed(2); // Update amount before discount
                applyDiscounts(); // Reapply discounts
            } else {
                grandTotalInput.value = 'Error: Unable to calculate tariff';
                amountInput.value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            grandTotalInput.value = 'Error: Unable to calculate tariff';
            amountInput.value = '';
        });
    } else {
        grandTotalInput.value = '';
        amountInput.value = '';
    }
}
        function updateConsumedCuM() {
            const present2Value = parseFloat(document.getElementById('present2').value) || 0;
            const previous2Value = parseFloat(document.getElementById('previous2').value) || 0;
            const consumedCuM = present2Value - previous2Value;

            document.getElementById('consumedCuM').value = consumedCuM;

            // Trigger tariff calculation
            calculateTariff();
        }

       function toggleNewMeter() {
            newMeter = !newMeter;
            if (newMeter) {
                document.getElementById('present1').disabled = false;
                document.getElementById('previous1').disabled = false;
                document.getElementById('present2').disabled = true;
                document.getElementById('previous2').disabled = false;
                calculateTotalConsumed();
                calculateConsumedCuM();
                calculateTariff();
            } else {
                document.getElementById('present1').disabled = true;
                document.getElementById('previous1').disabled = true;
                document.getElementById('present2').disabled = false;
                document.getElementById('previous2').disabled = false;
                calculateTotalConsumed();
                calculateConsumedCuM();
                calculateTariff();
            }
        }

        function calculateConsumedCuM() {
            if (newMeter) {
                const present1Value = parseFloat(document.getElementById('present1').value) || 0;
                const previous1Value = parseFloat(document.getElementById('previous1').value) || 0;
                const consumedCuM = present1Value - previous1Value;

                document.getElementById('consumedCuM').value = consumedCuM;
            } else {
                const present2Value = parseFloat(document.getElementById('present2').value) || 0;
                const previous2Value = parseFloat(document.getElementById('previous2').value) || 0;
                const consumedCuM = present2Value - previous2Value;

                document.getElementById('consumedCuM').value = consumedCuM;
            }
        }

        function calculateTotalConsumed() {
            if (newMeter) {
                const present1Value = parseFloat(document.getElementById('present1').value) || 0;
                const previous2Value = parseFloat(document.getElementById('previous2').value) || 0;
                const totalConsumed = present1Value + previous2Value;

                document.getElementById('totalConsumed').value = totalConsumed;
            } else {
                const present2Value = parseFloat(document.getElementById('present2').value) || 0;
                document.getElementById('totalConsumed').value = present2Value;
            }
        }

        // Function to apply or remove custom discount
        function toggleCustomDiscount() {
            if (customDiscountApplied) {
                removeCustomDiscount();
            } else {
                applyCustomDiscount();
            }
        }

        function toggleSeniorDiscount() {
            seniorDiscountApplied = !seniorDiscountApplied;  // Toggle the senior discount flag
            applyDiscounts();  // Reapply all discounts
        }

        function applyCustomDiscount() {
            customDiscountApplied = true;
            customDiscountPercentage = parseFloat(document.getElementById('custom_discount_percentage').value);
            applyDiscounts();  // Reapply all discounts
        }

        function removeCustomDiscount() {
            customDiscountApplied = false;
            customDiscountPercentage = 0;
            document.getElementById('custom_discount_percentage').value = '';
            document.getElementById('custom_discount_amount').value = '';
            applyDiscounts();  // Reapply all discounts
        }

        function applyDiscounts() {
            const grandTotalInput = document.getElementById('grand_total');
            const seniorDiscountField = document.getElementById('senior_discount_amount');
            const customDiscountField = document.getElementById('custom_discount_amount');
            const customDiscountPercentageField = document.getElementById('custom_discount_percentage');
            let discountedTotal = originalTotal;

            // Reset discount fields
            seniorDiscountField.value = "0.00";
            customDiscountField.value = "0.00";

            // Apply Senior Discount (e.g., 5%)
            if (seniorDiscountApplied) {
                const seniorDiscount = originalTotal * 0.05;
                discountedTotal -= seniorDiscount;  // Apply senior discount
                seniorDiscountField.value = seniorDiscount.toFixed(2);  // Display the senior discount amount
            }

            // Apply Custom Discount
            if (customDiscountApplied) {
                const customDiscount = originalTotal * (customDiscountPercentage / 100);
                discountedTotal -= customDiscount;  // Apply custom discount
                customDiscountField.value = customDiscount.toFixed(2);  // Display the custom discount amount
                customDiscountPercentageField.value = customDiscountPercentage.toFixed(2);  // Display the custom discount percentage
            }

            // If no discount is applied, reset grand total to original value
            if (!seniorDiscountApplied && !customDiscountApplied) {
                discountedTotal = originalTotal;
            }

            // Update the grand total field
            grandTotalInput.value = discountedTotal.toFixed(2);

            // Recalculate the grand total after applying the discount
            calculateTariff();
        }

        function resetDiscountFields() {
            document.getElementById('senior_discount_amount').value = "0.00";
            document.getElementById('custom_discount_amount').value = "0.00";
            document.getElementById('custom_discount_percentage').value = "0.00";
        }

          function applyFreeOfCharge() {
        document.getElementById('grand_total').value = '0';
        document.getElementById('free_of_charge').value = 'FREE OF CHARGE';
    }
    </script>
</body>
</html>



