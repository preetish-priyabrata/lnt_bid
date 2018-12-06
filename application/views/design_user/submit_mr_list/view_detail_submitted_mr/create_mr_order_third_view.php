<?php
$email_id=$this->session->userdata('design_email_id');
if(empty($email_id)){
	redirect('design-logout-by-pass');
}
$value=$value;
$value1=$value1;
$value2=$value2;
if($value2!=$value){
	  $this->session->set_flashdata('error_message', 'Some thing went worng');
	redirect('user-design-home');
}
$get_location=$this->design_user->get_design_master_loaction_list();
// print_r($get_location);
?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<div class="sidebar-bg"></div><!-- end #sidebar -->
	<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item active"><a href="<?=base_url()?>user-design-home" class="fa fa-home ">Home</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Material Requisition</a></li>
		<li class="breadcrumb-item active">Material Requisition Form II</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Material Requisition Form II  </h1>
<!-- end page-header error_message -->
	<?php if(!empty($this->session->flashdata('success_message'))){?>
		<div class="alert alert-success fade show">
			<span class="close" data-dismiss="alert">×</span>
			<strong>Success!</strong>
			<?=$this->session->flashdata('success_message')?>		
		</div>
	<?php
	}
	if(!empty($this->session->flashdata('error_message'))){?>
		<div class="alert alert-danger fade show">
			<span class="close" data-dismiss="alert">×</span>
			<strong>Error!</strong>
			<?=$this->session->flashdata('error_message')?>		
		</div>
	<?php
	}	
	?>
	<!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title">Material Requisition Information Form II </h4>
		</div>
		<div class="panel-body">
			<div class="alert alert-secondary">
				<span style="color: red"> *</span> All mandory fields shall be duly filled up
			</div>
			<form action="#" id="upload_form" method="POST" enctype=multipart/form-data>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="activity_name">MR No <span style="color: red">*</span></label>
							<div class="col-md-9">
								<?php
									$get_mr_id=$this->design_user->get_design_mr_no_deatils($value);
									$mr_no=$get_mr_id['mr_details'][0]->mr_no;
									$job_code_id=$get_mr_id['mr_details'][0]->job_code_id;
									$materilal_category_id_slno=$get_mr_id['mr_details'][0]->materilal_category_id_slno;
									$approver_id_slno=$get_mr_id['mr_details'][0]->approver_id_slno;
									$techinal_evalution=$get_mr_id['mr_details'][0]->techinal_evalution;
									$date_required=$get_mr_id['mr_details'][0]->date_required;
									$date_creation=$get_mr_id['mr_details'][0]->date_creation;
									$edit_id=$get_mr_id['mr_details'][0]->edit_id;
									$status_mr=$get_mr_id['mr_details'][0]->status;
									$query_mr_location_list=$this->design_user->get_design_master_mr_location_details($edit_id,$mr_no,$value);

									$result_vechile=$this->design_user->get_design_master_mr_vechile_single($edit_id,$mr_no,$value);
									
										if($status_mr!=1){
											    $this->session->set_flashdata('error_message', 'Editing is denied for this MR');
											    
												redirect('user-design-home');
										}
									

								?>
								<input class="form-control m-b-5"  name="Mr_no" id="Mr_no" type="text" value="<?=$mr_no?>" required="" readonly>
								<input class="form-control m-b-5"  name="slno_Mr_no" id="slno_Mr_no" type="hidden" value="<?=$value?>" required="" readonly>
								<input class="form-control m-b-5"  name="value1" id="value1" type="hidden" value="<?=$value1?>" required="" readonly>
								<input class="form-control m-b-5"  name="edit_id" id="edit_id" type="hidden" value="<?=$edit_id?>" required="" readonly>
								<input class="form-control m-b-5"  name="status_mr" id="status_mr" type="hidden" value="<?=$status_mr?>" required="" readonly>
								<small class="f-s-12 text-grey-darker">MR no</small>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="job_code">Job Code <span style="color: red">*</span></label>
							<div class="col-md-9">
								<input class="form-control m-b-5" placeholder="Enter Activity name" name="job_code_id" id="job_code_id" type="text" value="<?=$job_code_id?>" required="" readonly>
								<small class="f-s-12 text-grey-darker">Job Code</small>
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="tech_evalution">Technical Evalution <span style="color: red">*</span></label>
							<div class="col-md-9">							
								<select name="tech_evalution" class="form-control m-b-5" id="tech_evalution" readonly>
									<option value="2" <?php if($techinal_evalution==2){echo "selected";}?> >No</option>
									<option value="1" <?php if($techinal_evalution==1){echo "selected";}?> >Yes</option>
								</select>
								<small class="f-s-12 text-grey-darker">Select Technical Evalution</small>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="required_date">Date Required <span style="color: red">*</span></label>
							<div class="col-md-9">
								<input disabled="" class="form-control m-b-5 datepickers" placeholder="Enter Date Required " name="required_date" id="required_date" type="text" value="<?=$date_required?>" required="">
								<small class="f-s-12 text-grey-darker">Please enter Date Required</small>
							</div>
						</div>
						<!-- <div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="job_code">Attach Files <span style="color: red">*</span></label>
							<div class="col-md-9">
								<input class=" m-b-5" placeholder="Enter Activity name" name="job_files" id="job_files" type="file"  >	<span class="btn btn-sm btn-info" id="sub">Upload</span>	<br>
								<small class="f-s-12 text-grey-darker">Job Attachment</small>
							</div>
						</div> -->
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="approver_id">Approver Name4 <span style="color: red">*</span></label>
							<div class="col-md-9">
								<?php $data_array_approver=$this->design_user->get_design_approver_list(); ?>
								<select name="approver_id" class="form-control m-b-5" id="approver_id" required="" disabled="">
									<?php 	if($data_array_approver['no_user']==2){ ?>
												<option value="">--No Approver Is found--</option>
									<?php 	}else if($data_array_approver['no_user']==1){	
												foreach ($data_array_approver['user_approver'] as $key_approver) {
													if($approver_id_slno==$key_approver->slno){
														echo "<option value='".$key_approver->slno."' selected>".$key_approver->Username." [ ".$key_approver->email_id." ]</option>";
													}else{
														echo "<option value='".$key_approver->slno."'>".$key_approver->Username." [ ".$key_approver->email_id." ]</option>";
													}
												}
											}
									?>
								</select>
								<small class="f-s-12 text-grey-darker">Select Approver </small>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="materials_id">Material Category <span style="color: red">*</span></label>
							<div class="col-md-9">
								<?php 	$data_array_materials=$this->design_user->get_design_material_category_list();	?>
								<select name="materials_id" class="form-control m-b-5" id="materials_id" readonly>
									<?php 	if($data_array_materials['no_materials']==2){ ?>
												<option value="">--No Material Category Is found--</option>
									<?php
											}else if($data_array_materials['no_materials']==1){									
												foreach ($data_array_materials['materials_list'] as $key_materials) {
													if($materilal_category_id_slno==$key_materials->Slno_cat){
														echo "<option value='".$key_materials->Slno_cat."'>".$key_materials->category_name." [ ".$key_materials->short_code." ]</option>";
													}
												}
											}			
									?>
								</select>
								<small class="f-s-12 text-grey-darker">Select Job Code</small>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="mr_date_of_creation">Date Of Creating<span style="color: red">*</span></label>
							<div class="col-md-9">
								<input class="form-control m-b-5" name="mr_date_of_creation" value="<?=$date_creation?>" id="mr_date_of_creation" type="text" required="" readonly>
								<small class="f-s-12 text-grey-darker">Date Of Creating MR</small>
							</div>
						</div>
						
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="From_location">From Location <span style="color: red">*</span></label>
							<div class="col-md-9">							
								<select name="From_location" class="form-control m-b-5" id="From_location" required="" disabled="">
									<?php 	if($get_location['no_location']==2){ ?>
												<option value="">--No From Location Is found--</option>
									<?php
											}else if($get_location['no_location']==1){
									?>
												<option value="">--From Location--</option>
									<?php 									
									// Array ( [no_mr_location] => 1 [item_location_list] => Array ( [0] => stdClass Object ( [slno_loca_mr] => 1 [mr_id_location] => 2018-10-20-4GOhM [mr_slno_id] => 11 [location_from] => 1 [location_to] => 5 [edit_id] => 1 [entry_date] => 2018-10-23 14:43:31 ) ) ) 
												foreach ($get_location['item_location'] as $key_from_loc) {
													if($query_mr_location_list['item_location_list'][0]->location_from==$key_from_loc->slno_loc){
														echo "<option value='".$key_from_loc->slno_loc."' selected>".$key_from_loc->location_name." </option>";
													}else{
														echo "<option value='".$key_from_loc->slno_loc."'>".$key_from_loc->location_name." </option>";

													}
													
												}
											}			
									?>
								</select>
								<small class="f-s-12 text-grey-darker">Select From Location</small>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="to_location">To Location <span style="color: red">*</span></label>
							<div class="col-md-9">							
								<select name="to_location" class="form-control m-b-5" id="to_location" required="" disabled="">
										<?php 	if($get_location['no_location']==2){ ?>
												<option value="">--No To Location Is found--</option>
									<?php
											}else if($get_location['no_location']==1){
									?>
												<option value="">--To Location--</option>
									<?php 									
												foreach ($get_location['item_location'] as $key_from_loc) {
													if($query_mr_location_list['item_location_list'][0]->location_to==$key_from_loc->slno_loc){
														echo "<option value='".$key_from_loc->slno_loc."' selected>".$key_from_loc->location_name." </option>";
													}else{
														echo "<option value='".$key_from_loc->slno_loc."'>".$key_from_loc->location_name." </option>";

													}
													// echo "<option value='".$key_from_loc->slno_loc."'>".$key_from_loc->location_name." </option>";
													
												}
											}			
									?>
								</select>
								<small class="f-s-12 text-grey-darker">Select To Location</small>
							</div>
						</div>
						
						</div>
					</div>				
					<div class="row">
						<div class="col-lg-12">
							<div id="cart-item-files"></div>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-md-12 col-lg-12">
							<?php
								$result_vehicle=$this->design_user->get_design_master_vehcile_list();
								// print_r($result_vehicle);
								// Array ( [no_vehcile] => 1 [item_vehcile] => Array ( [0] => stdClass Object ( [Slno_vehicle] => 1 [vehicle_type] => 504ponds [vehicle_capacity] => 5ponds [vehicle_desc] => tyyy [category_slno] => 3 [status] => 1 [date_entry] => 2018-10-11 [time_entry] => 21:29:54 ) ) ) 
							?>
							<table id="example_scroll" class="display" style="width:100%">
								<thead>
									<tr>
										<th>Vehicle Type</th>
										<th>Capacity</th>
										<th>Details</th>										
										<th>No</th>
										<th>From Location</th>
										<th>To Location</th>
										<th>Purpose</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$result_vehicle_details=$result_vehicle['item_vehcile'];
										foreach ($result_vehicle_details as $key_vehicle) {
											$in_session = "0";
											if(!empty($_SESSION["cart_item"])) {
												$session_code_array = array_keys($_SESSION["cart_item"]);
												if(in_array($key_vehicle->Slno_vehicle,$session_code_array)) {
													$in_session = "1";
												}else{
													foreach ($edit_result['item_list'] as $key_items => $value_item) {
                                						$code=$value_item->vehicle_slno_id;
												    	if($key_vehicle->Slno_vehicle==$code){
												    		$in_session = "1";
												    		break;
												    	}
												    		
											    	}
												}
											}else{
												foreach ($result_vechile['item_vechile_list'] as $key_items => $value_item) {
                            						$code=$value_item->vehicle_slno_id;
											    	if($key_vehicle->Slno_vehicle==$code){
											    		$in_session = "1";
											    		break;
											    	}
											    		
											    }
											}
								?>
											<tr>
												<td><?=$key_vehicle->vehicle_type?></td>
												<td><?=$key_vehicle->vehicle_capacity?></td>
												<td><?=$key_vehicle->vehicle_desc?></td>
												
												<td><input type="text" id="qty_<?php echo $key_vehicle->Slno_vehicle;?>" name="quantity" value="1" size="2" /></td>
												
												<td>
													<select class="form-control m-b-5" id="location_from_<?php echo $key_vehicle->Slno_vehicle;?>" >
															<?php 	if($get_location['no_location']==2){ ?>
																	<option value="">--No From Location Is found--</option>
														<?php
																}else if($get_location['no_location']==1){
														?>
																	<option value="">--From Location--</option>
														<?php 									
																	foreach ($get_location['item_location'] as $key_from_loc) {
																		echo "<option value='".$key_from_loc->slno_loc."'>".$key_from_loc->location_name." </option>";
																		
																	}
																}			
														?>
													</select>
													
												</td>
												<td>
													<select class="form-control m-b-5" id="location_to_<?php echo $key_vehicle->Slno_vehicle;?>" >
															<?php 	if($get_location['no_location']==2){ ?>
																	<option value="">--No To Location Is found--</option>
														<?php
																}else if($get_location['no_location']==1){
														?>
																	<option value="">--To Location--</option>
														<?php 									
																	foreach ($get_location['item_location'] as $key_from_loc) {
																		echo "<option value='".$key_from_loc->slno_loc."'>".$key_from_loc->location_name." </option>";
																		
																	}
																}			
														?>
													</select>
												
												</td>
												<td><textarea id="purpose_<?php echo $key_vehicle->Slno_vehicle;?>" name="purpose"  size="18" rows="4"> </textarea></td>
												<td>
												<input type="button" id="add_<?php echo $key_vehicle->Slno_vehicle; ?>" value="Add to cart" class="btnAddAction cart-action" onClick = "cartAction('add','<?php echo $key_vehicle->Slno_vehicle; ?>')" <?php if($in_session != "0") { ?>style="display:none" <?php } ?> />
												<input type="button" id="added_<?php echo $key_vehicle->Slno_vehicle; ?>" value="Added" class="btnAdded" <?php if($in_session != "1") { ?>style="display:none" <?php } ?> />
												</td>

											</tr>
								<?php
										}
								?>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<br> -->
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div id="cart-item"></div>
						</div>
					</div>

					<div class="form-group row pull-right">
                            <div class="col-md-12">
                               
                               	<?php echo '<a href="'.base_url().'design-submitted-mr-order-detail/'.$job_code_id.'/2" class="btn btn-lime btn-sm">Back</a>'; ?>
                                <a  href="<?=base_url()?>user-design-home" class="btn btn-sm btn-info">Home</a> 
                            </div>
                        </div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function file_uploaded(){
	var actions_file='files_info_view';
	var Mr_no = $('#Mr_no').val();
	var slno_Mr_no = $('#slno_Mr_no').val();
		queryString_id = 'actions_file='+actions_file+'&Mr_no='+ Mr_no+'&slno_Mr_no='+slno_Mr_no;
	jQuery.ajax({
		url: "<?php echo base_url(); ?>file-upload-data",
		data:queryString_id,
		type: "POST",
		success:function(data){
			$("#cart-item-files").html(data);
		}
	});
}
function file_delete(id) {
	var actions_file='files_info_delete';
	var Mr_no = $('#Mr_no').val();
	var slno_Mr_no = $('#slno_Mr_no').val();
		queryString_id = 'actions_file='+actions_file+'&Mr_no='+ Mr_no+'&slno_Mr_no='+slno_Mr_no+'&file_id='+id;
	jQuery.ajax({
		url: "<?php echo base_url(); ?>file-upload-data",
		data:queryString_id,
		type: "POST",
		success:function(data){
			if(data){
				file_uploaded();
				alert('Successfull attach file is deleted ');
			}else{
				file_uploaded();
				alert('Unable attached file deleted');
			}
		}
	});
}
$(document).ready(function (e) {
	file_uploaded();
	cart_active();
	$('#sub').on('click', function () {
		var actions_file='files_uploaded_details';
		var Mr_no = $('#Mr_no').val();
		var slno_Mr_no = $('#slno_Mr_no').val();
		var file_data = $('#job_files').prop('files')[0];
		if(file_data!=""){
			var form_data = new FormData();
			form_data.append('file', file_data);
			form_data.append('Mr_no', Mr_no);
			form_data.append('slno_Mr_no', slno_Mr_no);
			form_data.append('actions_file', actions_file);
			$.ajax({
				url: '<?php echo base_url(); ?>file-upload-data', // point to server-side controller method
				dataType: 'text', // what to expect back from the server
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					if(response==1){
						file_uploaded();
						alert('File Is successfully attached ');
					}else if(response==2){
						alert('Same File name is found ');
					}else{
						alert('Some thing went worng Please check internet connection ');
					}

				}
			});
		}else{
			alert('Please Attachment Some file click on upload');
		}

	});
});
function cartAction(action,item_codes_order,value='') {
var queryString = "";
	if(action != "") {
		switch(action) {
			case "add":
			if($("#location_from_"+item_codes_order).val()!=""){
				if($("#location_to_"+item_codes_order).val()!=""){
					if($("#purpose_"+item_codes_order).val()!=""){
						queryString = 'action='+action+'&code='+ item_codes_order+'&quantity='+$("#qty_"+item_codes_order).val()+'&from_location='+$("#location_from_"+item_codes_order).val()+'&to_location='+$("#location_to_"+item_codes_order).val()+'&purpose='+$("#purpose_"+item_codes_order).val();
					}else{
						alert('Purpose Field Is left Blank');
					}
				}else{
					alert('Please Select To Location');
				}
			}else{
				alert('Please Select From Location');
				//+'&quantity='+$("#qty_"+item_codes_order).val()
			}
			break;
			case "remove":
				queryString = 'action='+action+'&code='+ item_codes_order+'&codes_value='+value;
			break;
			case "empty":
				queryString = 'action='+action;
			break;
		}	 
	}
	jQuery.ajax({
	url: "<?=base_url()?>vehicle_required_session",
	data:queryString,
	type: "POST",
	success:function(data){
		$("#cart-item").html(data);
		if(action != "") {
			switch(action) {
				case "add":
					if($("#location_from_"+item_codes_order).val()!=""){
						if($("#location_to_"+item_codes_order).val()!=""){
							if($("#purpose_"+item_codes_order).val()!=""){
								$("#add_"+item_codes_order).hide();
								$("#added_"+item_codes_order).show();
							}else{
								alert('Purpose Field Is left Blank');
							}	
						}else{
							alert('Please Select To Location');
						}
					}else{
						alert('Please Select From Location');
						//+'&quantity='+$("#qty_"+item_codes_order).val()
					}	
				break;
				case "remove":
					$("#add_"+item_codes_order).show();
					$("#added_"+item_codes_order).hide();
				break;
				case "empty":
					$(".btnAddAction").show();
					$(".btnAdded").hide();
				break;
			}	 
		}
	},
	error:function (){}
	});	
}

function cart_active(){
		var action='add_vechile_view';
		var actions_file=$('#edit_id').val();;
    	var Mr_no = $('#Mr_no').val();
		var slno_Mr_no = $('#slno_Mr_no').val();
		queryString_id = 'actions_file='+actions_file+'&Mr_no='+ Mr_no+'&slno_Mr_no='+slno_Mr_no+'&action='+action;

		jQuery.ajax({
			url: "<?php echo base_url(); ?>item_required_session_ids",
			data:queryString_id,
			type: "POST",
			success:function(data){
				$("#cart-item").html(data);
			}
		});

	}
</script>

