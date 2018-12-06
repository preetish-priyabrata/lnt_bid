<?php 
$email_id=$this->session->userdata('buy_email_id');
if(empty($email_id)){
	
	redirect('buy-logout-by-pass');
}
$value=$value;
$value1=$value1;
$value2=$value2;
$value3=$value3;
$value4=$value4;
$get_mr_id=$this->approver_user->get_approver_mr_no_deatils($value1);

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
// $query_item_details_list=$this->design_user->get_design_master_mr_items_material_single($edit_id,$mr_no,$value1);
$result_file=$this->design_user->get_design_mr_file_list($value1,$mr_no);

$get_list_vendors=$this->buyer_user->get_buyer_vendors_list($value2);

$result_vechile=$this->design_user->get_design_master_mr_vechile_single($edit_id,$mr_no,$value1);

$query_mr_location_list=$this->design_user->get_design_master_mr_location_details($edit_id,$mr_no,$value1);

$get_location=$this->design_user->get_design_master_loaction_list();
?>

<div class="sidebar-bg"></div>
	<!-- end #sidebar -->		
	<!-- begin #content -->
	<div id="content" class="content" >
	<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li class="breadcrumb-item active"><a href="<?=base_url()?>user-buyer-home" class="fa fa-home ">Home</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url()?>buyer-mr-received">Received MR</a></li>
			<li class="breadcrumb-item active">Technical Details</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><small>Buyer Technical Setting</small></h1>
		<!-- end page-header -->
	<?php 
		if(!empty($this->session->flashdata('success_message'))){?>
			<div class="alert alert-success fade show">
				<span class="close" data-dismiss="alert">×</span>
				<strong>Success!</strong>
				<?=$this->session->flashdata('success_message')?> 
				  <!-- <a href="#" class="alert-link">an example link</a>.  -->
			</div>
	<?php 
		}
		if(!empty($this->session->flashdata('error_message'))){?>
			<div class="alert alert-danger fade show">
				<span class="close" data-dismiss="alert">×</span>
			  	<strong>Error !</strong>
			  	<?=$this->session->flashdata('error_message')?> 
			  	<!-- <a href="#" class="alert-link">an example link</a>.  -->
			</div>
	<?php 
		}
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
			<h4 class="panel-title">Create Techinical REF</h4>
		</div>
		<div class="panel-body">
			<div class="alert alert-secondary">
                <span style="color: red"> *</span> All mandory fields shall be duly filled up 
            </div>
			<form action="<?=base_url()?>bid-tech-entry" method="POST"  id="bid_tech" name="bid_tech" class="bid_tech">
				
				<input class="form-control m-b-5"  name="slno_Mr_no" id="slno_Mr_no" type="hidden" value="<?=$value1?>" required="" readonly>
				<input class="form-control m-b-5"  name="value4" id="value4" type="hidden" value="<?=$value4?>" required="" readonly>
				<input class="form-control m-b-5"  name="edit_id" id="edit_id" type="hidden" value="<?=$edit_id?>" required="" readonly>
				<input class="form-control m-b-5"  name="status_mr" id="status_mr" type="hidden" value="<?=$status_mr?>" required="" readonly>
				<input class="form-control m-b-5"  name="resubmit_count" id="resubmit_count" type="hidden" value="<?=$resubmit_count?>" required="" readonly>
				<!-- <input class="form-control m-b-5"  name="resubmit_count" id="resubmit_count" type="hidden" value="<?=$resubmit_count?>" required="" readonly> -->
				
				<input name="job_code_id" id="job_code_id" type="hidden" value="<?=$job_code_id?>" required="" readonly>
				<input name="materials_id" id="materials_id" type="hidden" value="<?=$materilal_category_id_slno?>" required="" readonly>	
				<input name="tech_evalution" id="tech_evalution" type="hidden" value="<?=$techinal_evalution?>" required="" readonly>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<h4 class="panel-title text-center">General Information</h4>
						<hr style="height: 2px; background:  green">
					</div>
					

					<div class="col-md-6 col-lg-6">
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="activity_name">MR No </label>
							<div class="col-md-9">
								<input readonly class="form-control-plaintext" name="mr_no" value="<?=$mr_no?>" required="" >
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="job_code">Job Code 
								
							</label>
							<div class="col-md-9">
								<input readonly class="form-control-plaintext" name="job_code_id" value="<?=$job_code_id?>" required="" >
								
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
								
								<input readonly class="form-control-plaintext text-capitalize" name="category_name" value="<?=$category_name?>" id="mr_date_of_creation" type="text" required="" >
								
							</div>
						</div>
					 	
						
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="tech_evalution">Technical Evalution </label>
							<div class="col-md-9">					
								<?php if($techinal_evalution==2){?>
								<input type="text" readonly class="form-control-plaintext" value="No" />
								<?php } else if($techinal_evalution==1){ ?>
									<input type="text" readonly class="form-control-plaintext" value="Yes" />
								<?php }?>
															
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-form-label col-md-3" for="required_date">Date Required </label>
							<div class="col-md-9">
								<input type="text" readonly name="date_required" class="form-control-plaintext" value="<?=$date_required?>" />								
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
									<input readonly class="form-control-plaintext" name="from_key_from_loc" value="<?=$from_key_from_loc?>" id="" type="text" required="" >		
										
								
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
									<input readonly class="form-control-plaintext" name="from_key_to_loc" value="<?=$from_key_to_loc?>" id="" type="text" required="" >		
								</div>
						</div>

					 	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div id="accordion">
							<div class="card">
								<div class="card-header text-center">
									<a class="card-link" data-toggle="collapse" href="#collapseOne">
										Basic Details
									</a>
								</div>
								<div id="collapseOne" class="collapse show" data-parent="#accordion">
									<div class="card-body">
										<h5 class="text-left">Basic Details</h5>
										<hr style="background: lightblue">
										<!-- row Start -->
										<div class="row">
											<!-- part A -->
											<div class="col-md-6 col-lg-6">
												<!-- Part A Start  -->

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="date_create">Date </label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="" name="date_create" id="date_create" type="text" value="<?=date('Y-m-d')?>" required="" readonly style='opacity: 1'>
															<small class="f-s-12 text-grey-darker">---</small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="bid_ref_no">Bid Ref No <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5" onkeyup="get_bid_ref(1)" placeholder="Enter Bid Ref No" name="bid_ref_no" id="bid_ref_no" type="text" required="" >
														<span id="job_code_error1"></span><br>	
														<small class="f-s-12 text-grey-darker">Here enter Bid Ref No Should Be Unique</small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="bid_method">Mode Of Selection <span style="color: red">*</span></label>
													<div class="col-md-9">
												  		<select class="form-control" id="bid_method"  name="bid_method">
												    		<option value="">--Please Select Mod Of Selection--</option>
												    		<option value="Closed Bid">Closed Bid </option>
												    		<option value="Rank Order Bid">Rank Order Bid </option>
												    		<option value="Simple Bid">Simple Bid </option>
												  		</select>
												  		<small class="f-s-12 text-grey-darker">Please Select Mode Of Selection</small>
												  	</div>
												</div> 

												<!-- part A end -->
											</div>

											<!-- Part B -->
											<div class="col-md-6 col-lg-6">
												<!-- part B Start -->

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="date_publish">Bid Publish Date <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5 datepickers" placeholder="Enter Activity name" name="date_publish" id="date_publish" type="text" required="" >
														<small class="f-s-12 text-grey-darker">Please Select Bid Publish Date</small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="bid_Id">Bid Id <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Bid Id " onkeyup="get_bid_ref(2)" name="bid_Id" id="bid_Id" type="text" required="" >
														<span id="job_code_error2"></span><br>	
														<small class="f-s-12 text-grey-darker">Here enter Bid Id Should Be Unique</small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="date_closing">Date Of Closing <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5 datepickers" placeholder="Enter Date Of Closing" name="date_closing" id="date_closing" type="text" required="" >
														<small class="f-s-12 text-grey-darker">Please Select Date Of Closing</small>
													</div>
												</div>


												<!-- part B End -->
											</div>
											<!-- part B  -->
										</div>
									</div>
								</div>
							</div>
							<!-- part Accordion 1 End -->
							<!-- Part Accordion 2 Start -->
							<div class="card">
								<div class="card-header text-center">
									<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
										Work Item Details
									</a>
								</div>
								<div id="collapseTwo" class="collapse" data-parent="#accordion">
									<div class="card-body">
										<h5 class="text-left">Work Item Details</h5>
										<hr style="background: lightblue">
										<!-- row Start -->
										<div class="row">
											<!-- part c -->
											<div class="col-md-6 col-lg-6">
												<!-- part c start -->

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="bid_title">Bid Title  <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Bid Title" name="bid_title" id="bid_title" type="text" required="">
														<small class="f-s-12 text-grey-darker">Here enter Bid Title</small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="bid_period_work">Period Of Work  <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Period Of Work" name="bid_period_work" id="bid_period_work" type="text" required="">
														<small class="f-s-12 text-grey-darker">Here enter Period Of Work</small>
													</div>
												</div>

												<!-- part c end -->
											</div>
											<!-- part c end here -->
											<!-- part d -->
											<div class="col-md-6 col-lg-6">
												<!-- part d start -->

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3">Work Description  <span style="color: red">*</span></label>
													<div class="col-md-9">
														<textarea class="form-control" rows="3" name="bid_work_description" required=""></textarea>
														<small class="f-s-12 text-grey-darker"> Please enter Work Description  </small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="bid_location_work">Location Of Work  <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Location Of Work" name="bid_location_work" id="bid_location_work" type="text" required="">
														<small class="f-s-12 text-grey-darker">Here enter Location Of Work</small>
													</div>
												</div>


												<!-- part d end -->
											</div>
											<!-- part d end here -->
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
																	<td><?=$get_location_from['item_location'][0]->location_name?></td>
																	<td><?=$get_location_to['item_location'][0]->location_name?></td>
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
									</div>
								</div>
							</div>
							<!-- part Accordion 2 End -->
							<!-- Part Accordion 3 Start -->
							<div class="card">
								<div class="card-header text-center">
									<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
										Critical Date
									</a>
								</div>
								<div id="collapseThree" class="collapse" data-parent="#accordion">
									<div class="card-body">
										<h5 class="text-left">Work Item Details</h5>
										<hr style="background: lightblue">
										<!-- row Start -->
										<div class="row">
											<!-- part e -->
											<div class="col-md-6 col-lg-6">
												<!-- part e start -->

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="date_start_bid">Bid Start Date <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5 datepickers" placeholder="EnterBid Start Date" name="date_start_bid" id="date_start_bid" type="text" required="" >
														<small class="f-s-12 text-grey-darker">Please Select Bid Start Date</small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="date_clearfication_bid">Bid Clearfication Date <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5 datepickers" placeholder="EnterBid Clearfication Date" name="date_clearfication_bid" id="date_clearfication_bid" type="text" required="" >
														<small class="f-s-12 text-grey-darker">Please Select Bid Clearfication Date</small>
													</div>
												</div>
												<!-- part e end -->
											</div>
											<!-- part e end Here -->
											<!-- part f -->
											<div class="col-md-6 col-lg-6">
												<!-- part f start -->
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="date_closed_bid">Bid Closed Date <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5 datepickers" placeholder="EnterBid Closed Date" name="date_closed_bid" id="date_closed_bid" type="text" required="" >
														<small class="f-s-12 text-grey-darker">Please Select Bid Closed Date</small>
													</div>
												</div>

												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3">Detail Description  <span style="color: red">*</span></label>
													<div class="col-md-9">
														<textarea class="form-control" rows="3" name="bid_detail_description" required=""></textarea>
														<small class="f-s-12 text-grey-darker"> Please enter Detail Description  </small>
													</div>
												</div>
												<!-- part f end -->
											</div>
											<!-- part f end Here -->
										</div>
										<!-- row end here -->
									</div>
								</div>
							</div>
							<!-- part Accordion 3 End -->

							<!-- Part Accordion 4 Start -->
							<div class="card">
								<div class="card-header text-center">
									<a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
										Attach Files
									</a>
								</div>
								<div id="collapseFour" class="collapse" data-parent="#accordion">
									<div class="card-body">
										<h5 class="text-left">Attach Files Details</h5>
										<hr style="background: lightblue">
										<!-- row Start -->
										<div class="row">
											<!-- part g -->
											<div class="col-md-6 col-lg-6">

												<!-- part g start -->
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="job_code">Attach Files <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class=" m-b-5" placeholder="Enter Activity name" name="job_files" id="job_files" type="file"  >	<span class="btn btn-sm btn-info" id="sub">Upload</span>	<br>								
														<small class="f-s-12 text-grey-darker">Job Attachment</small>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div id="cart-item-files"></div>
													</div>
												</div>
												<!-- part g end -->
											</div>
											<!-- part g end here -->
											<!-- part h -->
											<div class="col-md-6 col-lg-6">
												<!-- part h start -->
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

												<!-- part h end -->
											</div>
											<!-- part h end here -->
										</div>
										<!-- row end here -->
									</div>
								</div>
							</div>
							<!-- part Accordion 4 End -->

							 <div class="card">
							    <div class="card-header text-center">
							      	<a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
							       		Technical Evaluator / Vendor Selection
							      	</a>
							    </div>
							    <div id="collapseFive" class="collapse" data-parent="#accordion">
							      	<div class="card-body">
							       		<h5 class="text-left">Technical Evaluator / Vendor Selection</h5>
										<hr style="background: lightblue">
										<!-- row Start -->
										<div class="row">
											<!-- part g -->
											<div class="col-md-6 col-lg-6">
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Technical_ev" >Technical Evaluator Name <span style="color: red">*</span></label>
													<div class="col-md-9">
														<?php
														$data_array_approver=$this->buyer_user->get_user_generic_list('1','0','0','9','','');	
															
														?>
														
														<select name="Technical_ev"  class="form-control m-b-5" id="Technical_ev" required="" >
															<?php 
															if($data_array_approver['no_user']==2){?>
																<option value="">--No Technical Evaluator Is found--</option>
																<?php
															}else if($data_array_approver['no_user']==1){
																?>
																<option value="">--Select Technical Evaluator--</option>
															<?php
																foreach ($data_array_approver['user_approver'] as $key_approver) {
																	echo "<option value='".$key_approver->slno."'>".$key_approver->Username." [ ".$key_approver->email_id." ]</option>";
																}
															
																
															}	
															?>										
															
														</select>
														<small class="f-s-12 text-grey-darker">Select Technical Evaluator </small>
													</div>
												</div>

											</div>
											<!-- part g -->
											<div class="col-md-6 col-lg-6">
												
												<div class="row">
													<div class="col-lg-12">
														<table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
									                        <thead>
									                            <tr>
									                                <th><strong>Check </strong></th>
									                                <th><strong>Vendor View</strong></th>                                
									                               
									                            </tr>
									                        </thead>
									                        <tbody>

									                            <?php 
									                            if($get_list_vendors['No_vendors']==1){
										                            foreach($get_list_vendors['vendors_lists'] as $key_vendors){ ?>
										                                <tr>
										                                    <td><input type="checkbox" name="vendor_array[]" value="<?=$key_vendors->Vendor_email_id?>"></td>   
										                                    <td>
										                                    	<p>Vendor Name : <?=$key_vendors->Vendor_name?></p>
										                                    		<p>Organisation Name : <?=$key_vendors->Organisation_name?></p>
										                                    	<p>Vendor Mobile : <?=$key_vendors->Mobile_no?></p>
										                                    	<p>Vendor Address : <?=$key_vendors->Organisation_address?></p>
										                                    </td>                           
										                                   
										                                </tr> 


									                         	 <?php
									                         	 	 }

									                        	}
									                        ?>

									                        </tbody>
									                    </table>
													</div>
												</div>
											</div>
										</div>
											

							      	</div>
							    </div>
							</div>
						</div>
					</div>
				</div>


				<div class="form-group row pull-right">
                    <div class="col-md-12">
                    	<input type="submit" id="spl" class="btn btn-sm btn-primary m-r-5" name="for" value="Save">
                        <!-- <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button> -->
                        <a  href="user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                    </div>
                </div>			
			</form>			
		</div>
	</div>
