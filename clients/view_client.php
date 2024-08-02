<?php 
    require_once('users.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/admin.php');
    if ($logged==false) {
         header("Location:../index.php");
    } 
?>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-primary">
	<h3><b>Customer Details</b></h3>
</div>
<style>
	img#cimg{
      max-height: 15em;
      object-fit: scale-down;
    }
</style>
<div class="row justify-content-center" style="margin-top:-2em;">
	<div class="col-lg-10 col-md-11 col-sm-11 col-xs-11">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 py-3 font-weight-bolder border">Customer ID</div>
							<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 py-3 border"><?= isset($id) ? $id : '' ?></div>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 py-3 font-weight-bolder border">Customer Name</div>
							<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 py-3 border"><?= isset($name) ? $name : '' ?></div>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 py-3 font-weight-bolder border">Contact No</div>
							<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 py-3 border"><?= isset($phone) ? $phone : '' ?></div>
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 py-3 font-weight-bolder border">Address</div>
							<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 py-3 border"><?= isset($address) ? $address : '' ?></div>
						 
							
							<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 py-3 font-weight-bolder border">Status</div>
							<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 py-3 border">
								<?php
									$status = isset($status) ? $status : 0 ;
									switch($status){
										case 1:
											echo '<span class="badge badge-primary bg-gradient-primary text-sm px-3 rounded-pill">Active</span>';
											break;
										case 2:
											echo '<span class="badge badge-danger bg-gradient-danger text-sm px-3 rounded-pill">Inactive</span>';
											break;
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?page=clients/billing_history&id=<?= isset($id) ? $id :'' ?>"><i class="fa fa-table"></i> Billing History</a>
				<a class="btn btn-primary btn-sm bg-gradient-primary rounded-0" href="./?page=clients/manage_client&id=<?= isset($id) ? $id :'' ?>"><i class="fa fa-edit"></i> Edit</a>
				<button class="btn btn-danger btn-sm bg-gradient-danger rounded-0" type="button" id="delete-data"><i class="fa fa-trash"></i> Delete</button>
				<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?page=clients"><i class="fa fa-angle-left"></i> Back to List</a>
			</div>
		</div>
	</div>
</div>
<script>
	
	
			