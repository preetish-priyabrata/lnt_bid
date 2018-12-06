<?php 
$Vendor_email_id=$this->session->userdata('Vendor_email_id');
if(empty($Vendor_email_id)){
	
	redirect('vendor-logout-pass');
}
$value=$value;
$result_title=$this->vendor_db_users->vendor_new_query_tech_title($value,$Vendor_email_id);
if($result_title['no_new_tech']!=1){
	$this->session->set_flashdata('error_message', 'Unable find Bid');
	redirect('user-vendor-home');
}
?>
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<!-- <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
				<li class="breadcrumb-item active">Page with Top Menu</li> -->
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Technical Bid View Details<small></small></h1>
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
			  //print_r($result_title);
			 ?>
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">View Details of Technical Bid</h4>
				</div>
				<div class="panel-body">
					<form  action="/action_page.php">
	            
							<div class="panel-body">
					
                    <form action="<?=base_url()?>bu-create-tracking-save" method="POST">					
						
						     
						         	<div class="row">
										<div class="col-md-6 col-lg-6">
										 	<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Date_creation"> Bid Ref <span style="color: red"></span></label>
												<div class="col-md-9">
													<?=$result_title['new_tech_list'][0]->bid_ref?>
													
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Po_no">Start Date <span style="color: red"></span></label>
												<div class="col-md-9">
													<?=$result_title['new_tech_list'][0]->date_start?>
													
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Bg_submission_date">Title </label>
												<div class="col-md-9"><?=$result_title['new_tech_list'][0]->title?>
													
												</div>
											</div>
	                                        
	                                        <div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Mfg_clear_date">Description <span style="color: red"></span></label>
												<div class="col-md-9">
													<?=$result_title['new_tech_list'][0]->description?>
													
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6">
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Job_code"> Bid Id<span style="color: red"></span></label>
												<div class="col-md-9">
													<?=$result_title['new_tech_list'][0]->bid_id?>
													
													
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Po_date"> End Date <span style="color: red"></span></label>
												<div class="col-md-9">
													<?=$result_title['new_tech_list'][0]->date_end?>
													
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Advance_payment_date">Date of Query </label>
												<div class="col-md-9">
													<?=$result_title['new_tech_list'][0]->date_end?>
													
												</div>
											</div>
											<div class="form-group row m-b-15">
												<label class="col-form-label col-md-3" for="Advance_payment_date"> Type of Bid </label>
												<div class="col-md-9">
													<?=$result_title['new_tech_list'][0]->mode_bid?>
													
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
						       	Part I
						      </a>
						      </div>
						      <div id="collapseTwo" class="collapse" data-parent="#accordion">
						        <div class="card-body">
						        	<h4 class="text-center" style="color: lightblue">Part I</h4>
						        	<hr>
						        	<div class="panel-body">

						              <div class="table-responsive-sm">
								       <table id="example" class="display" style="width:100%">
									    <thead>
										 <tr>
											 <th>Slno .</th>
											 <th>File Name</th>
											 <th>File Details</th>
											 
										 </tr>
								        </thead>
								 <tbody>

								 </tbody>
							
							</table>
							
						</div>
					</div>	



						        </div>
						      </div>
						    </div>
						    <div class="card">
						      <div class="card-header text-center ">
						        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
						         Part II
						        </a>
						      </div>
						      <div id="collapseThree" class="collapse" data-parent="#accordion">
						        <div class="card-body">
						          	<h4 class="text-center" style="color: lightblue">Part II</h4>
						        	<hr>
						        	
                             <div class="panel-body">

						              <div class="table-responsive-sm">
								       <table id="example" class="display" style="width:100%">
									    <thead>
										 <tr>
											 <th>Slno .</th>
											 <th>Item Name</th>
											 <th>Technical Parameter</th>
											 
										 </tr>
								        </thead>
								 <tbody>

								 </tbody>
							
							</table>
							
						</div>
					</div>	
										
									</div>




						        	
						        </div>
						      </div>
						    </div>
						    
						</div>				
					
				  	<div class="form-group row pull-right">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary m-r-5" name="send_button" value="save">Query</button>
                           	 <button type="submit" class="btn btn-sm btn-info m-r-5" name="send_button" value="send">Submitted Technical</button>
                            <a  href="<?=base_url()?>user-design-home" class="btn btn-sm btn-danger">Back</a> 
                        </div>
                    </div>
				</form>
					
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->
			<!-- end panel -->
		</div>
		<!-- end #content -->