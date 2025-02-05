<?php
include("header.php"); // Ensure your database connection is included
include("topbar.php");
include("sidebar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $account_number = $_POST['account_number'];
    $name = $_POST['name'];
    $area = $_POST['area'];
    $block = $_POST['block'];
    $age = $_POST['age'];
    $status = $_POST['status'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $birthplace = $_POST['birthplace'];
    $education_attainment = $_POST['education_attainment'];
    $family_member_1 = $_POST['family_member_1'];
    $family_member_2 = $_POST['family_member_2'];
    $family_member_3 = $_POST['family_member_3'];
    $income = $_POST['income'];
    $cedula = $_POST['cedula'];
    $clearance = $_POST['clearance'];
    $meter_number = $_POST['meter_number'];
    $date_filed = $_POST['date_filed'];
    $birthday = $_POST['birthday'];
    $amount = $_POST['amount'];
    $month_for_data = $_POST['month_for_data'];
    $beneficiary_1 = $_POST['beneficiary_1'];
    $beneficiary_2 = $_POST['beneficiary_2'];
    $beneficiary_3 = $_POST['beneficiary_3'];
    $consumer_status = $_POST['consumer_status'];

    // Corrected SQL Insert Query
    $query = "INSERT INTO tbl_members_profile (
        account_number, name, area, block, age, status, gender, contact, birthplace, 
        education_attainment, family_member_1, family_member_2, family_member_3, income, 
        cedula, clearance, meter_number, date_filed, birthday, amount, month_for_data, 
        beneficiary_1, beneficiary_2, beneficiary_3, consumer_status
    ) VALUES (
        '$account_number', '$name', '$area', '$block', '$age', '$status', '$gender', '$contact', '$birthplace', 
        '$education_attainment', '$family_member_1', '$family_member_2', '$family_member_3', '$income', 
        '$cedula', '$clearance', '$meter_number', '$date_filed', '$birthday', '$amount', '$month_for_data', 
        '$beneficiary_1', '$beneficiary_2', '$beneficiary_3', '$consumer_status'
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
                        window.location.href = 'members_profile_reports.php';
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
        <h1>Add Members Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members Profile</a></li>
                <li class="breadcrumb-item active">Members Profile Information</li>
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
                            <h5 class="card-title">Add Members Profile Information</h5>

                            <ul align="right">
                              <button type="button" class="btn btn-primary" onclick="window.history.back();"><i class="bi bi-arrow-left"></i>&nbsp;Back</button></a>                                    
                            </ul>

                            <form action="add_members_profile.php" method="POST" id="addForm">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="account_number" class="form-label">Account Number</label>
                                        <input type="text" class="form-control" id="account_number" name="account_number" required>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                      
                                        
                                                <label for="area" class="form-label">AREA</label>
                                                <select class="form-control" id="area" name="area" required>
                                                <option selected disabled>--SELECT AREA--</option>
                                                <?php 
                                                    $query = "SELECT * FROM tbl_area";
                                                    $result = $con->query($query);
                                                    if(mysqli_num_rows($result) > 0){
                                                    while ($userResult = $result->fetch_assoc()){
                                                ?>
                                                        <option data-tokens="<?php echo $userResult['area']; ?>"><?php echo $userResult['area']; ?></option>
                                                <?php 
                                                    }
                                                    }
                                                ?>
                                                </select>
                                            
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="block" class="form-label">Block</label>
                                        <input type="text" class="form-control" id="block" name="block" required>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" required>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <input type="text" class="form-control" id="gender" name="gender" required>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="contact" class="form-label">Contact</label>
                                        <input type="text" class="form-control" id="contact" name="contact" required>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="birthplace" class="form-label">Birthplace</label>
                                        <input type="text" class="form-control" id="birthplace" name="birthplace" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="education_attainment" class="form-label">Educational Attainment</label>
                                        <input type="text" class="form-control" id="education_attainment" name="education_attainment" required>
                                    </div>

                                   
                                    <div class="col-lg-4 mb-3">
                                        <label for="income" class="form-label">Income</label>
                                        <input type="number" class="form-control" id="income" name="income">
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="cedula" class="form-label">Cedula</label>
                                        <input type="text" class="form-control" id="cedula" name="cedula">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="clearance" class="form-label">Clearance</label>
                                        <input type="text" class="form-control" id="clearance" name="clearance">
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="meter_number" class="form-label">Meter Number</label>
                                        <input type="text" class="form-control" id="meter_number" name="meter_number">
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="date_filed" class="form-label">Date Filed</label>
                                        <input type="date" class="form-control" id="date_filed" name="date_filed">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="birthday" class="form-label">Birthday</label>
                                        <input type="date" class="form-control" id="birthday" name="birthday">
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" class="form-control" id="amount" name="amount">
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="month_for_data" class="form-label">Month</label>
                                        <select class="form-control" id="month_for_data" name="month_for_data" required>
                                            <option selected disabled>-- Select Month --</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="beneficiary_1" class="form-label">Beneficiary 1</label>
                                        <input type="text" class="form-control" id="beneficiary_1" name="beneficiary_1">
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="beneficiary_2" class="form-label">Beneficiary 2</label>
                                        <input type="text" class="form-control" id="beneficiary_2" name="beneficiary_2">
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="beneficiary_3" class="form-label">Beneficiary 3</label>
                                        <input type="text" class="form-control" id="beneficiary_3" name="beneficiary_3">
                                    </div>
<!--                                     
                                    <div class="col-lg-4 mb-3">
                                    <label for="consumer_status" class="form-label">Status:</label>
                                    <select id="status" name="consumer_status" class="form-control">
                                        <option value="0">Select Status</option>
                                        <option value="DISCONNECTED">DISCONNECTED</option>
                                        <option value="ACTIVE">ACTIVE</option>
                                    </select>
                                    </div> -->



                                                <div class="col-lg-4 mb-3">
                                                    <label for="family_member_1" class="form-label">Family Member 1</label>
                                                    <input type="text" class="form-control" id="family_member_1" name="family_member_1">
                                                </div>

                                                <div class="col-lg-4 mb-3">
                                                    <label for="family_member_2" class="form-label">Family Member 2</label>
                                                    <input type="text" class="form-control" id="family_member_2" name="family_member_2">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="family_member_3" class="form-label">Family Member 3</label>
                                                    <input type="text" class="form-control" id="family_member_3" name="family_member_3">
                                                </div>

                                            </div>

                                 
                                               
                            </div>
                           
                                
                                    <div style="float:right;">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Close</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    
                                    </div>
                        
                                </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Left side columns -->
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
