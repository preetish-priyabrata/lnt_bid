<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
	$value1=$project_slno;
	$value2=$token;
	$keys_id="preetishwebproject";
	$value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
	$value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
if($value1_convered_id==$value2){
	$data = array('Project_Slno' =>$value1_convered_id);
	$table='master_project';
	$query=$this->db->get_where($table,$data);
	$data_db=$query->result(); // here fetch information 
	$row = $data_db[0]; 
}else{
	$this->session->set_flashdata('error_message', 'Some thing went Wrong');
    // After that you need to used redirect function instead of load view such as                 
    redirect('user-admin-home');
}
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
				<li class="breadcrumb-item"><a href="javascript:;">Project</a></li>
				<li class="breadcrumb-item"><a href="<?=base_url()?>admin-view-project-closed">View Closed Project Lsit</a></li>
				<li class="breadcrumb-item active">View Closed Project Details</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">View project information</h1>
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
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Project Information Details</h4>
				</div>
				<div class="panel-body">
					<div class="col-lg-12">
						<!-- begin nav-tabs -->						
					  	<ul class="nav nav-tabs" role="tablist">
					    	<li class="nav-item">
					    		<a class="nav-link active" data-toggle="tab" href="#home">Project details</a>
						    </li>
						    <li class="nav-item">
						    	<a class="nav-link" data-toggle="tab" href="#menu1">Bu User</a>
						    </li>
						    <li class="nav-item">
						    	<a class="nav-link" data-toggle="tab" href="#menu2">Design User</a>
						    </li>
						    <li class="nav-item">
						    	<a class="nav-link" data-toggle="tab" href="#menu3">Project User</a>
						    </li>
						    <li class="nav-item">
						    	<a class="nav-link" data-toggle="tab" href="#menu4">Procurement User</a>
						    </li>
						    <li class="nav-item">
						    	<a class="nav-link" data-toggle="tab" href="#menu5">Buyer User</a>
						    </li>
						 </ul>

					  	<!-- Tab panes -->
					  	<div class="tab-content">
						    <div id="home" class="container tab-pane active"><br>
						    	<h3>Project details </h3>
						    	<br>
						    	
						      	<div class="row">
									<div class="col-md-6 col-lg-6">
									 	<div class="form-group row m-b-15">
											<label class="col-form-label col-md-3" for="user_name">Project Name </label>
											<div class="col-md-9">
												<input class="form-control m-b-5" value="<?=$row->Project_Name?>" disabled="" type="text" >
												
											</div>
										</div>
										<div class="form-group row m-b-15">
											<label class="col-form-label col-md-3"> Job code </label>
											<div class="col-md-9">
												<input class="form-control m-b-5" value="<?=$row->job_Code?>" disabled="" type="text" >	
												
											</div>
										</div>
										<div class="form-group row m-b-15">
											<label class="col-form-label col-md-3">Date Of Start </label>
											<div class="col-md-9">						
												<input type="text" class="form-control m-b-5" value="<?=$row->Date_Start?>" disabled="">
		              							
											
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-6">
									 	<div class="form-group row m-b-15">
											<label class="col-form-label col-md-3">Customer Name </label>
											<div class="col-md-9">
												<input class="form-control m-b-5" value="<?=$row->Customer_Name?>" disabled="" type="text">
												
											</div>
										</div>
										<!-- <div class="form-group row m-b-15">
											<label class="col-form-label col-md-3">Customer Mobile No </label>
											<div class="col-md-9">
												<input class="form-control m-b-5" value="<?=$row->Customer_Mobile_No?>" disabled="" type="text" >
												
											</div>
										</div> -->
										<div class="form-group row m-b-15">
											<label class="col-form-label col-md-3">Project Description  </label>
											<div class="col-md-9">
												<textarea class="form-control" rows="3" disabled=""><?=$row->project_Description?></textarea>
												
											</div>
										</div>
									</div>
								</div>
						    </div>
						    <div id="menu1" class="container tab-pane fade"><br>
						      <h3>Bu users list  </h3>
						      <?php 
						      	$this->db->select('*');
								$this->db->from('master_admin');
								$this->db->join('assign_project_user', ' (assign_project_user.user_slno = master_admin.slno AND assign_project_user.role_id=6 ) ' );
								// $this->db->join('city', 'city.user_id = users.id','left');
								$this->db->where('assign_project_user.project_slno', $value1_convered_id); 
								$query_bu = $this->db->get();
								
								?>
						      	<table class="table table-bordered">
								    <thead>
										<tr>
											<th>User Name</th>
											<th>Email id</th>
											<th>Mobile id </th>
											
										</tr>
								    </thead>
								    <tbody id="myTable">
								    	<?php 
								    	foreach ($query_bu->result() as $key_bu_user){?>
								    	
								      	<tr>
											<td><?=$key_bu_user->Username?></td>
											<td><?=$key_bu_user->email_id?></td>
											<td><?=$key_bu_user->user_mobile?></td>
											<
										</tr>
										<?php }?>
								    </tbody>
 								</table>
						    </div>
						    <div id="menu2" class="container tab-pane fade"><br>
						    	  <h3>Design users lis</h3>
						      <?php 
						      	$this->db->select('*');
								$this->db->from('master_admin');
								$this->db->join('assign_project_user', ' (assign_project_user.user_slno = master_admin.slno AND assign_project_user.role_id=2 ) ' );
								// $this->db->join('city', 'city.user_id = users.id','left');
								$this->db->where('assign_project_user.project_slno', $value1_convered_id); 
								$query_design = $this->db->get();
								
								?>
						      	<table class="table table-bordered">
								    <thead>
										<tr>
											<th>User Name</th>
											<th>Email id</th>
											<th>Mobile id </th>
											
										</tr>
								    </thead>
								    <tbody id="myTable">
								    	<?php 
								    	foreach ($query_design->result() as $key_design_user){?>
								    	
								      	<tr>
											<td><?=$key_design_user->Username?></td>
											<td><?=$key_design_user->email_id?></td>
											<td><?=$key_design_user->user_mobile?></td>
											<
										</tr>
										<?php }?>
								    </tbody>
 								</table>
						    </div>
						    <div id="menu3" class="container tab-pane fade"><br>
						     	  <h3>Project users list  </h3>
						      <?php 
						      	$this->db->select('*');
								$this->db->from('master_admin');
								$this->db->join('assign_project_user', ' (assign_project_user.user_slno = master_admin.slno AND assign_project_user.role_id=3 ) ' );
								// $this->db->join('city', 'city.user_id = users.id','left');
								$this->db->where('assign_project_user.project_slno', $value1_convered_id); 
								$query_project = $this->db->get();
								
								?>
						      	<table class="table table-bordered">
								    <thead>
										<tr>
											<th>User Name</th>
											<th>Email id</th>
											<th>Mobile id </th>
											<td>Action</td>
										</tr>
								    </thead>
								    <tbody id="myTable">
								    	<?php 
								    	foreach ($query_project->result() as $key_project_user){?>
								    	
								      	<tr>
											<td><?=$key_project_user->Username?></td>
											<td><?=$key_project_user->email_id?></td>
											<td><?=$key_project_user->user_mobile?></td>
											
										</tr>
										<?php }?>
								    </tbody>
 								</table>
						    </div>
						    <div id="menu4" class="container tab-pane fade"><br>
						     	  <h3>Procurement users list  </h3>
						      <?php 
						      	$this->db->select('*');
								$this->db->from('master_admin');
								$this->db->join('assign_project_user', ' (assign_project_user.user_slno = master_admin.slno AND assign_project_user.role_id=4 ) ' );
								// $this->db->join('city', 'city.user_id = users.id','left');
								$this->db->where('assign_project_user.project_slno', $value1_convered_id); 
								$query_procurement = $this->db->get();
								
								?>
						      	<table class="table table-bordered">
								    <thead>
										<tr>
											<th>User Name</th>
											<th>Email id</th>
											<th>Mobile id </th>
											
										</tr>
								    </thead>
								    <tbody id="myTable">
								    	<?php 
								    	foreach ($query_procurement->result() as $key_procurement_user){?>
								    	
								      	<tr>
											<td><?=$key_procurement_user->Username?></td>
											<td><?=$key_procurement_user->email_id?></td>
											<td><?=$key_procurement_user->user_mobile?></td>
											
										</tr>
										<?php }?>
								    </tbody>
 								</table>
						    </div>
						    <div id="menu5" class="container tab-pane fade"><br>
						      	  <h3>Buyer users list </h3>
						      <?php 
						      	$this->db->select('*');
								$this->db->from('master_admin');
								$this->db->join('assign_project_user', ' (assign_project_user.user_slno = master_admin.slno AND assign_project_user.role_id=7 ) ' );
								// $this->db->join('city', 'city.user_id = users.id','left');
								$this->db->where('assign_project_user.project_slno', $value1_convered_id); 
								$query_buyer = $this->db->get();
								 // echo  $this->db->last_query();
								
								?>
						      	<table class="table table-bordered">
								    <thead>
										<tr>
											<th>User Name</th>
											<th>Email id</th>
											<th>Mobile id </th>
											
										</tr>
								    </thead>
								    <tbody id="myTable">
								    	<?php 
								    	foreach ($query_buyer->result() as $key_buyer_user){?>
								    	
								      	<tr>
											<td><?=$key_buyer_user->Username?></td>
											<td><?=$key_buyer_user->email_id?></td>
											<td><?=$key_buyer_user->user_mobile?></td>
											
										</tr>
										<?php }?>
								    </tbody>
 								</table>
						    </div>
						    <a  href="<?=base_url()?>admin-view-project-closed" class="btn btn-grey pull-right">Back</a>
					  </div>


					</div>
				</div>
			</div>
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

		