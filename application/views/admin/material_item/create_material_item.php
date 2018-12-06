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
				<li class="breadcrumb-item"><a href="javascript:;">Material Item</a></li>
				<li class="breadcrumb-item active">Create News Material Item</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Create Material Item Form </h1>
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
					<h4 class="panel-title">Add New Material Item Information</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                        	</div>
					<form action="admin-add-Material-Item-save" method="POST" >
						<div class="row">
							<div class="col-md-6 col-lg-6">

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Item_Name">Material Item Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Material Item name" name="Item_Name" id="Item_Name" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter Material Item name</small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="item_id"> Material Item id  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Material Item id " name="item_id" id="item_id" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter Material Item id </small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Material Item Description  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="category_Description" required=""></textarea>
										<small class="f-s-12 text-grey-darker"> Please Enter Material Item description  </small>
									</div>
								</div>

								
								
							</div>
							<div class="col-md-6 col-lg-6">

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="item_uom"> Material Item UOM  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Material Item UOM " name="item_uom" id="item_uom" type="text" required="">
										<small class="f-s-12 text-grey-darker">Here enter Material Item UOM </small>
									</div>
								</div>
							 	
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="category_name">Category  Name<span style="color: red">*</span></label>
									<div class="col-md-9">
										<select  class="form-control m-b-5" onchange="get_id_category()" name="category_name" id="category_name" required="">
											<option value="">--Select Category--</option>
											<?php
												$table='master_category';
												$data_array = array('status' => 1);
								        		$query=$this->db->get_where($table,$data_array);
								        		foreach ($query->result() as $value) {
								        			echo "<option value='".$value->category_id."'>".$value->category_name."</option>";
												}?>											
										</select>
										
										<small class="f-s-12 text-grey-darker">Please Select category name </small>
									</div>
								</div>
								
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="category_id">Category Id<span style="color: red">*</span></label>                             
                                	<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter category id" name="category_id" id="category_id" type="text" required="" readonly="">
										<small class="f-s-12 text-grey-darker">Dont do anything it will be fill by selecting category name</small>
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
	function get_id_category() {
		var category_name=$('#category_name').val();	
		if(category_name!=""){
			$('#category_id').val(category_name);
		}else{
			$('#category_id').val('');
		}
	}
</script>
			
				
