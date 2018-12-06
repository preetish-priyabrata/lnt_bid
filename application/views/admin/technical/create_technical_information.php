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
				<li class="breadcrumb-item"><a href="javascript:;">Technical</a></li>
				<li class="breadcrumb-item active">Create Technical Details</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create Technical Details Information </h1>
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
					<h4 class="panel-title">Add New Technical Information</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                        	</div>
					<form action="admin-add-technical-save" method="POST" >
						<div class="row">
							<div class="col-md-6 col-lg-6">

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Technical_name">Technical Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Technical name" name="Technical_name" id="Technical_name" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter Technical name</small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="category_name">Category  Name<span style="color: red">*</span></label>
									<div class="col-md-9">
										<select  class="form-control m-b-5" onchange="get_material_info()" name="category_name" id="category_name" required="">
											<option value="">--Select Category--</option>
											<?php
												$table='master_category';
												$data_array = array('status' => 1,'Slno_cat !='=>3);
								        		$query=$this->db->get_where($table,$data_array);
								        		foreach ($query->result() as $value) {
								        			echo "<option value='".$value->Slno_cat."'>".$value->category_name."</option>";
												}?>											
										</select>
										
										<small class="f-s-12 text-grey-darker">Please Select category name </small>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="material_name">Material Name<span style="color: red">*</span></label>
									<div class="col-md-9">
										<select  class="form-control m-b-5" name="material_name" id="material_name" required="">
											<option value="">--Select Material--</option>
																							
										</select>
										
										<small class="f-s-12 text-grey-darker">Please Select category name </small>
									</div>
								</div>
								

								
								
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="technical_id">Technical Id<span style="color: red">*</span></label>                             
                                	<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Technical id" name="technical_id" id="technical_id" type="text" required="" >
										<small class="f-s-12 text-grey-darker">Please Enter Technical id</small>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3"> Technical Details <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="technical_Description" required=""></textarea>
										<small class="f-s-12 text-grey-darker"> Please Enter Technical Details </small>
									</div>
								</div>		 	
							</div>				
						</div>
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
                                <a  href="user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                            </div>
                        </div>				
					</form>					
				</div>
			</div>

			<script type="text/javascript">
				function get_material_info() {
					var category_names=$('#category_name').val();
					if(category_names!=""){
						$.ajax({
						  	url:'get-category-technical-material',
						    method: 'post',
						    data: {field:category_names},
						    dataType: 'json',
						    success: function(response){
    	                        $('select[name="material_name"]').empty();
    	                        $('#material_name').html('<option value="">--Select Material--</option>');
    	                        $.each(response, function(key, value) {

		                            $('select[name="material_name"]').append('<option value="'+ value.Slno_item +'">'+ value.item_name +'</option>');

		                        });
						    	// $('#material_name').html(response);
						    }
						});

					}else{
						$('#material_name').html('<option value="">--Select Material--</option>');
					}
				}
			</script>

		
