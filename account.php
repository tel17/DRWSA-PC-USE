<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darasa Rural Waterworks</title>

    <!-- Bootstrap CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
      
        .nav-container {
            background-color: #1a68d6;
            text-align: center;
            color: white;
            padding: 10px;
        }

        .row {
            display: grid;
            grid-template-columns: 2.5fr 1fr; /* 2 equal columns */
            height: 100vh; /* Full viewport height */
            margin: 0;
        }

        .column {
            padding: 20px;
            text-align: center;
         
            height: 100%;
        }

     

        .date-time {
            font-size: 30px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            text-align: right;
            margin-left: auto;
        }

        .form-group {
            display: flex;
            flex-direction: row; /* Labels on the left and inputs on the right */
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .form-label {
            width: 30%; /* Set width for label */
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-input {
            width: 60%; /* Set width for input fields */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .row-1, .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%; /* Ensure the input fields occupy the full space */
        }

        .row-2 label {
            margin-right: 20px; /* Adds gap between the labels */
        }

        .row-8 {
            display: flex;
            align-items: center;
            gap: 20px; /* Add some space between the elements */
            margin-bottom: 15px;
        }

        .row-8 .form-group {
            display: flex;
            flex-direction: row;
            gap: 50px; /* Add space between input fields */
        }

        .row-8 select {
            width: 150px; /* Adjust width as needed */
            margin-bottom: 0;
            height:45px;
        }

        .row-8 .form-group input {
            width: 150px; /* Adjust input field width as needed */
            margin-bottom: 0;
        }
        button {
            width: 150px;
        }
        .form-group button {
            margin-right: 15px; /* Adds space between the buttons */
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <h1>CONFIRMATION</h1>
    </div>

    <div class="row">
        <!-- First Column -->
        <div class="column">
        
            <!-- First Row with two inputs -->
            <div class="row-1">
                <div class="form-group">
                    <label for="account" class="form-label">ACCOUNT#:</label>
                    <input type="text" id="account" class="form-input" placeholder="Account number">
                </div>

                <div class="form-group">
                    <label for="ornumber" class="form-label">O.R NO.:</label>
                    <input type="text" id="ornumber" class="form-input" placeholder="OR number">
                </div>
            </div>

            <!-- Second Row with two inputs -->
            <div class="row-2">
                <div class="form-group">
                    <label for="name" class="form-label">NAME:</label>
                    <input type="text" id="name" class="form-input" placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="date" class="form-label">DATE:</label>
                    <input type="text" id="date" class="form-input" placeholder="Enter the date">
                </div>
            </div>

            <!-- Third Row with two inputs -->
            <div class="row-2">
                <div class="form-group">
                    <label for="area" class="form-label">AREA:</label>
                    <input type="text" id="area" class="form-input" placeholder="Enter your area">
                </div>

                <div class="form-group">
                    <label for="block" class="form-label">BLK/LOT:</label>
                    <input type="text" id="block" class="form-input" placeholder="Enter the blk/lot">
                </div>
            </div>

            <!-- Fourth Row with two inputs -->
            <div class="row-2">
                <div class="form-group">
                    <label for="year" class="form-label">YEAR:</label>
                    <input type="text" id="year" class="form-input" placeholder="Enter the year">
                </div>

                <div class="form-group">
                    <label for="tin" class="form-label">TIN#:</label>
                    <input type="text" id="tin" class="form-input" placeholder="Enter the tin#">
                </div>
            </div>

            <!-- Fifth Row with two inputs -->
            <div class="row-2">
                <div class="form-group">
                    <label for="inwords" class="form-label">A/IN WORDS:</label>
                    <input type="text" id="inwords" class="form-input" placeholder="Enter your a/in words">
                </div>

                <div class="form-group">
                    <label for="check" class="form-label">CHECK #:</label>
                    <input type="text" id="check" class="form-input" placeholder="Enter the check#">
                </div>
            </div>

            <!-- Sixth Row with two inputs -->
            <div class="row-2">
                <div class="form-group">
                    <label for="style" class="form-label">STYLE:</label>
                    <input type="text" id="style" class="form-input" placeholder="Enter your style">
                </div>

                <div class="form-group">
                    <label for="remarks" class="form-label">REMARKS:</label>
                    <input type="text" id="remarks" class="form-input" placeholder="Enter the remarks">
                </div>
            </div>

            <!-- Seventh Row with labels -->
            <div class="row-7">
                <div class="form-group">
                    <label for="month" class="form-label">MONTH</label>
                    <label for="amount" class="form-label">AMOUNT</label>
                    <label for="penalty" class="form-label">PENALTY</label>
                    <label for="senior" class="form-label">SENIOR</label>
                    <label for="recon" class="form-label">RECON</label>
                    <label for="mails" class="form-label">MAIL'S</label>
                    <label for="another" class="form-label"></label>
                </div>
            </div>

            <!-- Eighth Row with inputs -->
            <div class="row-8">
                <div class="form-group">
                    <select name="month" id="month">
                        <option value=""></option>
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
                <div class="form-group">
                    <input type="text" id="amount" class="form-input" placeholder="Enter the amount">
                    <input type="text" id="penalty" class="form-input" placeholder="Enter the penalty">
                    <input type="text" id="senior" class="form-input" placeholder="Enter the senior">
                    <input type="text" id="recon" class="form-input" placeholder="Enter the recon">
                    <input type="text" id="mail" class="form-input" placeholder="Enter the mail">
                    <button class="btn btn-secondary">1ADD</button>
                </div>
            </div>

            <!-- Nineth Row with inputs -->
            <div class="row-8">
                <div class="form-group">
                    <select name="month" id="month">
                        <option value=""></option>
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
                <div class="form-group">
                    <input type="text" id="amount" class="form-input" placeholder="Enter the amount">
                    <input type="text" id="penalty" class="form-input" placeholder="Enter the penalty">
                    <input type="text" id="senior" class="form-input" placeholder="Enter the senior">
                    <input type="text" id="recon" class="form-input" placeholder="Enter the recon">
                    <input type="text" id="mail" class="form-input" placeholder="Enter the mail">
                    <button class="btn btn-secondary">2ADD</button>
                </div>
            </div>

            <!-- ten row -->
            <div class="row-8">
                <div class="form-group">
                    <select name="month" id="month">
                        <option value=""></option>
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
                <div class="form-group">
                    <input type="text" id="amount" class="form-input" placeholder="Enter the amount">
                    <input type="text" id="penalty" class="form-input" placeholder="Enter the penalty">
                    <input type="text" id="senior" class="form-input" placeholder="Enter the senior">
                    <input type="text" id="recon" class="form-input" placeholder="Enter the recon">
                    <input type="text" id="mail" class="form-input" placeholder="Enter the mail">
                    <button class="btn btn-secondary">3ADD</button>
                </div>
            </div>

            <!-- eleventh row -->
            <div class="row-8">
                <div class="form-group">
                    <select name="month" id="month">
                        <option value=""></option>
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
                <div class="form-group">
                    <input type="text" id="amount" class="form-input" placeholder="Enter the amount">
                    <input type="text" id="penalty" class="form-input" placeholder="Enter the penalty">
                    <input type="text" id="senior" class="form-input" placeholder="Enter the senior">
                    <input type="text" id="recon" class="form-input" placeholder="Enter the recon">
                    <input type="text" id="mail" class="form-input" placeholder="Enter the mail">
                    <button class="btn btn-secondary">4ADD</button>

                </div>
            </div>
        </div>

        <!-- Second Column -->
        <div class="column">
            <p id="date-time" class="date-time"></p>
                        <div class="row-column-2 mt-4">
                            <div class="form-group">
                                <label for="totalamount" class="form-label">TOTAL AMOUNT:</label>
                                <input type="number" id="totalamount" class="form-input" placeholder=" " style="color:red; text-align:right; font-size:50px;">
                            </div>
                        </div>

                        <div class="row-column-2 mt-4">
                            <div class="form-group">
                                <label for="senior" class="form-label">SENIOR CITIZEN:</label>
                                <input type="number" id="senior" class="form-input" placeholder=" "style="color:red; text-align:right; font-size:30px;">
                            </div>
                        </div>

                        <div class="row-column-2 mt-4">
                            <div class="form-group">
                                <label for="averagebill" class="form-label">AVERAGE BILL:</label>
                                <input type="number" id="averagebill" class="form-input" placeholder=" "style="color:red; text-align:right; font-size:30px;">
                            </div>
                        </div>

                        <div class="row-column-2 mt-4">
                            <div class="form-group">
                                <label for="change" class="form-label">CHANGE:</label>
                                <input type="number" id="change" class="form-input" placeholder=" "style="color:red; text-align:right; font-size:30px;">
                            </div>
                        </div>

                        <div class="row-column-2 mt-4" style="display: flex; align-items: center; gap: 10px;">
                            <span class="radio-group" style="display: flex; align-items: center; gap: 5px;">
                                <label style="margin: 0; display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="discount" value="option1"> DISCOUNT
                                </label>
                            </span>

                            <!-- Input fields aligned on the right of the radio button -->
                            <input type="text" class="form-input" placeholder="" style="flex: 1; max-width: 100%; color:red; text-align:right;">
                      
                        </div>

                        <div class="row-column-2 mt-4" style="display: flex; align-items: center; gap: 10px;">
                            <span class="radio-group-2" style="display: flex; align-items: center; gap: 5px;">
                                <label style="margin: 0; display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="monthlydues" value="option1"> MONTHLY DUES
                                   
                                </label>
                            </span>

                            <!-- Input fields aligned on the right of the radio button -->
                            <input type="text" class="form-input" placeholder="" style="flex: 1; max-width: 100%; color:red; text-align:right;">
                      
                        </div>



                        <div class="row-column-2 mt-4">
                            <div class="form-group">
                                <label for="cash" class="form-label">CASH:</label>
                                <input type="number" id="cash" class="form-input" placeholder=" "style="color:red; text-align:right;">
                            </div>
                        </div>


                        <div class="row-column-2 mt-4">
                            <div class="form-group">
                                <label for="cashier" class="form-label">CASHIER:</label>
                                <input type="text" id="cashier" class="form-input" placeholder=" " style="color:red; text-align:right; text-transform: uppercase;">
                            </div>
                        </div>

                           
                        <!-- buttons -->

                        <div class="row-column-2 mt-4">
                            <div class="form-group">
                                <button id="print" class="btn btn-primary" >PRINT</button>
                                <button id="average" class="btn btn-primary" >AVERAGE</button>
                                <button id="dailycollection" class="btn btn-primary" >DAILY COLLECTION</button>
                            </div>
                        </div>

                            
                        </div>
                    </div>



                        
                       
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="assets/js/main.js"></script>

    <script>
        
        // JavaScript to update date and time
        function updateDateTime() {
            const now = new Date();
            const date = now.toLocaleDateString();  
            const time = now.toLocaleTimeString();  
            document.getElementById('date-time').innerText = `${date} ${time}`;
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();





    </script>
</body>

</html>
