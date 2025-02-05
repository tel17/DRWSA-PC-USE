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
            min-height: calc(100vh - 60px); /* Adjust height to account for fixed nav */
            margin-top: 50px;
            padding: 20px;
            padding-top: 100px; /* Adjust padding to account for fixed nav */
            position: relative;
            gap: 20px; /* Add gap between columns */
            overflow: hidden; /* Prevent unnecessary scroll bar */
            justify-items: center; /* Center items horizontally */
        }
 
        .row::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url(images/NEW-LOGO.png);
            background-size: 40%;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.1; /* Set opacity for the background image */
            z-index: -1; /* Ensure the background image is behind the content */
        }
 
        .column {
            padding: 20px;
            text-align: center;
            height: 100%;
            overflow-y: auto;
            width: 80%; /* Reduce the width of the columns */
        }
 
        .column-right {
            display: grid;
            grid-template-rows: 100%;
            gap: 20px;
        }
 
        .date-time {
            font-size: 20px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            text-align: left;
            margin-bottom: 0px;
            display: inline-block;
        }
 
        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px; /* Reduce space between form groups */
        }
 
        .form-label {
            width: 100%;
            text-align: left;
            margin-bottom: 5px;
            font-size: 18px;
            font-weight: bold;
        }
 
        .form-input, .form-control {
            width: 80%; /* Reduce the width of the input fields */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            color: #333; /* Placeholder color */
        }
 
        .form-input {
            width: 80%; /* Reduce the width of the input fields */
        }
 
        button {
            width: 150px;
            height: 70px;
            padding: 20px;
            border-radius: 5px;
            border: none;
            background-color: #1a68d6;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 10px 0px 10px;;
            margin-bottom: 0px; /* Reduce margin to separate buttons */
        }
 
        button:hover {
            background-color: #0f4c81;
        }
 
        button:active {
            transform: translateY(2px);
        }
 
        button:focus {
            outline: none;
            box-shadow: 0 0 5px #1a68d6;
        }
    </style>
</head>
 