</div>

<script type="text/javascript">
			
	function get_bid_ref(id) {
		

		if(id==1){
					var job_code=document.getElementById('bid_ref_no').value;
					var pass1 = document.getElementById('bid_ref_no');
					var message = document.getElementById('job_code_error1');
					
   					var goodColor = "#0C6";
    				var badColor = "#FF9B37";    				
					var results;
					if(job_code!=""){
						// alert(job_code);
					  	$.ajax({
						  	url:'<?=base_url()?>get-buyer-bid-check',
						    method: 'post',
						    data: {field_id:'1',job_codes:job_code},
						    // dataType: 'json',
						    success: function(response){
						    // alert(response);	
						    	if(response==1){
									pass1.style.backgroundColor = goodColor;
							        message.style.color = goodColor;
							        message.innerHTML = "valid Bid Ref code";
							        $('#spl').show();
							        results=1;
							        return 1;
							        
								}else if(response==2){
									pass1.style.backgroundColor = badColor;
							        message.style.color = badColor;
							        message.innerHTML = "invalid Bid Ref code";
							        results=2;
							        $('#bid_ref_no').val('');
							        $('#spl').hide();
							         return false;
							         
							         
								}
							}
						});
						// alert(results);
					  	// if(results==1){
					  	// 	return true;
					  	// }else{
					  	// 	return false;
					  	// }
					}else{
						pass1.style.backgroundColor = badColor;
						message.style.color = badColor;
						message.innerHTML = "Should not left blank";
						 return false;
					}
		}else if(id==2){
			var job_code=document.getElementById('bid_Id').value;
			var pass1 = document.getElementById('bid_Id');
			var message = document.getElementById('job_code_error2');
					
   			var goodColor = "#0C6";
    		var badColor = "#FF9B37";				
			if(job_code!=""){
			   $.ajax({
									url:'<?=base_url()?>get-buyer-bid-check',
									method: 'post',
									data: {field_id:'2',job_codes:job_code},
									    // dataType: 'json',
									success: function(response){						   
									    if(response==1){
											pass1.style.backgroundColor = goodColor;
									        message.style.color = goodColor;
									        message.innerHTML = "valid Bid id code";
									        $('#spl').show();
									        // return 	get_bid_ref(true);						       
									        // return "preetish";

										        
										}else if(response==2){
											pass1.style.backgroundColor = badColor;
									        message.style.color = badColor;
									        message.innerHTML = "invalid Bid id code";									      
									        $('#bid_Id').val('');
									        $('#spl').hide();
									         return false;							         
									         
										}

									}
								})
			  		// alert(values_ids);
			  		// console.log(values_ids);
						
					}else{
						pass1.style.backgroundColor = badColor;
						message.style.color = badColor;
						message.innerHTML = "Should not left blank";
						 return false;
					}
		}
	}
			function check_before_submiting(){
					console.log(get_bid_ref(1));
					console.log(get_bid_ref(2));
					if((get_bid_ref('1')==1)||(get_bid_ref('1')===true)){
						// alert(get_bid_ref(1));
						if((get_bid_ref('2')==1)||(get_bid_ref('2')===true)){
							// alert(get_bid_ref(2));
							
							return 1;
						}
					}
				}
					
				
			// }
			$('#bid_tech').submit(function(){
				console.log(check_before_submiting());
							if(!$('#bid_tech input[type="checkbox"]').is(':checked')){
							      alert("Please check at least one Vendor.");
							      return false;
							  }else{
							  	
							  		document.getElementById("bid_tech").submit(); //form submission
							  	
							  }
							    // }else{
							    // 	check_before_submiting();
							    // }
							});
							  // 
