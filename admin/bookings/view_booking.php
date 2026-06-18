<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `book_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
		$services_qry = $conn->query("SELECT * from `service_list` where id in (SELECT `service_id` FROM `book_services` where `book_id` = '{$id}')");
		// $services_arr = array_column($services_qry->fetch_all(MYSQLI_ASSOC), 'name');
    }else{
		echo '<script>alert("Booking ID is not valid."); location.replace("./?page=bookings")</script>';
	}
}else{
	echo '<script>alert("Booking ID is Required."); location.replace("./?page=bookings")</script>';
}
?>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-body">
                <div class="container-fluid mt-4">
                    <dl>
						<dt class="text-muted">Customer Name</dt>
						<dd class="ps-4"><?= $fullname ?? "" ?></dd>
						<dt class="text-muted">Email</dt>
						<dd class="ps-4"><?= $email ?? "" ?></dd>
						<dt class="text-muted">Contact No.</dt>
						<dd class="ps-4"><?= $contact ?? "" ?></dd>
						<dt class="text-muted">Address</dt>
						<dd class="ps-4"><?= $address ?? "" ?></dd>
                      <dt class="text-muted">Status</dt>
                        <dd class="ps-4">
                            <?php if($status == 1): ?>
                                <span class="badge bg-primary px-3 rounded-pill">Confirmed</span>
                            <?php elseif($status == 2): ?>
                                <span class="badge bg-danger px-3 rounded-pill">Cancelled</span>
                            <?php else: ?>
                                <span class="badge bg-secondary px-3 rounded-pill">Inactive</span>
                            <?php endif; ?>
                        </dd>
                    </dl>
                </div>
				<h5>Service(s) Requested:</h5>
				<div class="list-group">
					<?php foreach($services_qry->fetch_all(MYSQLI_ASSOC) as $row): ?>
						<div class="list-group-item list-group-action">
							<div class="titleTxt"><strong><?= $row['name'] ?></strong> <span> |<i class="bi bi-tags"></i> <?= format_num($row['price'], 2) ?></span></div>
						</div>
					<?php endforeach; ?>
				</div>
            </div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-danger btn-sm bg-gradient-danger rounded-0" type="button" id="delete_data"><i class="fa fa-trash"></i> Delete</button>
				<a class="btn btn-primary btn-sm bg-gradient-teal rounded-0" href="./?page=bookings/manage_booking&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
				<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?page=bookings"><i class="fa fa-angle-left"></i> Back to List</a>
			</div>
		</div>
	</div>
</div>
<script>
    $(function(){
		$('#delete_data').click(function(){
			_conf("Are you sure to delete this booking permanently?","delete_booking", ["<?= isset($id) ? $id :'' ?>"])
		})
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
					location.replace("./?page=bookings");
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>