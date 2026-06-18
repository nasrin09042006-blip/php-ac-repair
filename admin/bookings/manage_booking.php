<?php
// Get booking ID from URL
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle form submission
if (isset($_POST['update_booking'])) {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $services = mysqli_real_escape_string($conn, $_POST['services']);
    $booking_status = mysqli_real_escape_string($conn, $_POST['booking_status']);
    
    if (!empty($customer_name) && !empty($email) && !empty($contact) && !empty($booking_status)) {
        $update_query = "UPDATE bookings SET 
                        customer_name = ?, 
                        email = ?, 
                        contact = ?, 
                        address = ?, 
                        services = ?, 
                        status = ?,
                        updated_at = NOW() 
                        WHERE id = ?";
        
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "ssssssi", 
            $customer_name, $email, $contact, $address, $services, $booking_status, $booking_id
        );
        
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Booking updated successfully!";
        } else {
            $error_message = "Error updating booking: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Please fill all required fields.";
    }
}

// Fetch existing booking data
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `book_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
    $services_qry = $conn->query("SELECT `id`, `name` from `service_list` where id in (SELECT `service_id` FROM `book_services` where `book_id` = '{$id}')");
    $services_arr = array_column($services_qry->fetch_all(MYSQLI_ASSOC), 'name', 'id');
    
    // Set booking_status based on the existing status field
    if(isset($status)) {
        switch($status) {
            case 0: $booking_status = 'pending'; break;
            case 1: $booking_status = 'confirmed'; break;
            case 2: $booking_status = 'cancelled'; break;
            default: $booking_status = 'pending';
        }
    }
} else {
    $services_arr = array();
}
?>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card rounded-0">
            <div class="card-header py-0">
                <div class="card-title py-1"><b><?= isset($id) ? "Update Booking Details" : "New Booking Entry" ?></b></div>
            </div>
            <div class="card-body">
                <div class="container-fluid mt-3">
                    <form action="" id="booking-form">
                        <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="fullname" class="control-label">Customer Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control form-control-sm rounded-0" value="<?php echo isset($fullname) ? $fullname : ''; ?>"  autofocus required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" value="<?php echo isset($email) ? $email : ''; ?>"  required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="contact" class="control-label">Contact #</label>
                                <input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" value="<?php echo isset($contact) ? $contact : ''; ?>"  required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="address" class="control-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control form-control-sm rounded-0" value="<?php echo isset($address) ? $address : ''; ?>"  required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="services" class="control-label">Services</label>
                                <select name="services[]" id="services" class="form-control form-control-sm rounded-0 select2" multiple="multiple">
                                    <?php 
                                    $query = $conn->query("SELECT * FROM `service_list` where `status` = 1 order by `name` asc");
                                    while($row=$query->fetch_assoc()):
                                    ?>
                                    <option value="<?= $row['id'] ?>" <?= isset($services_arr[$row['id']]) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- NEW BOOKING STATUS DROPDOWN -->
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="booking_status" class="control-label"><strong>Booking Status</strong></label>
                                <select name="status" id="booking_status" class="form-control form-control-sm rounded-0" required>
                                    <option value="">-- Select Status --</option>
                                    <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>
                                        📋 Pending
                                    </option>
                                    <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>
                                        ✅ Confirmed
                                    </option>
                                    <option value="2" <?= isset($status) && $status == 2 ? 'selected' : '' ?>>
                                        ❌ Cancelled
                                    </option>
                                    <option value="3" <?= isset($status) && $status == 3 ? 'selected' : '' ?>>
                                        ✔️ Completed
                                    </option>
                                    <option value="4" <?= isset($status) && $status == 4 ? 'selected' : '' ?>>
                                        🔧 In Progress
                                    </option>
                                </select>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="card-footer py-1 text-center">
                <button class="btn btn-primary btn-sm bg-gradient-teal btn-flat border-0" form="booking-form"><i class="fa fa-save"></i> Save</button>
                <a class="btn btn-light btn-sm bg-gradient-light border btn-flat" href="./?page=bookings"><i class="fa fa-times"></i> Cancel</a>
            </div>
        </div>
    </div>
</div>

<style>
#booking_status {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: white;
}

#booking_status:hover {
    border-color: #007bff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#booking_status:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: none;
}

#booking_status option {
    padding: 8px;
    font-weight: 500;
}

#booking_status option[value="0"] { color: #ffc107; }
#booking_status option[value="1"] { color: #28a745; }
#booking_status option[value="2"] { color: #dc3545; }
#booking_status option[value="3"] { color: #17a2b8; }
#booking_status option[value="4"] { color: #6f42c1; }

.alert {
    margin: 15px 0;
    padding: 12px;
    border-radius: 4px;
}
</style>

<script>
$(document).ready(function(){
    // Initialize Select2 for services
    $('#services').select2({
        placeholder: 'Please Select Services',
        width: '100%'
    });
    
    // Status change handler with confirmation
    $('#booking_status').on('change', function() {
        var selectedValue = $(this).val();
        var selectedText = $(this).find('option:selected').text();
        
        // Confirmation for critical status changes
        if (selectedValue == '2') { // Cancelled
            if (!confirm('Are you sure you want to cancel this booking? This action will notify the customer.')) {
                $(this).val($(this).data('previous-value') || '');
                return false;
            }
        }
        
        if (selectedValue == '3') { // Completed
            if (!confirm('Mark this booking as completed? This will finalize the service.')) {
                $(this).val($(this).data('previous-value') || '');
                return false;
            }
        }
        
        // Store the previous value for potential rollback
        $(this).data('previous-value', selectedValue);
        
        // Optional: Auto-save functionality
        // autoSaveStatus(selectedValue);
        
        console.log('Status changed to:', selectedValue, selectedText);
        
        // Show visual feedback
        showStatusChangeNotification(selectedText);
    });
    
    // Store initial value
    $('#booking_status').data('previous-value', $('#booking_status').val());
    
    // Form submission handler
    $('#booking-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        
        // Validate status selection
        if (!$('#booking_status').val()) {
            alert('Please select a booking status.');
            $('#booking_status').focus();
            return false;
        }
        
        setTimeout(() => {
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_book",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Booking updated successfully!", 'success');
                        setTimeout(() => {
                            location.replace('./?page=bookings/view_booking&id=' + resp.bid);
                        }, 1000);
                    } else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>');
                        el.addClass("alert alert-danger err-msg").text(resp.msg);
                        _this.prepend(el);
                        el.show('slow');
                        $("html, body").scrollTop(0);
                        end_loader();
                    } else {
                        alert_toast("An error occurred", 'error');
                        end_loader();
                        console.log(resp);
                    }
                }
            });
        }, 200);
    });
    
    // Helper function to show status change notification
    function showStatusChangeNotification(statusText) {
        // Remove existing notifications
        $('.status-notification').remove();
        
        // Create notification
        var notification = $('<div class="alert alert-info status-notification" style="margin-top: 10px;">')
            .html('<i class="fa fa-info-circle"></i> Status changed to: <strong>' + statusText + '</strong>')
            .hide()
            .fadeIn();
        
        // Insert after status dropdown
        $('#booking_status').closest('.form-group').after(notification);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            notification.fadeOut(() => notification.remove());
        }, 3000);
    }
    
    // Optional: Auto-save status function
    function autoSaveStatus(status) {
        var bookingId = $('input[name="id"]').val();
        if (!bookingId) return;
        
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=update_status",
            method: 'POST',
            data: {
                id: bookingId,
                status: status
            },
            dataType: 'json',
            success: function(resp) {
                if (resp.status == 'success') {
                    console.log('Status auto-saved successfully');
                }
            },
            error: function(err) {
                console.log('Auto-save failed:', err);
            }
        });
    }
});
</script>