<body>
    <div class="nav-container">
        <h1>MEMBER'S PROFILE</h1>
            <div class="form-group">
                <label for="date" class="form-label" style="font-size: 20px;">DATE:<p id="date" class="date-time" style="margin-left: 30px;"></p></label>
                <label for="time" class="form-label" style="font-size: 20px; margin-left:250px;">TIME:<p id="time" class="date-time" style="margin-left: 30px;"></p></label>
            </div>
    </div>
    <div class="row">
        <!-- First Column -->
        <div class="column">
    <form action="add_members_profile.php" method="POST"  id="addForm">
            <div class="form-group">
                <label for="account_number" class="form-label">ACCOUNT NUMBER:</label>
                <input type="number" id="account_number" name="account_number" class="form-input" placeholder="Account number">
            </div>
            <div class="form-group">
                <label for="name" class="form-label">NAME:</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="area" class="form-label">AREA:</label>
                <select  id="area" name="area" class="form-control">
                    <option value="">SELECT STATUS</option>
                    <option value="silangan">SILANGAN</option>
                    <option value="kanluran">KANLURAN</option>
                    <option value="railroad">RAILROAD</option>
                    <option value="ramonita">RAMONITA</option>
                    <option value="romanville">ROMANVILLE</option>
                    <option value="cambridge">CAMBRIDGE</option>
                    <option value="primavera">PRIMAVERA</option>
                    <option value="primavera2">PRIMAVERA II</option>
                    <option value="colbella">COLBELLA</option>
                    <option value="sanbernardo">SAN BERNARDO</option>
                    <option value="stmatthews">ST. MATTHEWS</option>
                    <option value="pilarville">PILLARVILLE</option>
                    <option value="amare">AMARE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="block" class="form-label">BLOCK:</label>
                <input type="text" id="block" name="block" class="form-input" placeholder="Enter the block">
            </div>
            <div class="form-group">
                <label for="age" class="form-label">AGE:</label>
                <input type="number" id="age" name="age"class="form-input" placeholder="Enter your age">
            </div>
            <div class="form-group">
                <label for="status" class="form-label">STATUS:</label>
                <select name="status" id="status"name="status" class="form-control">
                    <option value="">SELECT STATUS</option>
                    <option value="single">SINGLE</option>
                    <option value="married">MARRIED</option>
                    <option value="widowed">WIDOWED</option>
                    <option value="divorced">SEPARATED</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gender" class="form-label">GENDER:</label>
                <select name="gender" id="gender" name="gender" class="form-control">
                    <option value="">SELECT GENDER</option>
                    <option value="male">MALE</option>
                    <option value="female">FEMALE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact" class="form-label">CONTACT NUMBER:</label>
                <input type="text" id="contact" name="contact"class="form-input" placeholder="Enter your contact number">
            </div>
            <div class="form-group">
                <label for="birthplace" class="form-label">BIRTHPLACE:</label>
                <input type="text" id="birthplace" name="birthplace" class="form-input" placeholder="Enter your birthplace">
            </div>
            <div class="form-group">
                <label for="education_attainment" class="form-label">EDUCATIONAL ATTAINMENT:</label>
                <select  id="education_attainment" name="education_attainment"class="form-control">
                    <option value="">SELECT EDUCATIONAL ATTAINMENT</option>
                    <option value="high school">HIGH SCHOOL</option>
                    <option value="vocational">VOCATIONAL</option>
                    <option value="college">COLLEGE</option>
                    <option value="post graduate">POST GRADUATE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="family_member_1" class="form-label">FAMILY MEMBER 1:</label>
                <input type="text" id="family_member_1" name="family_member_1"class="form-input" placeholder="Enter your family member" style="margin-bottom: 0px;">
            </div>
            <div class="form-group">
                <label for="family_member_2" class="form-label" style="display: none;">FAMILY MEMBER 2:</label>
                <input type="text" id="family_member_2" name="family_member_2"class="form-input" placeholder="Enter your family member" style="display: none;">
            </div>
            <div class="form-group">
                <label for="family_member_3" class="form-label" style="display: none;">FAMILY MEMBER 3:</label>
                <input type="text" id="family_member_3" name="family_member_3"class="form-input" placeholder="Enter your family member" style="display: none;">
            </div>
         
           
        </div>
 
        <!-- Second Column -->
        <div class="column">
            <div class="form-group">
                <label for="income" class="form-label">INCOME:</label>
                <input type="text" id="income" name="income" class="form-input" placeholder="Enter your income">
            </div>
            <div class="form-group">
                <label for="cedula" class="form-label">CEDULA:</label>
                <input type="text" id="cedula" name="cedula"class="form-input" placeholder="Enter your cedula">
            </div>
            <div class="form-group">
                <label for="clearance" class="form-label">CLEARANCE:</label>
                <input type="text" id="clearance" name="clearance" class="form-input" placeholder="Enter your clearance">
            </div>
            <div class="form-group">
                <label for="meter_number" class="form-label">METER NUMBER:</label>
                <input type="text" id="meter_number" name="meter_number"class="form-input" placeholder="Enter your meter number">
            </div>
            
            <div class="form-group">
                <label for="date" class="form-label">DATE :</label>
                 <input type="date" id="date_filed" name="date_filed" class="form-input">
            </div>
            <div class="form-group">
                <label for="birthday" class="form-label">BIRTHDAY:</label>
                <input type="date" id="birthday" name="birthday"class="form-input">
            </div>
            <div class="form-group">
                <label for="amount" class="form-label">AMOUNT:</label>
                <input type="number" id="amount" name="amount"class="form-input" placeholder="Enter the amount">
            </div>
            <div class="form-group">
                <label for="month_for_data" class="form-label">MONTH:</label>
                <select   id="month_for_data"name="month_for_data" class="form-control">
                    <option value="" disabled selected>Choose a month</option>
                    <option value="january">january</option>
                    <option value="february">february</option>
                    <option value="march">march</option>
                    <option value="april">april</option>
                    <option value="may">may</option>
                    <option value="june">june</option>
                    <option value="july">july</option>
                    <option value="august">august</option>
                    <option value="september">september</option>
                    <option value="october">october</option>
                    <option value="november">november</option>
                    <option value="december">december</option>

                </select>
            </div>
            <div class="form-group">
                <label for="beneficiary_1" class="form-label">BENEFICIARY 1:</label>
                <input type="text" id="beneficiary_1" name="beneficiary_1"class="form-input" placeholder="Enter beneficiary 1">
            </div>
            <div class="form-group">
                <label for="beneficiary_2" class="form-label">BENEFICIARY 2:</label>
                <input type="text" id="beneficiary_2" name="beneficiary_2"class="form-input" placeholder="Enter beneficiary 2">
            </div>
            <div class="form-group">
                <label for="beneficiary_3" class="form-label">BENEFICIARY 3:</label>
                <input type="text" id="beneficiary_3" name="beneficiary_3"class="form-input" placeholder="Enter beneficiary 3">
            </div>
            &nbsp;
            <div class="form-group button-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <button class="btn btn-secondary" id="edit-btn">Edit</button>
                <button class="btn btn-danger" id="delete-btn">Delete</button>
                <button class="btn btn-success" id="print-btn">Print</button>
            </div>
        </div>
    </form>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="assets/js/main.js"></script>
 
    <script>
        // JavaScript to update date and time
        function updateDateTime() {
            const now = new Date();
            const date = now.toLocaleDateString();
            const time = now.toLocaleTimeString();
            document.getElementById('date').innerText = date;
            document.getElementById('time').innerText = time;
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
 
        let famMemCount = 1;
        document.getElementById('add-btn').addEventListener('click', function() {
            if (famMemCount < 10) {
            famMemCount++;
            const famMemInput = document.getElementById('famMem' + famMemCount);
            const famMemLabel = document.querySelector('label[for="famMem' + famMemCount + '"]');
            famMemInput.style.display = 'block';
            famMemLabel.style.display = 'block';
            famMemLabel.parentNode.insertBefore(famMemInput, famMemLabel.nextSibling);
            } else {
            alert('Maximum of 10 family members can be added.');
            }
        });
 
        document.getElementById('delete-btn').addEventListener('click', function() {
            if (famMemCount > 1) {
            const famMemInput = document.getElementById('famMem' + famMemCount);
            const famMemLabel = document.querySelector('label[for="famMem' + famMemCount + '"]');
            famMemInput.style.display = 'none';
            famMemLabel.style.display = 'none';
            famMemCount--;
            } else {
            alert('No more family members to delete.');
            }
        });

        // Trigger SweetAlert after form submission
            document.getElementById('addForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default submission

                Swal.fire({
                    title: 'Data Added Successfully!',
                    text: 'The new Member has been added.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Only submit when user confirms
                    }
                });
            });
    </script>
 
</body>
 
</html>


