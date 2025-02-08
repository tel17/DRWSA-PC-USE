<?php
// Include database connection
include('header.php');
?>

<table class="table table-borderless" id="Customer_Manager_Report">
    <tbody>
        <?php
            // Query to fetch data from tbl_reading
            $query = "SELECT * FROM tbl_reading";
            $result = $con->query($query);

            // Check if any rows are returned
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td style="text-align: center; width:50px;"><?php echo $row["id"]; ?></td>
            <td style="text-align: center;"><?php echo $row["account_number"]; ?></td>
            <td style="text-align: center;"><?php echo $row["name"]; ?></td>
            <td style="text-align: center;"><?php echo $row["area"]; ?></td>
            <td style="text-align: center;"><?php echo $row["blk_lot"]; ?></td>
            <td style="text-align: center;"><?php echo $row["present_1"]; ?></td>
            <td style="text-align: center;"><?php echo $row["previous_1"]; ?></td>
            <td style="text-align: center;"><?php echo $row["present_2"]; ?></td>
            <td style="text-align: center;"><?php echo $row["previous_2"]; ?></td>
            <td style="text-align: center;"><?php echo $row["consumed"]; ?></td>
            <td style="text-align: center;"><?php echo $row["remarks"]; ?></td>
            <td style="text-align: center;"><?php echo $row["total_consumed"]; ?></td>
            <td style="text-align: center;"><?php echo $row["amount"]; ?></td>
            <td style="text-align: center;"><?php echo $row["sc_discount"]; ?></td>
            <td style="text-align: center;"><?php echo $row["free_of_charge"]; ?></td>
            <td style="text-align: center;"><?php echo $row["discount"]; ?></td>
            <td style="text-align: center;"><?php echo $row["month"]; ?></td>
            <td style="text-align: center;"><?php echo $row["category"]; ?></td>
            <td style="text-align: center;"><?php echo $row["due_date"]; ?></td>
            <td style="text-align: center;"><?php echo $row["disc_date"]; ?></td>
            <td style="text-align: center;"><?php echo $row["billing_period"]; ?></td>
            <td style="text-align: center;"><?php echo $row["grand_total"]; ?></td>
            <td style="text-align: center;"><?php echo $row["reader_name"]; ?></td>
            <td style="text-align: center; width:50px;">
                <button class="btn btn-danger delete-btn" data-id="<?php echo $row['id']; ?>">
                    <i class="bi bi-trash"></i> Delete
                </button>

                <a href="print.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" id="printButton<?php echo $row['id']; ?>" onclick="printReceipt(<?php echo $row['id']; ?>)">
                    <i class="bi bi-printer"></i> Print
                </a>
            </td>
        </tr>
        <?php
                }
            } else {
        ?>
        <tr>
            <td colspan="30">
                <center>No data available at the moment.</center>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
