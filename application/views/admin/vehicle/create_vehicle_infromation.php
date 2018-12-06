<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
?>

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="user-admin-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Vehicle List</a></li>
				<li class="breadcrumb-item active">Create new vehicle info</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create New Vehicle Information </h1>
			<!-- end page-header -->
			<?php if(!empty($this->session->flashdata('success_message'))){?>
			<div class="alert alert-success fade show">
			  <span class="close" data-dismiss="alert">×</span>
			  <strong>Success!</strong>
			  <?=$this->session->flashdata('success_message')?> 
			  <!-- <a href="#" class="alert-link">an example link</a>.  -->
			</div>
			<?php 
			}
			 // print_r($this->session->userdata());
			 ?>

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Add New Vehicle Information</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-secondary">
                        <span style="color: red"> *</span> All mandory fields shall be duly filled up 
                    </div>
					<form action="admin-add-vehicle-save" method="POST" >
						<div class="row">
							<div class="col-md-6 col-lg-6">

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="type_of_name">Type of vehicle <span style="color: red">*</span></label>
									<div class="col-md-9">
										<?php $get_type_vehicle=$this->user->admin_get_vechile_type();?>
										<select class="form-control m-b-5" name="type_of_name" id="type_of_name" required="">
											<?php if($get_type_vehicle['vehicle_type']=='1'){
												?>
												<option value="">--Select Type--</option>
												<?php
												foreach ($get_type_vehicle['vehicle_type_list'] as $key_vehicle) {?>
													<option value="<?=$key_vehicle->vehicle_type?>"><?=$key_vehicle->vehicle_type?></option>
												<?php }
											}else{
												echo '<option value="">--Please FIll Type Before Submiting--</option>';
											}?>

										</select>
										<small class="f-s-12 text-grey-darker">Select Vehicle type</small>
									</div>
								</div>
								
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Vehicle_capacity">Vehicle capacity<span style="color: red">*</span></label>
									<div class="col-md-9">
										<?php $get_capactiy_vehicle=$this->user->admin_get_vechile_capacity();?>
										<select class="form-control m-b-5" name="Vehicle_capacity" id="Vehicle_capacity" required="">
											<?php if($get_capactiy_vehicle['vehicle_capacity']=='1'){
												?>
												<option value="">--Select Capacity--</option>
												<?php
												foreach ($get_capactiy_vehicle['vehicle_capacity_list'] as $key_vehicle_capacity) {?>
													<option value="<?=$key_vehicle_capacity->vehicle_capacity?>"><?=$key_vehicle_capacity->vehicle_capacity?></option>
												<?php }
											}else{
												echo '<option value="">--Please FIll Capacity Before Submiting--</option>';
											}?>

										</select>
										<small class="f-s-12 text-grey-darker">Select Vehicle capacity</small>
									</div>
								</div>
                                

								

								
								
							</div>
							<div class="col-md-6 col-lg-6">

		
			

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Vehicle_desc"><VAR>Vehicle description</VAR><span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control m-b-5"  name="Vehicle_desc" id="Vehicle_desc" type="text" required="" rows="8"></textarea>
										<small class="f-s-12 text-grey-darker">Here enter vehicle description</small>
									</div>
								</div>
							</div>
						</div>			
						
						<br>		
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                                <button type="submit"  class="btn btn-sm btn-primary m-r-5">Save</button>
                                <a  href="<?=base_url()?>user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                            </div>
                        </div>			
					</form>					
				</div>
			</div>






<script type="text/javascript">
	function get_id_category() {
		var category_name=$('#category_name').val();	
		if(category_name!=""){
			$('#category_id').val(category_name);
		}else{
			$('#category_id').val('');
		}
	}
</script>
			
				
