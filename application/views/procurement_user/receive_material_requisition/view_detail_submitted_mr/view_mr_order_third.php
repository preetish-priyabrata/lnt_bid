<?php 
$email_id=$this->session->userdata('procurement_email_id');
if(empty($email_id)){
	
	redirect('procurement-logout-by-pass');
}

$value=$value;
$value1=$value1;
$value2=$value2;
$type='';
if($value2!=$value){
	  $this->session->set_flashdata('error_message', 'Some thing went worng');
	redirect('user-approver-home');
}
$data_array_procurement=$this->approver_user->get_approver_procurement_list();	
$get_location=$this->design_user->get_design_master_loaction_list();
// print_r($get_location);
?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<div class="sidebar-bg"></div><!-- end #sidebar -->
	<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item active"><a href="<?=base_url()?>user-approver-home" class="fa fa-home ">Home</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Material Requisition</a></li>
		<li class="breadcrumb-item active">Approved Material Requisition</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Approved Material Requisition   </h1>
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
			<h4 class="panel-title">Approved Material Requisition Information  </h4>
		</div>
		<div class="panel-body">
			<div class="alert alert-secondary">
				<span style="color: red"> *</span> All mandory fields shall be duly filled up
			</div>
			<form action='<?=base_url()?>procurement-assigned-buyer' method='POST'>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="activity_name">MR No
							 <!-- <span style="color: red">*</span> -->
							</label>
							<div class="col-md-9">
								<?php
									$get_mr_id=$this->design_user->get_design_mr_no_deatils($value);
									$mr_no=$get_mr_id['mr_details'][0]->mr_no;
									$job_code_id=$get_mr_id['mr_details'][0]->job_code_id;
									$materilal_category_id_slno=$get_mr_id['mr_details'][0]->materilal_category_id_slno;
									$approver_id=$get_mr_id['mr_details'][0]->approver_id;
									$techinal_evalution=$get_mr_id['mr_details'][0]->techinal_evalution;
									$date_required=$get_mr_id['mr_details'][0]->date_required;
									$date_creation=$get_mr_id['mr_details'][0]->date_creation;
									$edit_id=$get_mr_id['mr_details'][0]->edit_id;
									$status_mr=$get_mr_id['mr_details'][0]->status;
									$query_mr_location_list=$this->design_user->get_design_master_mr_location_details($edit_id,$mr_no,$value);

									$result_vechile=$this->design_user->get_design_master_mr_vechile_single($edit_id,$mr_no,$value);
									$resubmit_count=$get_mr_id['mr_details'][0]->resubmit_count;
									$result_drafted=$this->procurement_user->procurement_mr_receive_list($email_id,$type,$value);
										// print_r($result_drafted);
										$Slno_approver=$result_drafted['received_list'][0]->Slno_approver;
										if($status_mr!=1){
											if ($result_drafted['no_received']==2) {
												$this->session->set_flashdata('error_message', 'Some Thing Went Wrong');
											    
												redirect('user-approver-home');
											}else{
												if ($result_drafted['received_list'][0]->Forward_status==1) {
													$this->session->set_flashdata('error_message', 'MR is Already Assigned');									    
												redirect('user-approver-home');

												}
											}
											    
										}
										if($status_mr!=1){
											    $this->session->set_flashdata('error_message', 'Editing is denied for this MR');
											    
												redirect('user-approver-home');
										}
									
									$result_file=$this->design_user->get_design_mr_file_list($value,$mr_no);
									$result_vechile=$this->design_user->get_design_master_mr_vechile_single($edit_id,$mr_no,$value);
								?>
								<input name="Mr_no" id="Mr_no" type="text" value="<?=$mr_no?>" required="" readonly>
								<input name="slno_Mr_no" id="slno_Mr_no" type="hidden" value="<?=$value?>" required="" readonly>
								<input name="value1" id="value1" type="hidden" value="<?=$value1?>" required="" readonly>
								<input name="edit_id" id="edit_id" type="hidden" value="<?=$edit_id?>" required="" readonly>
								<input name="status_mr" id="status_mr" type="hidden" value="<?=$status_mr?>" required="" readonly>
								<input name="resubmit_count" id="resubmit_count" type="hidden" value="<?=$resubmit_count?>" required="" readonly>
								<input name="Slno_approver" id="Slno_approver" type="hidden" value="<?=$Slno_approver?>" required="" readonly>
								<input name="job_code_id" id="job_code_id" type="hidden" value="<?=$job_code_id?>" required="" readonly>
								<input name="materials_id" id="materials_id" type="hidden" value="<?=$materilal_category_id_slno?>" required="" readonly>	
								<input name="tech_evalution" id="tech_evalution" type="hidden" value="<?=$techinal_evalution?>" required="" readonly>	
								<!-- <small class="f-s-12 text-grey-darker">MR no</small> -->
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="job_code">Job Code 
								<!-- <span style="color: red">*</span> -->
							</label>
							<div class="col-md-9">
								<input readonly class="form-control-plaintext" value="<?=$job_code_id?>" required="" readonly>
								<!-- <small class="f-s-12 text-grey-darker">Job Code</small> -->
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="tech_evalution">Technical Evalution 
								<!-- <span style="color: red">*</span> -->
							</label>
							<div class="col-md-9">							
							
								<?php if($techinal_evalution==2){?>
								<input type="text" readonly class="form-control-plaintext" value="No" />
								<?php } else if($techinal_evalution==1){ ?>
									<input type="text" readonly class="form-control-plaintext" value="Yes" />

<?php }?>								<!-- <small class="f-s-12 text-grey-darker">Select Technical Evalution</small> -->
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="required_date">Date Required 
								<!-- <span style="color: red">*</span> -->
							</label>
							<div class="col-md-9">
							
								<input type="text" readonly class="form-control-plaintext" value="<?=$date_required?>" />
								<!-- <small class="f-s-12 text-grey-darker">Please enter Date Required</small> -->
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="job_code">Action </label>
							<div class="col-md-9">
								<input type="text" readonly class="form-control-plaintext" value="Approved" />
												
								
							</div>
						</div>

						<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Procurement">Procurement Name 
										
									</label>
									<div class="col-md-9">															
										<?php 
						                
						                	
						                		$get_approved=$this->approver_user->get_approver_conform_mr_job_detail($value);
						                		if($get_approved['no_mr_deatils']==1){
						                			$user_procement=$get_approved['mr_details'][0]->Procurement_id;
						                		
						                			$get_Procurement_id=$this->approver_user->approver_get_creator_mr($user_procement);

						                			 $Usget_Procurement_id=$get_Procurement_id['list_user'][0]->Username;
						                		}
						                ?>
						                 <input type="text" readonly class="form-control-plaintext" value="<?=$Usget_Procurement_id?>" 
									</div>
								</div>
					</div>
					</div>
					
					<div class="col-md-6 col-lg-6">
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="approver_id">Approver Name
							 <!-- <span style="color: red">*</span> -->
							</label>
							<div class="col-md-9">
								<?php 
											$get_approver_id_slno=$this->approver_user->approver_get_creator_mr($approver_id);
						                			// print_r($get_approver_id_slno);
						                			 $Username_get_Procurement_id=$get_approver_id_slno['list_user'][0]->Username;
						                		
						                ?>
										<input type="text" readonly class="form-control-plaintext" value="<?=$Username_get_Procurement_id?>" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="materials_id">Material Category </label>
							<div class="col-md-9">
								<?php 	$data_array_materials=$this->design_user->get_design_material_category_list();	?>
								
									<?php 	if($data_array_materials['no_materials']==2){
												$category_name='No Mateial Found';
								
											}else if($data_array_materials['no_materials']==1){									
												foreach ($data_array_materials['materials_list'] as $key_materials) {
													if($materilal_category_id_slno==$key_materials->Slno_cat){
														$category_name= $key_materials->category_name." [ ".$key_materials->short_code." ]";
													}
												}
											}			
									?>
								
								<input readonly class="form-control-plaintext" value="<?=$category_name?>" id="mr_date_of_creation" type="text" required="" >
								
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="mr_date_of_creation">Date Of Creating</label>
							<div class="col-md-9">
								<input readonly class="form-control-plaintext" value="<?=$date_creation?>" id="mr_date_of_creation" type="text" required="" >
								
							</div>
						</div>
						
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="From_location">From Location </label>
							<div class="col-md-9">
									<?php 	if($get_location['no_location']==2){ ?>
										<input readonly class="form-control-plaintext" value="No From Location Is selected" id="" type="text" required="" >		
									<?php }else if($get_location['no_location']==1){
										foreach ($get_location['item_location'] as $key_from_loc) {
											if($query_mr_location_list['item_location_list'][0]->location_from==$key_from_loc->slno_loc){
												$from_key_from_loc=$key_from_loc->location_name;
											}
										}
									}
									?>		
									<input readonly class="form-control-plaintext" value="<?=$from_key_from_loc?>" id="" type="text" required="" >		
										
								
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="to_location">To Location </label>
							<div class="col-md-9">		
								<?php 	if($get_location['no_location']==2){ ?>
										<input readonly class="form-control-plaintext" value="No From Location Is selected" id="" type="text" required="" >		
									<?php }else if($get_location['no_location']==1){
										foreach ($get_location['item_location'] as $key_from_loc) {
											if($query_mr_location_list['item_location_list'][0]->location_to==$key_from_loc->slno_loc){
												$from_key_to_loc=$key_from_loc->location_name;
											}
										}
									}
									?>		
									<input readonly class="form-control-plaintext" value="<?=$from_key_to_loc?>" id="" type="text" required="" >		
								</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="buyer_id">Buyer Name <span style="color: red">*</span></label>
							<div class="col-md-9">
								<?php
								$data_array_buyer=$this->procurement_user->get_procurement_buyer_list();	
									
								?>
								
								<select name="buyer_id" class="form-control m-b-5" id="buyer_id"  required="" >
									<?php 
									if($data_array_buyer['no_user']==2){?>
										<option value="">--No Buyer Is found--</option>
										<?php
									}else if($data_array_buyer['no_user']==1){
										?>
										<option value="">--Select Buyer--</option>
									<?php
										foreach ($data_array_buyer['user_buyer_list'] as $key_buyer) {
											echo "<option value='".$key_buyer->slno."'>".$key_buyer->Username." [ ".$key_buyer->email_id." ]</option>";
										}
									
										
									}	
									?>										
									
								</select>
								<small class="f-s-12 text-grey-darker">Select Buyer </small>
							</div>
						</div>
						
						</div>
					</div>				
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
			                        <thead>
			                            <tr>
			                                <th><strong>File Name</strong></th>
			                                <th><strong>Click View</strong></th>                                
			                               
			                            </tr>
			                        </thead>
			                        <tbody>
			                            <?php foreach($result_file['files_list'] as $key_files){ ?>
			                                <tr>
			                                    <td><strong><?=$key_files->file_name_actucal?></strong></td>
			                                    <td><strong><a target="_blank" href="<?=base_url()?>upload_files/design_upload/<?=$key_files->attach_name?>">Click View</a> </strong></td>                                
			                                   
			                                </tr> 


			                            <?php }?>

			                        </tbody>
			                    </table>
							</div>
						</div>
					
					
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                       <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th>Details</th>                                        
                                        <th>No</th>
                                        <th>From Location</th>
                                        <th>To Location</th>
                                        <th>Purpose</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	 if($result_vechile['no_vechile']==1){
			                        	foreach ($result_vechile['item_vechile_list'] as $key_value_vechile) {
				                           $code=$vehicle_slno_id_single=$key_value_vechile->vehicle_slno_id;
				                            $from_location_slno_single=$key_value_vechile->from_location_slno;
				                            $to_location_slno_single=$key_value_vechile->to_location_slno;
				                            $purpose_info_single=($key_value_vechile->purpose_info);
				                            $no_vehcile_single=$key_value_vechile->no_vehcile;
				                            $slno_mr_logistic=$key_value_vechile->slno_mr_logistic;
				                            $get_location_from=$this->design_user->get_design_master_loaction_list($from_location_slno_single); // from location information will come out

				                            $get_location_to=$this->design_user->get_design_master_loaction_list($to_location_slno_single); // to location information will come out
	                            			$query_item_details=$this->design_user->get_design_master_vehcile_list($code);
	                            			 

	                            	?>
	                            			<tr>
		                                        <td><?=$query_item_details['item_vehcile'][0]->vehicle_type?></td>
		                                        <td><?=$query_item_details['item_vehcile'][0]->vehicle_capacity?></td>
		                                        <td><?=$no_vehcile_single?></td>
		                                         <td><?=$query_item_details['item_vehcile'][0]->vehicle_desc?></td>
		                                        <td><?=$get_location_from['item_location'][0]->location_name?>
		                                            
		                                        </td>
		                                        <td><?=$get_location_to['item_location'][0]->location_name?>
		                                            
		                                        </td>
		                                        <td><?=$purpose_info_single?></td>	                                      
                                    		</tr>
	                            	<?php
	                            		}
	                            	}
	                            	?>
                                </tbody>
                            </table>
						</div>
					</div>

					<div class="form-group row pull-right">
                            <div class="col-md-12">
                               	<button type="submit" class="btn btn-purple btn-sm">Send</button>
                               	<a  href="<?=base_url()?>approver-new-mr-conform" class="btn btn-sm btn-success">Back</a> 
                                <a  href="<?=base_url()?>user-approver-home" class="btn btn-sm btn-info">Home</a> 
                            </div>
                        </div>
				</form>
			</div>
		</div>
	</div>
</div>

