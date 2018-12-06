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
				<li class="breadcrumb-item active"><a href="user-admin-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Vendor List</a></li>
				<li class="breadcrumb-item active">Create new vendor</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create New Vendor  </h1>
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
					<h4 class="panel-title">Add New Vendor Information</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-secondary">
                        <span style="color: red"> *</span> All mandory fields shall be duly filled up 
                    </div>
					<form action="admin-add-vendors-save" method="POST" >
						<div class="row">
							<div class="col-md-6 col-lg-6">

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Vendor_name">Vendor Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Vendor name" name="Vendor_name" id="Vendor_name" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter Vendor name</small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Vendor_email_id">Vendor email <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Vendor email" name="Vendor_email_id" id="Vendor_email_id" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter Vendor email</small>
									</div>
								</div>
                                <div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Organisation_name">Organisation Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Organisation name" name="Organisation_name" id="Vendor_email_id" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter organisation name</small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Organisation Address <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="Organisation_address" required=""></textarea>
										<small class="f-s-12 text-grey-darker"> Please enter Organisation address </small>
									</div>
								</div>

								
								
							</div>
							<div class="col-md-6 col-lg-6">

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Mobile_no">Vendor contact <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Vendor contact" name="Mobile_no" id="Mobile_no" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter Vendor contact</small>
									</div>
								</div>
							 	
							 	

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Password">Password<span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Password" name="Password" id="Password" type="Password" required="">
										<small class="f-s-12 text-grey-darker">Here enter Password</small>
									</div>
								</div>
		
							
			

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Vendor_desc">Details<span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control m-b-5"  name="Vendor_desc" id="Vendor_desc" type="text" required="" rows="8"></textarea>
										<small class="f-s-12 text-grey-darker">Here enter Details</small>
									</div>
								</div>
							</div>
						</div>			
						<div class="row">
							<div class="text-center col-md-12" >
								<label class="col-form-label">Vendor Operation <span style="color: red">*</span></label><br>
								<small class="f-s-12 text-grey-darker">  Operation details  </small>	
							</div>
							<div class="text-center col-md-12">
								<div class="col-md-12">											
									<table class="table">
										<thead>
											<tr>
												<th>Check</th>
												<th>Category Name</th>
												<th>Details</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$table='master_category';
												$data_bu= array('status' =>1 );
												$query_bu=$this->db->get_where($table,$data_bu);
												foreach ($query_bu->result() as $key_bu) {
											echo <<<EOL
													<tr>
														<td><input type="checkbox" checked class="form-check-input" name="vendor_operational[]" value="$key_bu->Slno_cat"></td>
														<td>$key_bu->category_name[$key_bu->short_code]</td>
														<td>$key_bu->category_desc</td>
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
	function get_id_category() {
		var category_name=$('#category_name').val();	
		if(category_name!=""){
			$('#category_id').val(category_name);
		}else{
			$('#category_id').val('');
		}
	}
</script>
			
				
