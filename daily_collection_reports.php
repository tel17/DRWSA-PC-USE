<?php
include("dbcon.php");
include("header.php");
?>
<body>

<main  class="main">
  <div class="pagetitle">
    <h1>Daily Collection Reports</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Daily Collection</a></li>
        <li class="breadcrumb-item active">Reports</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Daily Collection<span>| Reports</span></h5>
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div>
                <button type="button" class="btn btn-light" id="printBtn" title="Print Table">PRINT</button>
                <button type="button" class="btn btn-light" id="pdfBtn" title="Download PDF">PDF</button>
                <button type="button" class="btn btn-light" id="excelBtn" title="Download Excel">EXCEL</button>
              </div>
             
            </div>
            
<!-- Filter Form -->
<form method="GET" action="" id="filterForm">
  <div class="row">
    <div class="col-md-3">
      <label for="month">Month:</label>
      <select name="month" class="form-control auto-submit">
        <option value="">All</option>
        <?php for ($m = 1; $m <= 12; $m++): ?>
          <option value="<?php echo $m; ?>" <?php echo (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : ''; ?>>
            <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
          </option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label for="day">Day:</label>
      <select name="day" class="form-control auto-submit">
        <option value="">All</option>
        <?php for ($d = 1; $d <= 31; $d++): ?>
          <option value="<?php echo $d; ?>" <?php echo (isset($_GET['day']) && $_GET['day'] == $d) ? 'selected' : ''; ?>>
            <?php echo $d; ?>
          </option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label for="year">Year:</label>
      <select name="year" class="form-control auto-submit">
        <option value="">All</option>
        <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
          <option value="<?php echo $y; ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $y) ? 'selected' : ''; ?>>
            <?php echo $y; ?>
          </option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label for="area">Area:</label>
      <select name="area" class="form-control auto-submit">
        <option value="">All</option>
        <?php
        $query = "SELECT DISTINCT area FROM tbl_reading";
        $result = $con->query($query);
        while ($row = $result->fetch_assoc()) {
          ?>
          <option value="<?php echo $row['area']; ?>" <?php echo (isset($_GET['area']) && $_GET['area'] == $row['area']) ? 'selected' : ''; ?>>
            <?php echo $row['area']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>
</form>

            <br>
            
            <table id="daily_collection_report" class="table table-borderless datatable">
              <thead>
                <tr style="text-align: center;">
                  <th style="text-align: center;">Account Number</th>
                  <th style="text-align: center;">Name</th>
                  <th style="text-align: center;">Month</th>
                  <th style="text-align: center;">O.R #</th>
                  <th style="text-align: center;">Amount</th>
                  <th style="text-align: center;">Penalty</th>
                  <th style="text-align: center;">SC</th>
                  <th style="text-align: center;">Discount</th>
                  <th style="text-align: center;">Blk/Lot</th>
                  <th style="text-align: center;">Area</th>
                  <th style="text-align: center;">Date Paid</th>
                </tr>
              </thead>
              <tbody style="text-align: center;">
                <?php
                $query = "SELECT * FROM tbl_reading WHERE payment_status = 'cashier' AND 1=1";
                
                    if (!empty($_GET['month'])) {
                        $query .= " AND MONTH(date_paid) = ".intval($_GET['month']);
                    }
                    if (!empty($_GET['day'])) {
                        $query .= " AND DAY(date_paid) = ".intval($_GET['day']);
                    }
                    if (!empty($_GET['year'])) {
                        $query .= " AND YEAR(date_paid) = ".intval($_GET['year']);
                    }
                    if (!empty($_GET['area'])) {
                        $query .= " AND area = '".$_GET['area']."'";
                    }
                
                $result = $con->query($query);
                
                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $row["account_number"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["name"]; ?></td>
                  <td style="text-align: center;"><?php echo date('F', strtotime($row["month"] ?? '')); ?></td>
                  <td style="text-align: center;"><?php echo $row["or_number"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["amount"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["penalty"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["sc_discount"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["discount"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["blk_lot"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["area"]; ?></td>
                  <td style="text-align: center;"><?php echo $row["date_paid"] ?? ''; ?></td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                <tr>
                <td colspan="12" class="text-center">No records found.</td>
                </tr>

                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include("footer.php"); ?>


<!-- Import exceljs for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.2.1/exceljs.min.js"></script>

<script>
 

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.auto-submit').forEach(function (select) {
      select.addEventListener('change', function () {
        document.getElementById('filterForm').submit();
      });
    });
  });

function exportToExcelWithDesign() {
    // Create a new workbook
    const workbook = new ExcelJS.Workbook();

    // Create a new worksheet
    const worksheet = workbook.addWorksheet('Customer Manager Report');

    // Set the page setup to fit legal size paper
    worksheet.pageSetup = {
        paperSize: 8, // 8 is the code for legal size paper
        orientation: 'portrait',
        horizontalCentered: true,
        verticalCentered: true,
        headerMargin: 0.5,
        footerMargin: 0.5,
        leftMargin: 0.5,
        rightMargin: 0.5,
        topMargin: 0.5,
        bottomMargin: 0.5,
    };

    worksheet.mergeCells('A1:I5');
    worksheet.getCell('A1').value = 'DARASA RURAL WATERWORKS AND SANITATION ASSOCIATION, INC.\n DARASA, TANAUAN CITY, BATANGAS\nDATE: ' + getFilterDate() + ' \nDAILY COLLECTION REPORT';

    worksheet.getCell('A1').font = { size: 14, bold: true };
    worksheet.getCell('A1').alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };

    worksheet.getCell('A1').fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: 'B8CCD4' },
        bgColor: { argb: 'B8CCD4' }
    };

    // Get the data from the table
    const table = document.getElementById('daily_collection_report');
    const rows = table.rows;

    // Add the data to the worksheet
    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.cells;
        for (let j = 1; j < cells.length - 1; j++) {
            const cell = cells[j];
            const worksheetCell = worksheet.getCell(`${String.fromCharCode(64 + j)}${i + 6}`);
            worksheetCell.value = cell.textContent;
            worksheetCell.font = { size: 17 };
            if (i === 0) {
                worksheetCell.fill = {
                    type: 'pattern',
                    pattern: 'solid',
                    fgColor: { argb: 'FFFFFF00' },
                    bgColor: { argb: 'FFFFFF00' }
                };
                worksheetCell.font = { size: 17, bold: true };
            }
        }
    }

    // Adjust the height of the rows to fit a legal size paper
    for (let i = 0; i < 31; i++) {
        worksheet.getRow(i + 6).height = 25;
    }

    // Calculate the grand total for specific columns
    const columnsToTotal = [4, 5, 6, 7]; // Amount, Penalty, SC, Discount
    let amount = 0;
    let penalty = 0;
    let scDiscount = 0;
    let discount = 0;

    for (let j of columnsToTotal) {
        for (let i = 1; i < rows.length; i++) {
            const cell = rows[i].cells[j];
            if (!isNaN(cell.textContent)) {
                if (j === 4) {
                    amount += parseFloat(cell.textContent);
                } else if (j === 5) {
                    penalty += parseFloat(cell.textContent);
                } else if (j === 6) {
                    scDiscount += parseFloat(cell.textContent);
                } else if (j === 7) {
                    discount += parseFloat(cell.textContent);
                }
            }
        }
    }

    const grandTotal = (amount + penalty) - (scDiscount + discount);

    const totalRow = worksheet.getRow(38);
    totalRow.height = 25;
    totalRow.font = { size: 17, bold: true };

    totalRow.getCell(4).value = amount;
    totalRow.getCell(5).value = penalty;
    totalRow.getCell(6).value = scDiscount;
    totalRow.getCell(7).value = discount;
    totalRow.getCell(9).value = grandTotal;

    const materialsRow = worksheet.getRow(40);
    materialsRow.height = 25;
    const reconFeeRow = worksheet.getRow(41);
    reconFeeRow.height = 25;

reconFeeRow.getCell(2).value = 'Recon Fee: ';
reconFeeRow.getCell(2).font = { size: 17, bold: true };
reconFeeRow.getCell(3).value = `Php: 0`;
reconFeeRow.getCell(3).font = { size: 17 };
reconFeeRow.getCell(3).border = {
    top: { style: 'thin' },
    left: { style: 'thin' },
    bottom: { style: 'thin' },
    right: { style: 'thin' }
};

materialsRow.getCell(2).value = 'Materials: ';
materialsRow.getCell(2).font = { size: 17, bold: true };;
materialsRow.getCell(3).value = `Php: 0`;
materialsRow.getCell(3).font = { size: 17 };
materialsRow.getCell(3).border = {
    top: { style: 'thin' },
    left: { style: 'thin' },
    bottom: { style: 'thin' },
    right: { style: 'thin' }
};

reconFeeRow.getCell(4).value = 'Cheque: ';
reconFeeRow.getCell(4).font = { size: 17, bold: true };
reconFeeRow.getCell(5).value = `Php: 0`;
reconFeeRow.getCell(5).font = { size: 17 };
reconFeeRow.getCell(5).border = {
    top: { style: 'thin' },
    left: { style: 'thin' },
    bottom: { style: 'thin' },
    right: { style: 'thin' }
};

materialsRow.getCell(4).value = 'New Con:';
materialsRow.getCell(4).font = { size: 17, bold: true };;
materialsRow.getCell(5).value = `Php: 0`;
materialsRow.getCell(5).font = { size: 17 };
materialsRow.getCell(5).border = {
    top: { style: 'thin' },
    left: { style: 'thin' },
    bottom: { style: 'thin' },
    right: { style: 'thin' }
};

reconFeeRow.getCell(6).value = 'Grand Total: '; 
reconFeeRow.getCell(6).font = { size: 17, bold: true };
reconFeeRow.getCell(7).value = `Php: ${grandTotal.toFixed(2)}`;
reconFeeRow.getCell(7).font = { size: 17 };
reconFeeRow.getCell(7).border = {
    top: { style: 'thin' },
    left: { style: 'thin' },
    bottom: { style: 'thin' },
    right: { style: 'thin' }
};

materialsRow.getCell(6).value = 'Cash On Hand: ' ;
materialsRow.getCell(6).font = { size: 17, bold: true };;
materialsRow.getCell(7).value = `Php: ${grandTotal.toFixed(2)}`;
materialsRow.getCell(7).font = { size: 17 };
materialsRow.getCell(7).border = {
    top: { style: 'thin' },
    left: { style: 'thin' },
    bottom: { style: 'thin' },
    right: { style: 'thin' }
};

    const prepByRow = worksheet.getRow(43);
    const prepNameRow = worksheet.getRow(45);
    const positionRow = worksheet.getRow(46);
    const checkedByRow = worksheet.getRow(49);
    const checkedNameRow = worksheet.getRow(51);
    const receivedByRow = worksheet.getRow(49);
    const receivedNameRow = worksheet.getRow(51);
    const notedByRow = worksheet.getRow(49);
    const notedNameRow = worksheet.getRow(51);
    const checkedPositionRow = worksheet.getRow(52);

    prepByRow.getCell(1).value = 'Prepared By:';
    prepByRow.getCell(1).font = { size: 17, bold: true };
    prepNameRow.getCell(1).value = 'Vina Klaizel';
    prepNameRow.getCell(1).font = { size: 17, bold: true };
    positionRow.getCell(1).value = 'Counter - Teller/Disconnector';
    positionRow.getCell(1).font = {  size: 13, bold: true };

    checkedByRow.getCell(1).value = 'Checked By:';
    checkedByRow.getCell(1).font = { size: 17, bold: true };
    checkedNameRow.getCell(1).value = 'Meliton F. Gonzales';
    checkedNameRow.getCell(1).font = { size: 17, bold: true };
    checkedPositionRow.getCell(1).value = 'Field Supervisor';
    checkedPositionRow.getCell(1).font = { size: 14, bold: true };

    receivedByRow.getCell(4).value = 'Received By:';
    receivedByRow.getCell(4).font = { size: 17, bold: true };
    receivedNameRow.getCell(4).value = 'Juliana J. Delmulin';
    receivedNameRow.getCell(4).font = { size: 17, bold: true };
    checkedPositionRow.getCell(4).value = 'Asst. Manager';
    checkedPositionRow.getCell(4).font = { size: 14, bold: true };

    notedByRow.getCell(7).value = 'Noted By:';
    notedByRow.getCell(7).font = { size: 17, bold: true };
    notedNameRow.getCell(7).value = 'Henry C. Flores';
    notedNameRow.getCell(7).font = { size: 17, bold: true };
    checkedPositionRow.getCell(7).value = 'General Manager';
    checkedPositionRow.getCell(7).font = {  size: 14, bold: true };

    // Adjust the width of the columns to fit a legal size paper
    for (let i = 1; i < rows[0].cells.length - 1; i++) {
        worksheet.getColumn(i).width = 20;
    }

    // Adjust the height of the rows to fit the paper
for (let i = 0; i < rows.length; i++) {
    worksheet.getRow(i + 6).height = 40;
}

    // Center all the items from A6-I41
    for (let i = 6; i <= 41; i++) {
        const row = worksheet.getRow(i);
        for (let j = 1; j <= 9; j++) {
            const cell = row.getCell(j);
            cell.alignment = { vertical: 'middle', horizontal: 'center' };
        }
    }

   // Save the workbook to a file
workbook.xlsx.writeBuffer().then(function(buffer) {
    const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    const date = new Date();
    const preparedBy = 'Vina Klaizel';
    a.download = `Daily_Collection_Report_${preparedBy}_${date.toLocaleDateString()}.xlsx`;
    a.click();
});
}

// Call the exportToExcelWithDesign function when the export button is clicked
document.getElementById('excelBtn').addEventListener('click', function() {
    console.log('Excel button clicked');
    exportToExcelWithDesign();
});


// Function to get the filter date
function getFilterDate() {
    const monthSelect = document.querySelector('select[name="month"]');
    const daySelect = document.querySelector('select[name="day"]');
    const yearSelect = document.querySelector('select[name="year"]');

    const month = monthSelect.value === "" ? "" : monthSelect.options[monthSelect.selectedIndex].text;
    const day = daySelect.value === "" ? "" : daySelect.value;
    const year = yearSelect.value === "" ? "" : yearSelect.value;

    if (month === "" && day === "" && year === "") {
        return "All Dates";
    } else {
        return month + " " + day + ", " + year;
    }
}
</script>

</body>
</html>