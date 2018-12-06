<?php 

$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
	$value1=$Slno_vendor;
	$value2=$token;
	$keys_id="preetishwebvendors";
	$value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
	$value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
if($value1_convered_id==$value2){
	$data = array('Slno_vendor' =>$value1_convered_id);
	$table='master_vendor_detail';
	$query=$this->db->get_where($table,$data);
	$data_db=$query->result(); // here fetch information 
	$row = $data_db[0]; 
}else{
	$this->session->set_flashdata('error_message', 'Some thing went Wrong');
    // After that you need to used redirect function instead of load view such as                 
    redirect('user-admin-home');
}
// `Slno_vendor`, `Vendor_name`, `Vendor_email_id`, `Mobile_no`, `Organisation_name`, `Password`, `Password_hash`, `Status`, `Date_entry`, `Time_entry`, `Vendor_desc`, `Organisation_address`
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
				<li class="breadcrumb-item"><a href="javascript:;">Vendors</a></li>
				<li class="breadcrumb-item"><a href="<?=base_url()?>admin-view-vendors">View Vendors Lsit</a></li>
				<li class="breadcrumb-item"><a href="<?=base_url()?>admin-view-vendor-info/<?=$value1.'/'.$value2?>">View Vendors Details</a></li>
				<li class="breadcrumb-item active">Adding New Operation Details </li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Vendor Name :-<?=$row->Vendor_name?> And Organisation :- <?=$row->Organisation_name?></h1>
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
					<h4 class="panel-title">Add New Operation To Vendor Name:--<?=$row->Vendor_name?> </h4>
				</div>
				<div class="panel-body">
					<?php
						$this->db->select('*');
						$this->db->from('Vendor_operation_detail');
						$this->db->join('master_category', ' (master_category.Slno_cat = Vendor_operation_detail.Operation_slno AND Vendor_operation_detail.Slno_id_Vendor_slno='.$value1_convered_id.' ) ', 'right outer' );
						// $this->db->join('city', 'city.user_id = users.id','left');
						// $this->db->where('Vendor_operation_detail.Slno_id_Vendor_slno', $value1_convered_id); 
						$query_operation = $this->db->get();
						
					?>
					<form action="<?=base_url()?>admin-vendor-new-operation"   id="project_code_form" method="POST" >
						<input type="hidden" name="value1" value="<?=$value1?>">
						<input type="hidden" name="value2" value="<?=$value2?>">

					<div class="text-center col-md-12">
						<div class="col-md-12">											
							<table class="table">
								<thead>
									<tr>
										<tr>
											<th>Check</th>
											<th>Category Name</th>
											<th>Details</th>
										</tr>
									</tr>
								</thead>
								<tbody>
									<?php 
									foreach ($query_operation->result() as $key_operation) {
										if(empty($key_operation->Slno_Vendor_operation)){
											echo <<<EOL
													<tr>
														<td><input type="checkbox" checked class="form-check-input" name="vendor_operational[]" value="$key_operation->Slno_cat"></td>
														<td>$key_operation->category_name[$key_operation->short_code]</td>
														<td>$key_operation->category_desc</td>
													</tr>
										
EOL;
														
										}
									}
														?>
								</tbody>
							</table>									
						</div>
					</div>
					<div class="form-group row pull-right">
                        <div class="col-md-12">
                            <button type="submit"  class="btn btn-sm btn-primary m-r-5">Save</button>
                            <a  href="<?=base_url()?>admin-view-vendor-info/<?=$value1.'/'.$value2?>" class="btn btn-sm btn-success">Back</a>
                            <a  href="<?=base_url()?>user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                        </div>
                    </div>
				</form>
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->