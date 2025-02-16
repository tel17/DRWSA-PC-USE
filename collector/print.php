<?php
// Assuming your database connection is already established
include("header.php");
 
// Get the 'id' from the URL query parameter
$id = $_GET['id']; // Fetch the id from the URL query string
 
// Query to fetch the specific row from tbl_reading
$query = "SELECT * FROM tbl_reading WHERE id = '$id'";
$result = $con->query($query);
 
// Check if the query returned a result
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    // If no result, handle the error accordingly
    die("No data found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Print</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        form {
            width: 80mm; /* Set width to thermal printer paper size */
            margin: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 10px;
        }
        h5 {
            text-align: center;
            margin-bottom: 5px;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        label {
            flex: 1;
            font-weight: bold;
            font-size: 10px;
            text-align: right;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            flex: 2;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 10px;
        }
        .btn-container {
            text-align: center;
            margin-top: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
// Query to fetch data from tbl_reading
$query = "SELECT * FROM tbl_reading WHERE id = 'id'";
$result = $con->query($query);
 
// Check if any rows are returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
    <form id="receiptForm">
     
        <div class="section" style="text-align: center;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="NEW-LOGO-THERMAL.png" alt="" style="max-width: 50px; height: auto; margin-right: 20px;">
                <div style="text-align: left;">
                    <h5>DARASA RURAL WATERWORKS & SANITATION ASSOCIATION,INC.</h5>
                    Darasa Tanauan City, Batangas<br>
                    TIN No. 005-739-474 Non Vat<br>
                    Contact No. 09207045371 / 778-7219
                </div>
            </div>
        </div>
 
        <div class="form-group">
            <label for="account_number">Account No.:</label>
            <input type="text" id="account_number" name="account_number"  value="<?php echo $row['account_number']; ?>" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"  value="<?php echo $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="area">Area:</label>
            <input type="text" id="area" name="area"  value="<?php echo $row['area']; ?>"required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category"  value="<?php echo $row['category']; ?>" required>
        </div>
        <div class="form-group">
            <label for="month_year">Month/Year:</label>
            <input type="text" id="month_year" name="month_year"  value="<?php echo $row['month']; ?>"required>
        </div>
        <div class="form-group">
            <label for="period">Period:</label>
            <input type="text" id="period" name="period"  value="<?php echo $row['billing_period']; ?>" required>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date"  value="<?php echo $row['due_date']; ?>"required>
        </div>
        <div class="form-group">
            <label for="disconnection_date">Disconnection Date:</label>
            <input type="date" id="disconnection_date" name="disconnection_date"  value="<?php echo $row['disc_date']; ?>"><br>
        </div>
 
        <div class="section" style="margin-bottom: 0px">
            <h4 style="text-align:center" >READING</h4>
            <div class="form-group">
                <label for="present_reading">Present Reading (NEW METER):</label>
                <input type="number" id="present_reading" name="present_reading"  value="<?php echo $row['present_1']; ?>" required>
            </div>
            <div class="form-group">
                <label for="previous_reading">Previous Reading (NEW METER):</label>
                <input type="number" id="previous_reading" name="previous_reading"  value="<?php echo $row['previous_1']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cum_consumed">Cu.M. Consumed:</label>
                <input type="number" id="cum_consumed" name="cum_consumed"  value="<?php echo $row['consumed']; ?>"><br>
            </div>
        </div>
 
        <div class="section">
            <h4 style="text-align:center; margin-top:0px">COMPUTATION</h4>
            <div class="form-group">
                <label for="previous_bill">Previous Bill:</label>
                <input type="number" id="previous_bill" name="previous_bill" value="<?php echo $row['previous_2']; ?>"required>
            </div>
            <div class="form-group">
                <label for="senior_discount">Senior Citizen Discount:</label>
                <input type="text" id="senior_discount" name="senior_discount" value="<?php echo $row['sc_discount']; ?>"><br>
            </div>
            <div class="form-group">
                <label for="less_x_disc">Less X Disc.:</label>
                <input type="text" id="less_x_disc" name="less_x_disc" value="<?php echo $row['discount']; ?>"><br>
            </div>
            <div class="form-group">
                <label for="free_of_charge">Free of Charge:</label>
                <input type="text" id="free_of_charge" name="free_of_charge"  value="<?php echo $row['free_of_charge']; ?>"><br>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" id="total_amount" name="total_amount" value="<?php echo $row['grand_total']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="penalty">Penalty:</label>
                <input type="number" id="penalty" name="penalty" value="<?php echo $row['penalty']; ?>" ><br>
            </div>
        </div>
 
        <div>
            <h5 style="font-weight: lighter; font-size: 10px;">Mangyaring dalhin ang "NOTICE" na ito kung magbabayad sa tanggapan. Ang serbisyo ng tubig ay puputulin anumang oras kung hindi makakabayad sa takdang panahon. Ang reconnection fee ay nagkakahalaga ng 200.00 pesos. Maraming salamat po.</h4>
            <h4 style="font-weight: lighter;font-size: 10px;">Mag message po muna kayo sa ating FB page para po sa mga inquiry o payment, ito po ang Link via QR Code.</h4>
            <div style="display: flex; justify-content: center; gap: 20px;">
                <div>
                    <p>FB page:</p>
                    <img src="sample_fb.jpg" alt="FB QR Code" style="width: 80px; height: auto;">
                </div>
                <div>
                    <p>G-CASH QR:</p>
                    <img src="sample_gcash.jpg" alt="G-CASH QR Code" style="width: 80px; height: auto;">
                </div>
            </div>
        </div>
 
    </form>
   
 
    <script>
        // Automatically trigger the print dialog when the page loads
        window.onload = function () {
            printReceipt();
        }
function printReceipt() {
    const receiptContent = `
    <header>
    <div style="text-align: center; align-items: center; margin-bottom: 0px; margin-top: 0px;">
        <img src="NEW-LOGO-THERMAL.png" alt="" style="max-width: 100px; height: 100px; margin-right: 0px;">
        <h2>DARASA RURAL WATERWORKS AND SANITATION ASSOCIATION</h2>
        <h5 style="margin-top: 0px; margin-bottom: 5px;">Tanauan City, Batangas<br>
        TIN No. 005-739-474 Non Vat<br>
        Contact: 09207045371 / 778-7219</h5>
        <hr style="border: 2px solid #000; margin-top: 0px; margin-bottom: 0px;">
    </div>
    </header>
    <body>
    <div>
        <p>Account No: ${document.getElementById('account_number').value || 'N/A'}<br>
        Name: ${document.getElementById('name').value || 'N/A'}<br>
        Area: ${document.getElementById('area').value || 'N/A'}<br>
        Category: ${document.getElementById('category').value || 'N/A'}<br>
        Month/Year: ${document.getElementById('month_year').value || 'N/A'}<br>
        Period: ${document.getElementById('period').value || 'N/A'}<br>
        Due Date: ${document.getElementById('due_date').value || 'N/A'}<br>
        Disconnection Date: ${document.getElementById('disconnection_date').value || 'N/A'}
        <h3>READING</h3>
        Present (NEW METER) : ${document.getElementById('present_reading').value || 'N/A'}<br>
        Previous (NEW METER) : ${document.getElementById('previous_reading').value || 'N/A'}<br>
        Cu.M. Consumed: ${document.getElementById('cum_consumed').value || 'N/A'}
        <h3>COMPUTATION</h3>
        Previous Bill: ${document.getElementById('previous_bill').value || 'N/A'}<br>
        Senior Discount: ${document.getElementById('senior_discount').value || 'N/A'}<br>
        Less X Disc: ${document.getElementById('less_x_disc').value || 'N/A'}<br>
        Free of Charge: ${document.getElementById('free_of_charge').value || 'N/A'}<br>
        Total Amount: PHP ${document.getElementById('total_amount').value || 'N/A'}<br>
        Penalty: ${document.getElementById('penalty').value || 'N/A'}</p>
        <div style="font-size: 18px;">
        <p>Mangyaring dalhin ang "NOTICE" na ito kung magbabayad sa tanggapan. Ang reconnection fee ay nagkakahalaga ng 200.00 pesos. Maraming salamat po.</p>
        <p>Mag message po muna kayo sa ating FB page para po sa mga inquiry o payment, ito po ang Link via QR Code.</p>
        </div>
        </div>
        </body>
        <footer>
        <div style="display: flex; justify-content: center; gap: 20px;">
    <div>
        <p>FB page:</p>
        <img src="sample_fb.jpg" alt="FB QR Code" style="width: 120px; height: auto; object-fit: cover;">
    </div>
    <div>
        <p>G-CASH QR:</p>
        <img src="sample_gcash.jpg" alt="G-CASH QR Code" style="width: 120px; height: auto; object-fit: cover;">
    </div>
    </div>
    <br>
\n
    <div style="text-align: center; font-size: 12px; margin-top: 40px;">
        </div>
    <div style="text-align: center; font-size: 12px; margin-top: 40px;">
        \n&copy; ${new Date().getFullYear()} Darasa Rural Waterworks and Sanitation Association. All rights reserved.
    </div>
</footer>
    `;
 
    const printWindow = window.open('', '_self');
    printWindow.document.write(`
      <style>
    @media print {
        @page {
            size: 80mm 350mm;
            margin: 0;
            margin-top: 0mm;
            margin-bottom: 0mm;
        }
        body {
            -webkit-print-color-adjust: exact;
            font-size: 15px;
            margin: 0;
            padding: 0;
            width: 100%;
            justify-content: center;
            align-items: center;
            text-align: left;
        }
        p {
            margin-bottom: 0;
            font-size: 15px;
            text-align: left;
        }
        h2, h3 {
            margin-bottom: 0;
            font-size: 18px;
            text-align: center;
        }
        img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
    }
</style>
    `);
     // Write the receipt content to the print window
     printWindow.document.write(receiptContent);
    printWindow.document.close();
    printWindow.focus();
 
   
// Open the print dialog
printWindow.print();
 
// Add a delay (e.g., 4 seconds) before going back to the previous page in the history
setTimeout(function() {
    // Go back to the previous page in the history
    window.history.back();
}, 10000);  // Delay of 2000 milliseconds (4 seconds)
 
 
 
}
   
    </script>
</body>
</html>