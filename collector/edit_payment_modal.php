<?php
include('dbcon.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reading_id = $_POST['reading_id'];
    $or_number = $_POST['or_number'];
    $payment_status = $_POST['payment_status'];
    $remarks = $_POST['remarks'];
    $date_paid = $_POST['date_paid'];

    // Update the database
    $query = "UPDATE tbl_reading SET 
              or_number = '$or_number',
              payment_status = '$payment_status',
              remarks = '$remarks',
              date_paid = '$date_paid'
              WHERE id = '$reading_id'";

    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success']);
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($con)]);
        exit();
    }
}
?>

<!-- Edit Payment Status Modal -->
<div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editPaymentModalLabel">Update Payment Status</h4>
      </div>
      <div class="modal-body">
        <form id="paymentForm">
          <input type="hidden" name="reading_id" id="readingId">

          <div class="form-group">
            <label>Account Number</label>
            <input type="text" name="account_number" class="form-control" id="account_number" readonly>
          </div>

          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" id="name" readonly>
          </div>

          <div class="form-group">
            <label>OR Number</label>
            <input type="text" class="form-control" id="orNumber" name="or_number" required>
          </div>

          <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Payment Status</label>
            <select class="form-control" id="paymentStatus" name="payment_status" required>
              <option value="unpaid">Unpaid</option>
              <option value="collector">Paid to Collector</option>
            </select>
          </div>
          <div class="form-group">
            <label for="date_paid">Date Paid</label>
            <input type="date" name="date_paid" id="date_paid" class="form-control" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savePaymentBtn">Save changes</button>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function() {
            // Handle edit button click to populate modal
            $(document).on('click', '.edit-btn', function() {
                var accountNumber = $(this).data('account-number');
                var name = $(this).data('name');
                var readingId = $(this).data('reading-id');
                
                console.log('Populating modal with:', accountNumber, name, readingId);
                
                $('#account_number').val(accountNumber);
                $('#name').val(name);
                $('#readingId').val(readingId);
                
                // Show the modal
                $('#editPaymentModal').modal('show');
            });

            // Handle save button click
            $('#savePaymentBtn').on('click', function() {
                var formData = $('#paymentForm').serialize();
                
                $.ajax({
                    url: 'edit_payment_modal.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#savePaymentBtn').prop('disabled', true).html('Saving...');
                    },
                    complete: function() {
                        $('#savePaymentBtn').prop('disabled', false).html('Save changes');
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        
                        try {
                            var result = typeof response === 'string' ? JSON.parse(response) : response;
                            
                            if (result.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Payment details updated successfully',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.message || 'Failed to update payment details'
                                });
                            }
                        } catch (e) {
                            console.error('Error parsing response:', e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while processing the response'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while processing your request'
                        });
                    }
                });
            });
        });
        </script>
      </div>
    </div>
  </div>
</div>
