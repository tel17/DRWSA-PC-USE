<?php
include("dbcon.php");

if (isset($_GET['q'])) {
    $search_query = mysqli_real_escape_string($con, $_GET['q']);
    $query = "SELECT * FROM tbl_reading WHERE 
        account_number LIKE '%$search_query%' OR 
        name LIKE '%$search_query%' OR 
        area LIKE '%$search_query%'
        ORDER BY name ASC
        LIMIT 10";

    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="card-body">
                <h5 class="card-title">Search Results</h5>
                <div class="list-group">';
        while ($row = mysqli_fetch_assoc($result)) {
            $sc_discount = $row['sc_discount'] ?? 0;
            $payment_status = $row['payment_status'] ?? 'Not Paid';
            echo '<div class="list-group-item" onclick="populateForm(this)" 
                data-account="'.htmlspecialchars($row['account_number'], ENT_QUOTES).'"
                data-name="'.htmlspecialchars($row['name'], ENT_QUOTES).'"
                data-area="'.htmlspecialchars($row['area'], ENT_QUOTES).'"
                data-grand_total="'.htmlspecialchars($row['grand_total'], ENT_QUOTES).'"
                data-blk_lot="'.htmlspecialchars($row['blk_lot'], ENT_QUOTES).'"
                data-payment_status="'.htmlspecialchars($payment_status, ENT_QUOTES).'"
                data-sc_discount="'.htmlspecialchars($sc_discount, ENT_QUOTES).'"
                data-discount="'.htmlspecialchars($row['discount'], ENT_QUOTES).'"
                style="cursor: pointer; padding: 10px;">


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
