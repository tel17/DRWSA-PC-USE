<?php
// Edit Payment Modal Component
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
          <input type="hidden" id="readingId" name="readingId">
          
          <div class="form-group">
            <label>Account Number</label>
            <input type="text" class="form-control" id="accountNumber" readonly>
          </div>

          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="accountName" readonly>
          </div>

          <div class="form-group">
            <label>OR Number</label>
            <input type="text" class="form-control" id="orNumber" name="orNumber" required>
          </div>

          <div class="form-group">
            <label>Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Payment Status</label>
            <select class="form-control" id="paymentStatus" name="paymentStatus" required>
              <option value="collector">Paid to Collector</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savePaymentBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // Handle edit button click
    $(document).on('click', '.edit-btn', function() {
        let row = $(this).closest('tr');
        let readingId = row.find('.delete-btn').data('id');
        let accountNumber = row.find('td').eq(2).text();
        let accountName = row.find('td').eq(3).text();
        let orNumber = row.find('td').eq(23).text();
        let remarks = row.find('td').eq(11).text();
        let paymentStatus = row.find('td').eq(1).find('.badge').text().toLowerCase().replace(/ /g, '_');
        
        // Populate modal fields
        $('#readingId').val(readingId);
        $('#accountNumber').val(accountNumber);
        $('#accountName').val(accountName);
        $('#orNumber').val(orNumber);
        $('#remarks').val(remarks);
        $('#paymentStatus').val(paymentStatus);
        
        // Show modal
        $('#editPaymentModal').modal('show');
    });

    // Handle save payment
    $('#savePaymentBtn').click(function() {
        let formData = $('#paymentForm').serialize();
        
        $.ajax({
            url: 'update_payment_status.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Payment status updated successfully',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire('Error!', 'Failed to update payment status.', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire('Error!', 'An error occurred while updating payment status.', 'error');
            }
        });
    });
});
</script>
