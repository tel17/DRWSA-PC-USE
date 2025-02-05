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
            grid-template-columns: 1fr 1fr; /* Two columns */
            min-height: calc(100vh - 60px);
            margin-top: 50px;
            padding: 20px;
            padding-top: 100px;
            position: relative;
            gap: 20px;
            overflow: hidden;
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

        .form-input, .form-control, select {
            width: 80%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            color: #333;
        }

        #Customer_Manager_Report_filter {
            display: none;
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <h1>DISCONNECTED</h1>
        <div class="form-group">
            <label for="date" class="form-label" style="font-size: 20px;">DATE: <p id="date" class="date-time" style="margin-left: 30px;"></p></label>
            <label for="time" class="form-label" style="font-size: 20px; margin-left:250px;">TIME: <p id="time" class="date-time" style="margin-left: 30px;"></p></label>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <div class="form-group">
                <label for="account_number" class="form-label">ACCOUNT NUMBER:</label>
                <input type="number" id="account_number" name="account_number" class="form-input" placeholder="Account number">
            </div>
        </div>

        <div class="column column-right">
            <h3>Account Data</h3>
            <table class="table table-borderless" id="Customer_Manager_Report">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">#</th>
                        <th scope="col" style="text-align: center;">Account Number</th>
                        <th scope="col" style="text-align: center;">Name</th>
                        <th scope="col" style="text-align: center;">Area</th>
                        <th scope="col" style="text-align: center;">Consumer Status</th>
                        <th scope="col" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all records where consumer_status is NOT "ACTIVE"
                    $query = "SELECT * FROM tbl_members_profile WHERE consumer_status != 'ACTIVE'";
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $status_badge = ($row["consumer_status"] == "DISCONNECTED") ? 
                                '<span class="badge bg-danger">DISCONNECTED</span>' : 
                                $row["consumer_status"];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row["id"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["account_number"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["name"]; ?></td>
                        <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                        <td style="text-align: center;" id="status_<?php echo $row['id']; ?>"><?php echo $status_badge; ?></td>
                        <td style="text-align: center;">
    <button class="btn btn-success btn-sm" onclick="updateStatus(<?php echo $row['id']; ?>)">Update to ACTIVE</button>
</td>

                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="6">
                            <center>No data available at the moment.</center>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#Customer_Manager_Report').DataTable();
            $('#account_number').on('input', function() {
                table.search(this.value).draw();
            });
        });

        function updateStatus(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the consumer status to ACTIVE!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'No, Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'update_active_status.php',
                        type: 'POST',
                        data: { id: id, status: 'ACTIVE' },
                        success: function(response) {
                            $('#status_' + id).html('<span class="badge bg-success">ACTIVE</span>');
                            Swal.fire('Updated!', 'The consumer status has been updated to ACTIVE.', 'success').then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire('Error!', 'There was an error updating the status.', 'error');
                        }
                    });
                } else {
                    Swal.fire('Cancelled', 'The status was not updated.', 'info');
                }
            });
        }

        function updateDateTime() {
            const now = new Date();
            document.getElementById('date').innerText = now.toLocaleDateString();
            document.getElementById('time').innerText = now.toLocaleTimeString();
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
</body>

</html>
