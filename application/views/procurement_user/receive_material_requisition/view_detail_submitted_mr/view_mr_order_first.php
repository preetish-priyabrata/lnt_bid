<?php 
$email_id=$this->session->userdata('procurement_email_id');

if(empty($email_id)){
	
	redirect('approve-logout-by-pass');
}

$value=$value;
$value1=$value1;
$value2=$value2;
$type='';
if($value2!=$value){
	  $this->session->set_flashdata('error_message', 'Some thing went wrong');
	redirect('user-approver-home');
}
	
?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="<?=base_url()?>user-procurement-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Material Requisition</a></li>
				<li class="breadcrumb-item active">Approved Material Requisition </li>
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
			  <!-- <a href="#" class="alert-link">an example link</a>.  -->
			</div>
			<?php 
			}
			 // print_r($this->session->userdata());
			 ?>
			 <?php if(!empty($this->session->flashdata('error_message'))){?>
			<div class="alert alert-danger fade show">
			  <span class="close" data-dismiss="alert">×</span>
			  <strong>Error!</strong>
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
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Approved Material Requisition Information </h4>
				</div>
				<div class="panel-body">
					
					<div class="alert alert-secondary">
                    	<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                    </div>
					<form action='<?=base_url()?>procurement-assigned-buyer' method='POST'>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="activity_name">MR No </label>
									<div class="col-md-9">
										<?php
										$get_mr_id=$this->approver_user->get_approver_mr_no_deatils($value);
										$mr_no=$get_mr_id['mr_details'][0]->mr_no;
										$job_code_id=$get_mr_id['mr_details'][0]->job_code_id;
										$materilal_category_id_slno=$get_mr_id['mr_details'][0]->materilal_category_id_slno;
										$approver_id=$get_mr_id['mr_details'][0]->approver_id;
										$techinal_evalution=$get_mr_id['mr_details'][0]->techinal_evalution;
										$date_required=$get_mr_id['mr_details'][0]->date_required;
										$date_creation=$get_mr_id['mr_details'][0]->date_creation;
										$edit_id=$get_mr_id['mr_details'][0]->edit_id;
										$status_mr=$get_mr_id['mr_details'][0]->status;
										$resubmit_count=$get_mr_id['mr_details'][0]->resubmit_count;
										$result_drafted=$this->procurement_user->procurement_mr_receive_list($email_id,$type,$value);
										// print_r($result_drafted);
										$Slno_approver=$result_drafted['received_list'][0]->Slno_approver;
										if($status_mr!=1){
											if ($result_drafted['no_received']==2) {
												$this->session->set_flashdata('error_message', 'Some Thing Went Worng');
											    
												redirect('user-approver-home');
											}else{
												if ($result_drafted['received_list'][0]->Forward_status==1) {
													$this->session->set_flashdata('error_message', 'MR is Already Assigned');									    
												redirect('user-approver-home');

												}
											}
											    
										}
										// 
										$result_file=$this->design_user->get_design_mr_file_list($value,$mr_no);

										$query_item_details_list=$this->design_user->get_design_master_mr_items_material_single($edit_id,$mr_no,$value);
										
										?>
										<input class="form-control m-b-5"  name="Mr_no" id="Mr_no" type="text" value="<?=$mr_no?>" required="" readonly>
										<input class="form-control m-b-5"  name="slno_Mr_no" id="slno_Mr_no" type="hidden" value="<?=$value?>" required="" readonly>
										<input class="form-control m-b-5"  name="value1" id="value1" type="hidden" value="<?=$value1?>" required="" readonly>
										<input class="form-control m-b-5"  name="edit_id" id="edit_id" type="hidden" value="<?=$edit_id?>" required="" readonly>
										<input class="form-control m-b-5"  name="status_mr" id="status_mr" type="hidden" value="<?=$status_mr?>" required="" readonly>
										<input class="form-control m-b-5"  name="resubmit_count" id="resubmit_count" type="hidden" value="<?=$resubmit_count?>" required="" readonly>
										<!-- <input class="form-control m-b-5"  name="resubmit_count" id="resubmit_count" type="hidden" value="<?=$resubmit_count?>" required="" readonly> -->
										<input class="form-control m-b-5"  name="Slno_approver" id="Slno_approver" type="hidden" value="<?=$Slno_approver?>" required="" readonly>
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
									<label class="col-form-label col-md-3" for="job_code">Action </label>
										<!-- <span style="color: red">*</span></label> -->
									<div class="col-md-9">
										<input type="text" readonly class="form-control-plaintext" value="Approved" />
									</div>
								</div>

								
								
                              


							</div>
							
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Procurement">Procurement Name 
										<!-- <span style="color: red">*</span> -->
									</label>
									<?php 
						                
						                	
						                		$get_approved=$this->approver_user->get_approver_conform_mr_job_detail($value);
						                		if($get_approved['no_mr_deatils']==1){
						                			$user_procement=$get_approved['mr_details'][0]->Procurement_id;
						                		
						                			$get_Procurement_id=$this->approver_user->approver_get_creator_mr($user_procement);

						                			 $Usget_Procurement_id=$get_Procurement_id['list_user'][0]->Username;
						                		}
						                ?>
						             
									<div class="col-md-9">
									   <input type="text" readonly class="form-control-plaintext" value="<?=$Usget_Procurement_id?>" />
									  </div>
									 </div>
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
										
										<!-- <small class="f-s-12 text-grey-darker">Select Approver </small> -->
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
							<label class="col-form-label col-md-3" for="required_date">Date Required 
								<!-- <span style="color: red">*</span> -->
							</label>
							<div class="col-md-9">
							
								<input type="text" readonly class="form-control-plaintext" value="<?=$date_required?>" />
								<!-- <small class="f-s-12 text-grey-darker">Please enter Date Required</small> -->
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
	                                        <th><strong>Name</strong></th>
	                                        <th><strong>id</strong></th>
	                                        <th><strong>Quantity</strong></th>
	                                        <th><strong>UOM</strong></th>
	                                        <th><strong>Technical Parameter</strong></th>
	                                       
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	
	                                		<?php 
	                                	// echo "<pre>";
	                                		if($query_item_details_list['no_item']==1){
	                                			$item_list=$query_item_details_list['item_list'];
	                                			// print_r($item_list);
	                                			// $this->procurement_user->procurement_mr_item_tech_single();
	                                				foreach ($item_list as $key_item => $value_item) {
	                                					$slno_item_mr=$value_item->slno_item_mr;
	                                					$get_technical=$this->procurement_user->procurement_mr_item_tech_single($slno_item_mr);
														$code=$value_item->material_item_id;
														 $material_quantity=$value_item->material_quantity;
														$query_item_details=$this->design_user->get_design_master_items_material_single($code);
														// print_r($get_technical);

														// $get_technical=$this->procurement_user->procurement_mr_item_tech_single;

	                                			?>
	                                			<tr>
	                                				<td><?=$query_item_details['materials_list'][0]->item_name?></td>
	                                				<td><?=$query_item_details['materials_list'][0]->item_id?></td>
	                                				<td><?=$material_quantity?></td>
			                                      	<td><?=$query_item_details['materials_list'][0]->item_uom?></td>
			                                       	<td>
			                                       		<?php 

			                                       		if($get_technical['no_received']==1){
			                                       			$procuremenr_list_single=$get_technical['procuremenr_list_single'];
			                                       			foreach ($procuremenr_list_single as $key_value_technical) {
			                                       				echo $key_value_technical->tech_name."<br>";
			                                       				# code...
			                                       			}
			                                       		}else{
			                                       			echo " No Parameter is been Selected";
			                                       		}
			                                       		?>

			                                       	</td>
			                                       

	                                			</tr>
	                                			<?php

	                                		}
	                                		}?>
	                                	
	                                </tbody>
	                            </table>
								<?php 
								




								?>
								
							</div>
						</div>
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                            	<button type="submit" class="btn btn-purple btn-sm">Send</button>
                            	<a  href="<?=base_url()?>procurement-new-mr-receive" class="btn btn-sm btn-success">Back</a> 
                                <a  href="<?=base_url()?>user-procurement-home" class="btn btn-sm btn-info">Home</a> 
                            </div>
                        </div>
						
						
					</form>
					
				</div>
			</div>
