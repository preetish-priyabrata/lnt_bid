<?php 
$email_id=$this->session->userdata('bu_email_id');
if(empty($email_id)){
	
	redirect('bu-logout-by-pass');
}
	$this->db->select('*');
	$this->db->from('master_project');
	$this->db->join('assign_project_user', ' (assign_project_user.project_slno = master_project.Project_Slno AND master_project.bu_status=0 AND master_project.status=1 ) ', 'right outer' );
						// $this->db->join('city', 'city.user_id = users.id','left');
	$this->db->where('assign_project_user.email_id', $email_id); 
	$this->db->where('master_project.bu_status', 0); 
	$query_bu = $this->db->get();
?>
<link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="user-bu" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Order Book</a></li>
				<li class="breadcrumb-item active">Create New Order Book</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create New Order Book  </h1>
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
					<h4 class="panel-title">Add New Order Book Information</h4>
				</div>
				<div class="panel-body">
					
					<div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                        	</div>
					<form action="bu-add-new-order-book-save" method="POST" >
						<div class="row">
							<div class="col-md-6 col-lg-6">
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="job_code">Job Code <span style="color: red">*</span></label>
									<div class="col-md-9">
										<!-- <input class="form-control m-b-5" placeholder="Enter Activity name" name="activity_name" id="activity_name" type="text" required=""> -->
										<select name="job_code" onchange="get_project_details()"  class="form-control m-b-5" id="job_code">
											<option value="">--Select Job Code--</option>
											<?php
												foreach ($query_bu->result() as $key_job_code) {
													echo "<option value='".$key_job_code->Project_Slno."'>".$key_job_code->job_Code." [ ".$key_job_code->Project_Name." ]</option>";
												}
											?>
										</select>
										<small class="f-s-12 text-grey-darker">Select Job Code</small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="activity_name">LOI date(Contract) <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5 datepickers" placeholder="Enter LOI date" name="LOI_date_contract" id="LOI_date_contract" type="text" required="">
										<small class="f-s-12 text-grey-darker">Please enter LOI date</small>
									</div>
								</div>
								
                                <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="activity_name">Contract value<span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5 " placeholder="Enter Contract value" name="Contract_value" id="Contract_value" type="text" required="">
										<small class="f-s-12 text-grey-darker">Please enter Contract value</small>
									</div>
								</div>
                                <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="activity_name">Contract start date<span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5 datepickers" placeholder="Enter Contract start date" name="Contract_start_date" id="Contract_start_date" type="text" required="">
										<small class="f-s-12 text-grey-darker">Please enter Contract start date</small>
									</div>
								</div>
                                <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="activity_name">Contract duration<span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5 " placeholder="Enter Contract duration" name="Contract_duration" id="Contract_duration" type="text" required="">
										<small class="f-s-12 text-grey-darker">Please enter Contract duration</small>
									</div>
								</div>

                                 <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Remarks <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="Remarks" required=""> </textarea>
										<small class="f-s-12 text-grey-darker"> Please enter remarks </small>
									</div>
								</div> 


							</div>
							
							<div class="col-md-6 col-lg-6">

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Project description  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="Project_desc" id="Project_desc" required=""></textarea>
										<small class="f-s-12 text-grey-darker">Please enter Project decription  </small>
									</div>
								</div>
							
                          
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Contract signing date  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5 datepickers" placeholder="Enter Contract signing date" name="Contract_sign_date" id="Contract_sign_date" type="text" required="">
										
										<small class="f-s-12 text-grey-darker"> Please enter Contract signing date </small>
									</div>
								</div>

                                <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Supply order value  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5 " placeholder="Enter Supply order value" name="Supply_order_value" id="Supply_order_value" type="text" required="">
										
										<small class="f-s-12 text-grey-darker"> Please enter Supply order value </small>
									</div>
								</div>
                                <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Contractual completion <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5 datepickers" placeholder="Enter Contratual completion" name="Contratual_completion" id="Contratual_completion" type="text" required="">
										
										<small class="f-s-12 text-grey-darker"> Please enter Contratual completion </small>
									</div>
								</div>
                                








							</div>
                 







						 <div>
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
                                 <a  href="<?=base_url()?>bu-view-order-book" class="btn btn-sm btn-default">Back</a> 
                                <a  href="<?=base_url()?>user-bu" class="btn btn-sm btn-danger">Cancel</a> 
                            </div>
                        </div>
						
						
					</form>
					
				</div>
			</div>
<script type="text/javascript">
	function get_project_details(){
		var job_code=$('#job_code').val();
		// alert(job_code);
		if(job_code!=""){

			$.ajax({
			  	url:'bu-job-code-desc',
			    method: 'post',
			    data: {field_id:'1',job_codes:job_code},
			    dataType: 'json',
			    success: function(response){
			    	$('input[name="Project_desc"]').empty();
			    	
			    	console.log(response.id_desc);
			    	$('#Project_desc').val(response.id_desc);
			    	
			   
				}
			});
		}else{
			$('#Project_desc').val(' ');
		}
	}
</script>
				
