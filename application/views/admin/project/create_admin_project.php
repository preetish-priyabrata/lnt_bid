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
				<li class="breadcrumb-item active"><a href="<?=base_url()?>user-admin-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Project</a></li>
				<li class="breadcrumb-item active">Create News Project</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create Project form </h1>
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
					<h4 class="panel-title">Add New Project Information</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                        	</div>
					<form action="admin-add-project-save"  onsubmit="return check_before_submiting()" id="project_code_form" method="POST" >
						<div class="row">
							<div class="col-md-6 col-lg-6">
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="user_name">Project Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Project name" name="Project_name" id="Project_name" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter project name</small>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3"> Job code <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" onkeyup="check_job_code()" placeholder="Enter job code" name="job_code" id="job_code"  type="text"   required=""   >	
										<span id="job_code_error"></span><br>									
										<small class="f-s-12 text-grey-darker">Job Code Should be Unique</small>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Date Of Start <span style="color: red">*</span></label>
									<div class="col-md-9">						
										<input type="text" class="form-control m-b-5" required="" name="datepicker" placeholder="" id="datepicker">
              							
										<small class="f-s-12 text-grey-darker">Select Date Please</small>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Customer Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Customer Name" name="Customer_name" type="text" required="">
										<small class="f-s-12 text-grey-darker">Customer Name </small>
									</div>
								</div>
								<!-- <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Customer Mobile No <span style="color: red">*</span></label>
									<div class="col-md-9"> -->
										<input class="form-control m-b-5" placeholder="Enter Customer Mobile No" name="Customer_Mobile_No" type="hidden" value="12345667890" required="">
									<!-- 	<small class="f-s-12 text-grey-darker">Please Enter Customer Mobile No </small>
									</div>
								</div> -->
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Project Description  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="Project_Description" required=""></textarea>
										<small class="f-s-12 text-grey-darker"> Please enter project description  </small>
									</div>
								</div>
							</div>
						</div>
						<br>
						<br>
						<div class="row">
							<div class="text-center col-md-12" >
								<label class="col-form-label">BU user Assign To <span style="color: red">*</span></label><br>
								<small class="f-s-12 text-grey-darker"> Please Assign Bu User for modifying  some content   </small>	
							</div>
							<div class="text-center col-md-12">
								<div class="col-md-12">
											
									<table class="table">
										<thead>
											<tr>
												<th>Check</th>
												<th>BU User Name</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$table='master_admin';
												$data_bu= array('role_id' =>6 ,'Status'=>1 );
												$query_bu=$this->db->get_where($table,$data_bu);
												foreach ($query_bu->result() as $key_bu) {
													echo <<<EOL
															<tr>
																<td><input type="checkbox" checked class="form-check-input" name="bu_user[]" value="$key_bu->slno"></td>
																<td>$key_bu->Username</td>
															</tr>
EOL;
														}?>
										</tbody>
									</table>


									
								</div>
							</div>
							
						</div>
						<br>
						<div class="row">
							<div class="text-center col-md-12" >
								<label class="col-form-label">Design user Assign To <span style="color: red">*</span></label><br>
								<small class="f-s-12 text-grey-darker"> Please Assign Design User for modifying  some content   </small>	
							</div>
							<div class="text-center col-md-12">
								<div class="col-md-12">
											
									<table class="table">
										<thead>
											<tr>
												<th>Check</th>
												<th>Design User Name</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$table='master_admin';
												$data_design= array('role_id' =>2 ,'Status'=>1 );
												$query_design=$this->db->get_where($table,$data_design);
												foreach ($query_design->result() as $key_design) {
													echo <<<EOL
															<tr>
																<td><input type="checkbox" checked class="form-check-input" name="design_user[]" value="$key_design->slno"></td>
																<td>$key_design->Username</td>
															</tr>
EOL;
														}?>
										</tbody>
									</table>


									
								</div>
							</div>
							
						</div>
						<br>
						<div class="row">
							<div class="text-center col-md-12" >
								<label class="col-form-label">Project user Assign To <span style="color: red">*</span></label><br>
								<small class="f-s-12 text-grey-darker"> Please Assign Project User for modifying  some content   </small>	
							</div>
							<div class="text-center col-md-12">
								<div class="col-md-12">
											
									<table class="table">
										<thead>
											<tr>
												<th>Check</th>
												<th>Project User Name</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$table='master_admin';
												$data_design= array('role_id' =>3 ,'Status'=>1 );
												$query_design=$this->db->get_where($table,$data_design);
												foreach ($query_design->result() as $key_design) {
													echo <<<EOL
															<tr>
																<td><input type="checkbox" checked class="form-check-input" name="project_user[]" value="$key_design->slno"></td>
																<td>$key_design->Username</td>
															</tr>
EOL;
														}?>
										</tbody>
									</table>


									
								</div>
							</div>
							
						</div>
						<br>
						<div class="row">
							<div class="text-center col-md-12" >
								<label class="col-form-label">Procurement user Assign To <span style="color: red">*</span></label><br>
								<small class="f-s-12 text-grey-darker"> Please Assign Procurement User for modifying  some content   </small>	
							</div>
							<div class="text-center col-md-12">
								<div class="col-md-12">
											
									<table class="table">
										<thead>
											<tr>
												<th>Check</th>
												<th>Procurement User Name</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$table='master_admin';
												$data_design= array('role_id' =>4 ,'Status'=>1 );
												$query_design=$this->db->get_where($table,$data_design);
												foreach ($query_design->result() as $key_design) {
													echo <<<EOL
															<tr>
																<td><input type="checkbox" checked class="form-check-input" name="procurement_user[]" value="$key_design->slno"></td>
																<td>$key_design->Username</td>
															</tr>
EOL;
														}?>
										</tbody>
									</table>


									
								</div>
							</div>
							
						</div>
						<br>
						<div class="row">
							<div class="text-center col-md-12" >
								<label class="col-form-label">Buyer user Assign To <span style="color: red">*</span></label><br>
								<small class="f-s-12 text-grey-darker"> Please Assign Buyer User for modifying  some content   </small>	
							</div>
							<div class="text-center col-md-12">
								<div class="col-md-12">
											
									<table class="table">
										<thead>
											<tr>
												<th>Check</th>
												<th>Buyer User Name</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$table='master_admin';
												$data_design= array('role_id' =>7 ,'Status'=>1 );
												$query_design=$this->db->get_where($table,$data_design);
												foreach ($query_design->result() as $key_design) {
													echo <<<EOL
															<tr>
																<td><input type="checkbox" checked class="form-check-input" name="buyers_user[]" value="$key_design->slno"></td>
																<td>$key_design->Username</td>
															</tr>
EOL;
														}?>
										</tbody>
									</table>


									
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
				
				function check_job_code() {
					
					var job_code=document.getElementById('job_code').value;
					var pass1 = document.getElementById('job_code');
					var message = document.getElementById('job_code_error');
					
   					var goodColor = "#0C6";
    				var badColor = "#FF9B37";    				
					var results=0;
					if(job_code!=""){
						
					  	$.ajax({
						  	url:'get-check-job-code-information',
						    method: 'post',
						    data: {field_id:'1',job_codes:job_code},
						    dataType: 'json',
						    success: function(response){	
						    	if(response.status==1){
									pass1.style.backgroundColor = goodColor;
							        message.style.color = goodColor;
							        message.innerHTML = "valid Job code";
							        results=1;
							        return true;
							        
								}else if(response.status==2){
									pass1.style.backgroundColor = badColor;
							        message.style.color = badColor;
							        message.innerHTML = "invalid Job code";
							        results=2;
							        $('#job_code').val('');
							         return false;
							         
							         
								}
							}
						});
						// alert(results);
					  	if(results==1){
					  		return true;
					  	}else{
					  		return false;
					  	}
					}else{
						pass1.style.backgroundColor = badColor;
						message.style.color = badColor;
						message.innerHTML = "Should not left blank";
						 return false;
					}
				}
			function check_before_submiting(){
					var job_code=document.getElementById('job_code').value;
					var pass1 = document.getElementById('job_code');
					var message = document.getElementById('job_code_error');
					
   					var goodColor = "#0C6";
    				var badColor = "#FF9B37";    				
					var results=0;
					if(job_code!=""){
						
					  	$.ajax({
						  	url:'get-check-job-code-information',
						    method: 'post',
						    data: {field_id:'1',job_codes:job_code},
						    dataType: 'json',
						    success: function(response){	
						    	if(response.status==1){
									pass1.style.backgroundColor = goodColor;
							        message.style.color = goodColor;
							        message.innerHTML = "valid Job code";
							       document.getElementById("project_code_form").submit(); //form submission
							        
								}else if(response.status==2){
									pass1.style.backgroundColor = badColor;
							        message.style.color = badColor;
							        message.innerHTML = "invalid Job code";
							        results=2;
							        $('#job_code').val('');
							         return false;
							         
							         
								}
							}
						});
						// alert(results);
					  	if(results==1){
					  		return true;
					  	}else{
					  		return false;
					  	}
					}else{
						pass1.style.backgroundColor = badColor;
						message.style.color = badColor;
						message.innerHTML = "Should not left blank";
						 return false;
					}
			}
			</script>
			
				