function file_delete(id) {
		var actions_file='files_info_delete';
    	var value4 = $('#value4').val();
		var slno_Mr_no = $('#slno_Mr_no').val();
		queryString_id = 'actions_file='+actions_file+'&value4='+ value4+'&slno_Mr_no='+slno_Mr_no+'&file_id='+id;

		jQuery.ajax({
			url: "<?php echo base_url(); ?>buyer-file-upload-data",
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
		// body...
	}
  
function file_uploaded(){
		var actions_file='files_info';
    	var value4 = $('#value4').val();
		var slno_Mr_no = $('#slno_Mr_no').val();
		queryString_id = 'actions_file='+actions_file+'&value4='+ value4+'&slno_Mr_no='+slno_Mr_no;

		jQuery.ajax({
			url: "<?php echo base_url(); ?>buyer-file-upload-data",
			data:queryString_id,
			type: "POST",
			success:function(data){
				$("#cart-item-files").html(data);
			}
		});

	}
 $(document).ready(function (e) {
 	$('#spl').hide();

   		file_uploaded();
        $('#sub').on('click', function () {
        	var actions_file='files_uploaded_details';
        	var value4 = $('#value4').val();
			var slno_Mr_no = $('#slno_Mr_no').val();
            var file_data = $('#job_files').prop('files')[0];
            if(file_data!=""){
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('value4', value4);
          		form_data.append('slno_Mr_no', slno_Mr_no);
          		form_data.append('actions_file', actions_file);

                $.ajax({
                    url: '<?php echo base_url(); ?>buyer-file-upload-data', // point to server-side controller method
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
                        // $('#msg').html(response); // display success response from the server
                    }
                    // error: function (response) {
                    //     $('#msg').html(response); // display error response from the server
                    // }
                });
            }else{
            	alert('Please Attachment Some file click on upload');
            }

        });
    });
</script>
