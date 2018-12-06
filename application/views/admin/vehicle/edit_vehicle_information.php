<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
	$value1=$Slno_vehicle;
	$value2=$token;
	$keys_id="preetishwebvechile";
	$value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
	$value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
if($value1_convered_id==$value2){
	$data = array('Slno_vehicle' =>$value1_convered_id);
	$table='master_vehicle';
	$query=$this->db->get_where($table,$data);
	$data_db=$query->result(); // here fetch information 
	$row=$values = $data_db[0]; 
}else{
	$this->session->set_flashdata('error_message', 'Some thing went Wrong');
    // After that you need to used redirect function instead of load view such as                 
    redirect('user-admin-home');
}

					        			// `Slno_vendor`, `Vendor_name`, `Vendor_email_id`, `Mobile_no`, `Organisation_name`, `Password`, `Password_hash`, `Status`, `Date_entry`, `Time_entry`, `Vendor_desc`, `Organisation_address`

?>
<style type="text/css">
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background: #fff;
    opacity: 0.9;
    color: blue;
}
</style>
<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="<?=base_url()?>user-admin-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Vehicle</a></li>
				<li class="breadcrumb-item"><a href="<?=base_url()?>admin-view-vendors">Edit Vehicle List</a></li>
				<li class="breadcrumb-item active">Edit Vehicle Details</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit vehicle information</h1>
			<!-- end page-header -->
			<?php if(!empty($this->session->flashdata('success_message'))){?>
			<div class="alert alert-success fade show">
			  <span class="close" data-dismiss="alert">×</span>
			  <strong>Success!</strong>
			  <?=$this->session->flashdata('success_message')?> 
			  <!-- <a href="#" class="alert-link">an example link</a>.  -->
			</div>
			
			 <?php 
			} if(!empty($this->session->flashdata('error_message'))){?>
			<div class="alert alert-danger fade show">
			  <span class="close" data-dismiss="alert">×</span>
			  <strong>Error !</strong>
			  <?=$this->session->flashdata('error_message')?> 
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
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circArray ( [Vendor_name] => vehicle1 [Vendor_email_id] => 4000pounds [Vendor_desc] => xyz )le btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title"> Edit Vehicle Information Details</h4>
				</div>
				<div class="panel-body">
					<form action="<?=base_url()?>admin-edit-vehicle-save"   id="project_code_form" method="POST" >
					<input type="hidden" name="value1" value="<?=$value1?>">
						<input type="hidden" name="value2" value="<?=$value2?>">
					<div class="col-lg-12">
						<!-- begin nav-tabs -->						
					  	<div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                        	</div>
						 <div class="tab-content">
						   
						    	<br>
					  	

								<div class="row">
									<div class="col-mb-6 col-lg-6">

									 	<div class="form-group row m-b-15">
											<label class="col-form-label col-md-3" for="vehicle_type">Type of Vehicle <span style="color: red">*</span></label>
											<div class="col-md-9">
												
												<?php $get_type_vehicle=$this->user->admin_get_vechile_type();?>
												<select class="form-control m-b-5" name="vehicle_type" id="vehicle_type" required="">
													<?php if($get_type_vehicle['vehicle_type']=='1'){
														?>
														<option value="">--Select Type--</option>
														<?php
														foreach ($get_type_vehicle['vehicle_type_list'] as $key_vehicle) {?>
															<option value="<?=$key_vehicle->vehicle_type?>" <?php if($values->vehicle_type==$key_vehicle->vehicle_type){echo "selected";}?>><?=$key_vehicle->vehicle_type?></option>
														<?php }
													}else{
														echo '<option value="">--Please FIll Type Before Submiting--</option>';
													}?>

												</select>
												<small class="f-s-12 text-grey-darker">Select Vehicle type</small>
												
											</div>
										</div>

										<div class="form-group row m-b-15">
											<label class="col-form-label col-md-3" for="vehicle_capacity" ">Vehicle capacity <span style="color: red">*</span></label>
											<div class="col-md-9">
												<!-- <input class="form-control m-b-5" name="vehicle_capacity" id="vehicle_capacity" type="text" required="" value="<?=$values->vehicle_capacity?>"> -->
												<?php $get_capactiy_vehicle=$this->user->admin_get_vechile_capacity();?>
												<select class="form-control m-b-5" name="vehicle_capacity" id="vehicle_capacity" required="">
													<?php if($get_capactiy_vehicle['vehicle_capacity']=='1'){
														?>
														<option value="">--Select Capacity--</option>
														<?php
														foreach ($get_capactiy_vehicle['vehicle_capacity_list'] as $key_vehicle_capacity) {?>
															<option value="<?=$key_vehicle_capacity->vehicle_capacity?>" <?php if($values->vehicle_capacity==$key_vehicle_capacity->vehicle_capacity){echo "selected";}?>><?=$key_vehicle_capacity->vehicle_capacity?></option>
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
											<label class="col-form-label col-md-3" for="vehicle_desc">Vehicle description<span style="color: red">*</span></label>
											<div class="col-md-9">
												<textarea class="form-control m-b-5" rows="5" name="vehicle_desc" required=""><?=$values->vehicle_desc?></textarea> 
												<small class="f-s-12 text-grey-darker"></small>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>

						<br>
                         <div class="form-group row pull-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
                                <a  href="<?=base_url()?>admin-view-vendor-info/<?=$value1?>/<?=$value2?>" class="btn btn-sm btn-success">Back </a>
                                <a  href="<?=base_url()?>user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                            </div>
                         </div>	
                         </form>		
					</div>	
				</form>

						    
			
			<script>
				$(document).ready(function(){
				  $("#myInput").on("keyup", function() {
				    var value = $(this).val().toLowerCase();
				    $("#myTable tr").filter(function() {
				      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				    });
				  });
				});
			</script>

		