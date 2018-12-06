<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
	 $value1=$project_slno;
	 
	 $value2=$token;
	 
	 $user_type=$user_type;
	 
	 $job_Code=$job_Code;
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
 switch ($user_type) {                 
    case '2':
        $user ="Design";
        break;
    case '3':
         $user ="Project";
        break;
    case '4':
         $user ="Procurement";
        break;
    case '5':
         $user ="Report";
        break;
    case '6':
        $user="Bu";
        break;
    case '7':
        $user="Buyer";
        break;
    default:
        $this->session->set_flashdata('error_message', 'Some thing went Wrong');
        // After that you need to used redirect function instead of load view such as                 
        redirect('user-admin-home');
        break;
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
				<li class="breadcrumb-item"><a href="<?=base_url()?>admin-view-project">View Project Lsit</a></li>
				<li class="breadcrumb-item"><a href="<?=base_url()?>admin-project-view-details/<?=$value1.'/'.$value2?>">View Project Details</a></li>
				<li class="breadcrumb-item active">Assign <?=$user?> User To Job Code </li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Assign <?=$user?> User To Job Code  <?=$job_Code?> </h1>
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
						
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Assign <?=$user?> User To Job Code  <?=$job_Code?> </h4>
				</div>
				<div class="panel-body">
					<?php
						$this->db->select('*');
						$this->db->from('assign_project_user');
						$this->db->join('master_admin', ' (assign_project_user.user_slno = master_admin.slno AND assign_project_user.project_slno='.$value1_convered_id.' ) ', 'right outer' );
						// $this->db->join('city', 'city.user_id = users.id','left');
						$this->db->where('master_admin.role_id', $user_type); 
						$query_bu = $this->db->get();
						
					?>
					<form action="<?=base_url()?>admin-add-assign-userto_project"   id="project_code_form" method="POST" >
						<input type="hidden" name="value1" value="<?=$value1?>">
						<input type="hidden" name="value2" value="<?=$value2?>">
						<input type="hidden" name="user_type" value="<?=$user_type?>">
						<input type="hidden" name="job_Code" value="<?=$job_Code?>">
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
					<div class="text-center col-md-12">
						<div class="col-md-12">											
							<table class="table">
								<thead>
									<tr>
										<th>Check</th>
										<th><?=$user?> User Name</th>
									</tr>
								</thead>
								<tbody>
									<?php 									
										foreach ($query_bu->result() as $key_design) {
											if(empty($key_design->slno_assign_project)){
											echo <<<EOL
													<tr>
														<td><input type="checkbox" checked class="form-check-input" name="design_user[]" value="$key_design->slno"></td>
														<td>$key_design->Username</td>
													</tr>
EOL;
												}
												}?>
								</tbody>
							</table>									
						</div>
					</div>
					<div class="form-group row pull-right">
                        <div class="col-md-12">
                            <button type="submit"  class="btn btn-sm btn-primary m-r-5">Save</button>
                            <a  href="<?=base_url()?>admin-project-view-details/<?=$value1.'/'.$value2?>" class="btn btn-sm btn-success">Back</a>
                            <a  href="<?=base_url()?>user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                        </div>
                    </div>
				</form>
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->