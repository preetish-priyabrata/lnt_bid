<?php 
$email_id=$this->session->userdata('bu_email_id');
if(empty($email_id)){
	
	redirect('bu-logout-by-pass');
}
$value=$value;
$resutl=$this->user->get_bu_trackinh(1,$value);
$data_received=$resutl['received_list'][0];

?>

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="#" class="fa fa-home ">Home</a></li>
				<!-- <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li> -->
				<li class="breadcrumb-item active">Edit New Tracking Tool</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit New Tracking Tool
			 <!-- <small>header small text goes here...</small> -->
			</h1>
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
			// echo $this->uri->uri_string();
			//  echo "<br>";
			//  echo $currentURL = current_url(); //for simple URL
			// echo "<br>";
			//  echo $params = $_SERVER['QUERY_STRING']; //for parameters
			//  echo "<br>";
			//  echo $fullURL = $currentURL . '?' . $params; //full URL with parameter
			//  echo "<br>";

			//  //if you want to get parameter from url use:
			// 	 parse_str($_SERVER['QUERY_STRING'], $_GET);
			// 	 //then you can use:
			// 	 if(isset($_GET["par"])){
			// 	      echo $_GET["par"];
			// 	 }
			// 	 //if you want to get current page url use:
			// 	echo $current_url = current_url();
			// 	echo "<br>";
			//  // print_r($this->session->userdata());
			//  // 
			//  echo $url= $_SERVER['HTTP_REFERER'];
			//  // print_r($this->session->userdata());
			 ?>

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
					<!-- 	<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Edit Tracking Tool</h4>
				</div>
				
					<div class="panel-body">
					<div class="alert alert-secondary">
                       	<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                    </div>	
                    <form action="<?=base_url()?>bu-update-tracking-save" method="POST">
                    <input type="hidden" name="Slno_tracking" value="<?=$data_received->Slno_tracking?>">					
						<div id="accordion">
						    <div class="card">
						      <div class="card-header text-center">
						        <a class="card-link text-center" data-toggle="collapse" href="#collapseOne">
						          Section I
						        </a>
						      </div>
						      <div id="collapseOne" class="collapse show" data-parent="#accordion">
						        <div class="card-body">
						        	<h4 class="text-center" style="color: lightblue">Section I</h4>
						        	<hr>
						         	<div class="row">
										<div class="col-md-6 col-lg-6">
										 	<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Date_creation"> Create of Date <span style="color: red">*</span></label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Create of Date" name="Date_creation" id="Date_creation" type="text" value="<?=$data_received->Date_creation?>" required="">
													<small class="f-s-12 text-grey-darker">Here enter Create of Date</small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Po_no"> PO No <span style="color: red">*</span></label>
												<div class="col-md-9">
													<input class="form-control m-b-5" placeholder="Enter PO No" name="Po_no" id="Po_no" type="text" required="" value="<?=$data_received->Po_no?>">
													<small class="f-s-12 text-grey-darker">Here enter PO No</small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Bg_submission_date"> BG Submission Date </label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter BG Submission Date" name="Bg_submission_date" id="Bg_submission_date" type="text"  value="<?=$data_received->Bg_submission_date?>">
													<small class="f-s-12 text-grey-darker">Here enter BG Submission Date</small>
												</div>
											</div>
	                                        
	                                        <div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Mfg_clear_date"> Mfg Clearance Date <span style="color: red"></span></label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Mfg Clearance Date" name="Mfg_clear_date" id="Mfg_clear_date" type="text" value="<?=$data_received->Mfg_clear_date?>">
													<small class="f-s-12 text-grey-darker">Here enter Mfg Clearance Date</small>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6">
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Job_code"> Job Code <span style="color: red">*</span></label>
												<div class="col-md-9">
													<input class="form-control m-b-5" placeholder="Enter Job Code" name="Job_code" id="Job_code" type="text" required="" value="<?=$data_received->Job_code?>">
													<small class="f-s-12 text-grey-darker">Here enter Job Code</small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Po_date"> PO Date <span style="color: red">*</span></label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Po Date" name="Po_date" id="Po_date" type="text" required="" value="<?=$data_received->Po_date?>">
													<small class="f-s-12 text-grey-darker">Here enter PO Date</small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Advance_payment_date"> Advance Payment Date </label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Advance Date" name="Advance_payment_date" id="Advance_payment_date" type="text" value="<?=$data_received->Advance_payment_date?>">
													<small class="f-s-12 text-grey-darker">Here enter Advance Payment Date</small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Drg_approval_date"> Drg Approval Date </label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Drg Approval Date" name="Drg_approval_date" id="Drg_approval_date" type="text"  value="<?=$data_received->Drg_approval_date?>">
													<small class="f-s-12 text-grey-darker">Here enter Drg Approval Date</small>
												</div>
											</div>
										 
										</div>
									</div>
						        </div>
						      </div>
						    </div>
						    <div class="card">
						      <div class="card-header text-center">
						        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
						       	Section II
						      </a>
						      </div>
						      <div id="collapseTwo" class="collapse" data-parent="#accordion">
						        <div class="card-body">
						        	<h4 class="text-center" style="color: lightblue">Section II</h4>
						        	<hr>
						        	<div class="row">
										<div class="col-md-6 col-lg-6">
										 	<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Inspection_call_date"> Inspection Call Date </label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Inspection Call Date" name="Inspection_call_date" id="Inspection_call_date" type="text"  value="<?=$data_received->Inspection_call_date?>">
													<small class="f-s-12 text-grey-darker">Here enter Inspection Call Date</small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Inspection_clearance_date"> Inspection Clearance Date </label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Inspection Clearance Date" name="Inspection_clearance_date" id="Inspection_clearance_date" type="text"  value="<?=$data_received->Inspection_clearance_date?>">
													<small class="f-s-12 text-grey-darker">Here enter Inspection Clearance Date</small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Dispatch_clearance_date">Dispatch Clearance Date </label>
												<div class="col-md-9">
													<input class="form-control m-b-5 datepickers" placeholder="Enter Dispatch Clearance Date" name="Dispatch_clearance_date" id="Dispatch_clearance_date" type="text" value="<?=$data_received->Dispatch_clearance_date?>">
													<small class="f-s-12 text-grey-darker">Here enter Dispatch Clearance Date</small>
												</div>
											</div>
	                                        
	                                        
										</div>
										<div class="col-md-6 col-lg-6">
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3">Inspection Call Remark  </label>
												<div class="col-md-9">
													<textarea class="form-control" rows="3" name="Inspection_call_remark" ><?=$data_received->Inspection_call_remark?></textarea>
													<small class="f-s-12 text-grey-darker"> Please enter Inspection Call Remark  </small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3">Inspection Clearance Remark  </label>
												<div class="col-md-9">
													<textarea class="form-control" rows="3" name="Inspection_clearance_remark" ><?=$data_received->Inspection_clearance_remark?></textarea>
													<small class="f-s-12 text-grey-darker"> Please enter Inspection Clearance Remark  </small>
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3">Dispatch Clearance Remark  </label>
												<div class="col-md-9">
													<textarea class="form-control" rows="3" name="Dispatch_clearance_remark" ><?=$data_received->Dispatch_clearance_remark?></textarea>
													<small class="f-s-12 text-grey-darker"> Please enter Dispatch Clearance Remark  </small>
												</div>
											</div>
										</div>
									</div>



						        </div>
						      </div>
						    </div>
						    <div class="card">
						      <div class="card-header text-center ">
						        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
						         Section III
						        </a>
						      </div>
						      <div id="collapseThree" class="collapse" data-parent="#accordion">
						        <div class="card-body">
						          	<h4 class="text-center" style="color: lightblue">Section III</h4>
						        	<hr>
						        		<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Qty_receipt_at_site">Qnty Receive At Site</label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Qnty Receive At Site" name="Qty_receipt_at_site" id="Qty_receipt_at_site" type="text" value="<?=$data_received->Qty_receipt_at_site?>">
														<small class="f-s-12 text-grey-darker">Here enter Qnty Receive At Site </small>
													</div>
												</div>
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Supply_completion">Supply Completion</label>
													<div class="col-md-9">
														<!-- <input class="form-control m-b-5" placeholder="Enter Activity name" name="activity_name" id="activity_name" type="text" required=""> -->
														<select name="Supply_completion" class="form-control m-b-5" id="Supply_completion">
															<option value="2" <?php if($data_received->Supply_completion=='2'){ echo "selected";}?>>No</option>
															<option value="1" <?php if($data_received->Supply_completion=='1'){ echo "selected";}?>>Yes</option>
														</select>
														<small class="f-s-12 text-grey-darker">Select Supply Completion</small>
													</div>
												</div>

											</div>
											<div class="col-md-6 col-lg-6">
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Qty_pending">Qnty Pending </label>
													<div class="col-md-9">
														<input class="form-control m-b-5 " placeholder="Enter Qnty Pending" name="Qty_pending" id="Qty_pending" type="text" value="<?=$data_received->Qty_pending?>">
														<small class="f-s-12 text-grey-darker">Here enter Qnty Pending</small>
													</div>
												</div>
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3">Remark Process </label>
													<div class="col-md-9">
														<textarea class="form-control" rows="3" name="Remark_process" ><?=$data_received->Remark_process?></textarea>
														<small class="f-s-12 text-grey-darker"> Please enter Remark Process  </small>
													</div>
												</div>
											</div>
										</div>

						        	
						        </div>
						      </div>
						    </div>
						    <div class="card">
						      <div class="card-header text-center">
						        <a class="collapsed card-link" data-toggle="collapse" href="#collapse4">
						           Section IV
						        </a>
						      </div>
						      <div id="collapse4" class="collapse" data-parent="#accordion">
						        <div class="card-body">
					         		<h4 class="text-center" style="color: lightblue">Section IV</h4>
					        		<hr>
					        		<div class="row">
											<div class="col-md-6 col-lg-6">
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="ACE_Basic">ACE (Basic Value)in Rs L</label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter ACE (Basic Value)" name="ACE_Basic" id="ACE_Basic" type="text" value="<?=$data_received->ACE_Basic?>">
														<small class="f-s-12 text-grey-darker">Here enter ACE (Basic Value) in Rs L</small>
													</div>
												</div>
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Order_value">Order Basic Value in Rs L</label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Order Basic Value" name="Order_value" id="Order_value" type="text" value="<?=$data_received->Order_value?>">
														<small class="f-s-12 text-grey-darker">Here enter Order Basic Value in Rs L</small>
													</div>
												</div>
												
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Invoice_value">Invoice Value Gross in RS l</label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Invoice Value Gross" name="Invoice_value" id="Invoice_value" type="text" value="<?=$data_received->Invoice_value?>">
														<small class="f-s-12 text-grey-darker">Here enter Invoice Value Gross in RS l</small>
													</div>
												</div>
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Cost_saving">Cost Saving</label>
													<div class="col-md-9">
														<input class="form-control m-b-5" placeholder="Enter Cost Saving" name="Cost_saving" id="Cost_saving" type="text" value="<?=$data_received->Cost_saving?>">
														<small class="f-s-12 text-grey-darker">Here enter Cost Saving</small>
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
                           
                           	 <button type="submit" class="btn btn-sm btn-info m-r-5" name="send_button" value="send">Send</button>
                            <a  href="<?=base_url()?>user-design-home" class="btn btn-sm btn-danger">Cancel</a> 
                        </div>
                    </div>
				</form>
					
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->