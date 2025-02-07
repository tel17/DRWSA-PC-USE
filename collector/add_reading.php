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
    $present_1 = $_POST['present_1'];
    $previous_1 = $_POST['previous_1'];
    $present_2 = $_POST['present_2'];
    $previous_2 = $_POST['previous_2'];
    $remarks = $_POST['remarks'];
    $amount = $_POST['amount'];
    $sc_discount = $_POST['sc_discount'];
    $free_of_charge = $_POST['free_of_charge'];
    $discount = $_POST['discount'];
    $month = $_POST['month'];
    $category = $_POST['category'];
    $due_date = $_POST['due_date'];
    $disc_date = $_POST['disc_date'];
    $billing_period = $_POST['billing_period'];
    $reader_name = $_POST['reader_name'];
    $consumed = $_POST['consumed'];
    $total_consumed = $_POST['total_consumed'];
    $grand_total = $_POST['grand_total'];

    // Corrected SQL Insert Query
    $query = "INSERT INTO tbl_reading (
        account_number, name, area, blk_lot, present_1, previous_1, present_2, previous_2, 
        consumed, remarks, total_consumed, amount, sc_discount, free_of_charge, discount, month, 
        category, due_date, disc_date, billing_period, grand_total, reader_name
    ) VALUES (
        '$account_number', '$name', '$area', '$blk_lot', '$present_1', '$previous_1', '$present_2', '$previous_2', 
        '$consumed', '$remarks', '$total_consumed', '$amount', '$sc_discount', '$free_of_charge', '$discount', '$month', 
        '$category', '$due_date', '$disc_date', '$billing_period', '$grand_total', '$reader_name'
    )";

    if ($con->query($query) === TRUE) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ 
                    title: 'Data Added Successfully!',
                    text: 'New Member has been added.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'reading_reports.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error: " . $con->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}
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
                                <div class="container">
                                    <div class="row mb-3">
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

                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="present_1">Present 1:</label>
                                            <input type="number" name="present_1" id="present_1" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="previous_1">Previous 1:</label>
                                            <input type="number" name="previous_1" id="previous_1" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="present_2">Present 2:</label>
                                            <input type="number" name="present_2" id="present_2" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="previous_2">Previous 2:</label>
                                            <input type="number" name="previous_2" id="previous_2" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="remarks">Remarks:</label>
                                            <input type="text" name="remarks" id="remarks" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="amount">Amount:</label>
                                            <input type="number" name="amount" id="amount" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                        <label for="billing_period">Billing Period:</label>
                                        <input type="date" name="billing_period" id="billing_period" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                        <label for="reader_name">Reader Name:</label>
                                        <input type="text" name="reader_name" id="reader_name" value="<?php echo htmlspecialchars($collector_username); ?>"class="form-control" required readonly>
                                            
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="month">Month:</label>
                                            <input type="text" name="month" id="month" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="category">Category:</label>
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="" disabled selected>Select Category</option>
                                                <option value="RESIDENTIAL">RESIDENTIAL</option>
                                                <option value="COMMERCIAL">COMMERCIAL</option>
                                            </select>
                                        </div>


                                        <div class="col-lg-3">
                                            <label for="due_date">Due Date:</label>
                                            <input type="date" name="due_date" id="due_date" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="disc_date">Discount Date:</label>
                                            <input type="date" name="disc_date" id="disc_date" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            
                                            <label for="sc_discount">SC Discount:</label>
                                            <input type="number" name="sc_discount" id="sc_discount" class="form-control">
                                            <button type="button" class="btn btn-info mt-2" onclick="applySCDiscount()">Apply SC Discount</button>
                                        
                                        </div>

                                        <div class="col-lg-3">
                                        <label for="discount">Discount:</label>
                                            <input type="number" name="discount" id="discount" class="form-control">
                                            <button type="button" class="btn btn-info mt-2" onclick="applyDiscount()">Apply Discount</button>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="consumed">Consumed:</label>
                                            <input type="number" name="consumed" id="consumed" class="form-control" required>
                                        </div>


                                        <div class="col-lg-3">
                                            <label for="total_consumed">Total Consumed:</label>
                                            <input type="number" name="total_consumed" id="total_consumed" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="free_of_charge">Free of Charge:</label>
                                                <input type="number" name="free_of_charge" id="free_of_charge" class="form-control" required>
                                            </div>

                                            <!-- Grand Total Section -->
                                            <div class="col-lg-5 text-right">
                                                <label for="grand_total">Grand Total:</label>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="number" name="grand_total" id="grand_total" class="form-control" required>
                                            </div>
                                        </div>



                                    <div class="row" style="float:right;">
                                        <div class="col-lg-12 text-right">
                                            <button type="button" class="btn btn-secondary mr-2" onclick="window.history.back();">Close</button>
                                            <button type="submit" value="Submit" class="btn btn-success">Submit</button>
                                        </div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Trigger SweetAlert after form submission
    document.getElementById('addForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission to show SweetAlert first

        // Show SweetAlert based on success or error message
        Swal.fire({
            title: '<?php echo $message; ?>',
            icon: '<?php echo $alert_type; ?>',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form after closing the SweetAlert
                this.submit();
            }
        });
    });

   
</script>
</body>
</html>
