<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	#list td:nth-child(5),
	#list td:nth-child(6){
		text-align:center !important;
	}
</style>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header ">
		<div class="card-tools d-flex justify-content-end">
			<a href="<?= base_url ?>admin?page=bookings/manage_booking" id="create_new" class="btn btn-flat btn-primary bg-gradient-teal border-0 rounded00"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<div class="table-responsive">
				<table class="table table-sm table-hover table-striped table-bordered" id="list">
					<colgroup>
						<col width="5%">
						<col width="20%">
						<col width="25%">
						<col width="25%">
						<col width="15">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Date Created</th>
							<th>Name</th>
							<th>Services</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `book_list` order by abs(unix_timestamp(`created_at`)) desc ");
						while($row = $qry->fetch_assoc()):
							$services_qry = $conn->query("SELECT `name` from `service_list` where id in (SELECT `service_id` FROM `book_services` where `book_id` = '{$row['id']}')");
							$services_arr = array_column($services_qry->fetch_all(MYSQLI_ASSOC), 'name');
						?>
							<tr>
								<td class="align-items-center text-center"><?php echo $i++; ?></td>
								<td class="align-items-center"><?php echo date("Y-m-d g:i A",strtotime($row['created_at'])) ?></td>
								<td class="align-items-center"><?= $row['fullname'] ?></td>
								<td class="align-items-center text-end"><p class="text-center truncate-1" style="max-width:250px"><?= implode(", ", $services_arr) ?></p></td>
								<td class="align-items-center justify-content-center text-center">
									<?php if($row['status'] == 1): ?>
										<span class="badge bg-primary px-3 rounded-pill">Confirmed</span>
									<?php elseif($row['status'] == 2): ?>
										<span class="badge bg-danger px-3 rounded-pill">Cancelled</span>
									<?php else: ?>
										<span class="badge bg-secondary px-3 rounded-pill">Pending</span>
									<?php endif; ?>
								</td>
								<td class="align-items-center" align="center">
									<div class="dropdown">
										<button type="button" class="btn btn-flat p-1 btn-default btn-sm border dropdown-toggle dropdown-icon" data-bs-toggle="dropdown">
												Action
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="./?page=bookings/view_booking&id=<?php echo $row['id'] ?>"><span class="bi bi-card-text text-dark"></span> View</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="./?page=bookings/manage_booking&id=<?php echo $row['id'] ?>"><span class="bi bi-pencil-square text-primary"></span> Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="bi bi-trash text-danger"></span> Delete</a>
										</div>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this booking permanently?","delete_booking",[$(this).attr('data-id')])
		})
		const dT = new simpleDatatables.DataTable('#list')
	})
	function delete_booking($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_booking",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
<script>
$(document).ready(function() {
    // Handle status change
    $(document).on('change', '.status-toggle, input[name="status"]', function() {
        var booking_id = $(this).data('id') || $(this).closest('tr').find('[data-id]').data('id');
        var new_status = $(this).is(':checked') ? 1 : 0;
        var status_text = new_status == 1 ? 'Confirmed' : 'Pending';
        
        $.ajax({
            url: 'bookings/update_status.php',
            method: 'POST',
            data: {
                id: booking_id,
                status: new_status
            },
            success: function(response) {
                if(response == 1) {
                    var statusBadge = $('.status-badge-' + booking_id);
                    statusBadge.removeClass('badge-warning badge-success');
                    statusBadge.addClass(new_status == 1 ? 'badge-success' : 'badge-warning');
                    statusBadge.text(status_text);
                    alert('Status updated successfully!');
                } else {
                    alert('Error updating status!');
                }
            },
            error: function() {
                alert('Error updating status!');
            }
        });
    });
});
</script>
<script>
// ===== PERFECT FIX FOR CLOSE BUTTON =====
setInterval(function(){
    $('button').each(function(){
        var btnText = $(this).text().trim();
        if(btnText === 'Close' && !$(this).attr('data-fixed')){
            $(this).attr('data-fixed', 'true');
            $(this).off('click').on('click', function(e){
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                $('#confirm_modal').modal('hide');
                $('#uni_modal').modal('hide');
                $('.modal').modal('hide');
                setTimeout(function(){
                    $('.modal').remove();
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').removeAttr('style');
                }, 100);
                return false;
            });
        }
    });
}, 300);
// ===== END OF FIX =====
</script>