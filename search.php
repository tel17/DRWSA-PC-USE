<?php
include("dbcon.php");

if (isset($_GET['q'])) {
    $search_query = mysqli_real_escape_string($con, $_GET['q']);
    $query = "SELECT * FROM (
        SELECT DISTINCT account_number, name, area, grand_total, blk_lot, payment_status, sc_discount, discount, or_number, month
        FROM tbl_reading
        WHERE account_number LIKE '%$search_query%' OR name LIKE '%$search_query%' OR area LIKE '%$search_query%'
    ) AS subquery
    GROUP BY account_number, name
    ORDER BY name desc
    LIMIT 10";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="card-body">
                <h5 class="card-title">Search Results</h5>
                <div class="list-group">';
        while ($row = mysqli_fetch_assoc($result)) {
            $sc_discount = $row['sc_discount'] ?? 0;
            $payment_status = $row['payment_status'] ?? 'unpaid';

            // Determine the current month and create the last 4 months list
            $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $currentMonthIndex = array_search(date('F'), $months); // Get current month index
            $recentMonths = array();

            // Build an array for the last 4 months, excluding the current month
            for ($i = 1; $i <= 4; $i++) {
                $index = ($currentMonthIndex - $i + 12) % 12;
                $recentMonths[] = $months[$index];
            }

            // Fetch data for the last 4 months (exclude current month)
            $month_query = "SELECT * FROM tbl_reading WHERE
                account_number = '".$row['account_number']."' AND
                name = '".$row['name']."' AND
                month IN ('".implode("','", $recentMonths)."')";

            $month_result = mysqli_query($con, $month_query);

            $month_data = array();
            while ($month_row = mysqli_fetch_assoc($month_result)) {
                $month_data[$month_row['month']] = $month_row;
            }

            // Sort months from most recent to oldest
            $sorted_months = array();
            foreach ($recentMonths as $month) {
                if (isset($month_data[$month])) {
                    $sorted_months[] = $month_data[$month];
                }
            }

            
            echo '<div class="list-group-item" onclick="populateForm(this)"
            data-account="'.htmlspecialchars($row['account_number'], ENT_QUOTES).'"
            data-name="'.htmlspecialchars($row['name'], ENT_QUOTES).'"
            data-area="'.htmlspecialchars($row['area'], ENT_QUOTES).'"
            data-grand_total="'.htmlspecialchars($row['grand_total'], ENT_QUOTES).'"
            data-blk_lot="'.htmlspecialchars($row['blk_lot'], ENT_QUOTES).'"
            data-payment_status="'.htmlspecialchars($payment_status, ENT_QUOTES).'"
            data-sc_discount="'.htmlspecialchars($sc_discount, ENT_QUOTES).'"
            data-discount="'.htmlspecialchars($row['discount'], ENT_QUOTES).'"
            data-or_number="'.htmlspecialchars($row['or_number'], ENT_QUOTES).'"';

// Check the payment status to add extra data attributes
if ($payment_status !== 'cashier' && $payment_status !== 'collector') {
echo ' data-month1="'.htmlspecialchars($sorted_months[0]['month'] ?? '', ENT_QUOTES).'"
data-amounts1="'.htmlspecialchars($sorted_months[0]['grand_total'] ?? '', ENT_QUOTES).'"
data-penalty1="'.htmlspecialchars($sorted_months[0]['penalty'] ?? '', ENT_QUOTES).'"
data-senior1="'.htmlspecialchars($sorted_months[0]['sc_discount'] ?? '', ENT_QUOTES).'"
data-recon1="'.htmlspecialchars($sorted_months[0]['recon_fee'] ?? '', ENT_QUOTES).'"
data-materials1="'.htmlspecialchars($sorted_months[0]['materials_fee'] ?? '', ENT_QUOTES).'"
data-month2="'.htmlspecialchars($sorted_months[1]['month'] ?? '', ENT_QUOTES).'"
data-amounts2="'.htmlspecialchars($sorted_months[1]['grand_total'] ?? '', ENT_QUOTES).'"
data-penalty2="'.htmlspecialchars($sorted_months[1]['penalty'] ?? '', ENT_QUOTES).'"
data-senior2="'.htmlspecialchars($sorted_months[1]['sc_discount'] ?? '', ENT_QUOTES).'"
data-recon2="'.htmlspecialchars($sorted_months[1]['recon_fee'] ?? '', ENT_QUOTES).'"
data-materials2="'.htmlspecialchars($sorted_months[1]['materials_fee'] ?? '', ENT_QUOTES).'"
data-month3="'.htmlspecialchars($sorted_months[2]['month'] ?? '', ENT_QUOTES).'"
data-amounts3="'.htmlspecialchars($sorted_months[2]['grand_total'] ?? '', ENT_QUOTES).'"
data-penalty3="'.htmlspecialchars($sorted_months[2]['penalty'] ?? '', ENT_QUOTES).'"
data-senior3="'.htmlspecialchars($sorted_months[2]['sc_discount'] ?? '', ENT_QUOTES).'"
data-recon3="'.htmlspecialchars($sorted_months[2]['recon_fee'] ?? '', ENT_QUOTES).'"
data-materials3="'.htmlspecialchars($sorted_months[2]['materials_fee'] ?? '', ENT_QUOTES).'"
data-month4="'.htmlspecialchars($sorted_months[3]['month'] ?? '', ENT_QUOTES).'"
data-amounts4="'.htmlspecialchars($sorted_months[3]['grand_total'] ?? '', ENT_QUOTES).'"
data-penalty4="'.htmlspecialchars($sorted_months[3]['penalty'] ?? '', ENT_QUOTES).'"
data-senior4="'.htmlspecialchars($sorted_months[3]['sc_discount'] ?? '', ENT_QUOTES).'"
data-recon4="'.htmlspecialchars($sorted_months[3]['recon_fee'] ?? '', ENT_QUOTES).'"
data-materials4="'.htmlspecialchars($sorted_months[3]['materials_fee'] ?? '', ENT_QUOTES).'"';
}

// Close the div tag and add content inside the div
echo ' style="cursor: pointer; padding: 10px;">
<div><strong>Account:</strong> '.$row['account_number'].'</div>
<div><strong>Name:</strong> '.$row['name'].'</div>
<div><strong>Area:</strong> '.$row['area'].'</div>
</div>';
            
        }
        echo '</div></div>';
    } else {
        echo '<div class="alert alert-warning">No results found.</div>';
    }
}
?>
