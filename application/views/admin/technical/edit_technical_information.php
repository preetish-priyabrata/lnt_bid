 <?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
	$value1=$Slno_technical;
	$value2=$token;
	$keys_id="preetishwebtechnical";
	$value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));

	$value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
	if($value1_convered_id==$value2){
		$data_id = array('Slno_technical' =>$value1_convered_id);
		$table='master_technical_detail';
		$query=$this->db->get_where($table,$data_id);
		$result_technical=$query->result();
		$row=$result_technical[0];
			// `Slno_technical`, `technical_name`, `technical_desc`, `technical_id`, `category_slno`, `status`, `date_entry`, `time_entry`
	}else{
		$this->session->set_flashdata('error_message', 'Some thing went Wrong');
	    // After that you need to used redirect function instead of load view such as                 
	    redirect('user-admin-home');
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
				<li class="breadcrumb-item active">Edit Technical Details</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit Technical Details Information </h1>
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
					<h4 class="panel-title">Edit Technical Information</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                        	</div>
					<form action="<?=base_url()?>admin-edit-technical-save" method="POST" >
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<input type="hidden" name="value1" value="<?=$value1?>">
								<input type="hidden" name="value2" value="<?=$value2?>">

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Technical_name">Technical Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Technical name" name="Technical_name" id="Technical_name" type="text" required="" value="<?=$row->technical_name?>">
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
								        			if($row->category_slno==$value->Slno_cat){
								        				echo "<option value='".$value->Slno_cat."' selected>".$value->category_name."</option>";
								        			}else{
								        				echo "<option value='".$value->Slno_cat."'>".$value->category_name."</option>";
								        			}

												}?>											
										</select>
										
										<small class="f-s-12 text-grey-darker">Please Select category name </small>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="material_name">Material Name<span style="color: red">*</span></label>
									<div class="col-md-9">
										<select  class="form-control m-b-5" onchange="" name="material_name" id="material_name" required="">
											<option value="">--Select Material--</option>
												<?php
												$table_mat='master_items_material';
												$data_array_mat = array('status' => 1,'Category_slno'=>$row->category_slno);
								        		$query_mat=$this->db->get_where($table_mat,$data_array_mat);
								        		foreach ($query_mat->result() as $value_mat) {
								        			if($row->material_slno==$value_mat->Slno_item){
								        				echo "<option value='".$value_mat->Slno_item."' selected>".$value_mat->item_name."</option>";
								        			}else{
								        				echo "<option value='".$value_mat->Slno_item."'>".$value_mat->item_name."</option>";
								        			}

												}?>											
										</select>
										
										<small class="f-s-12 text-grey-darker">Please Select category name </small>
									</div>
								</div>
								

								
								
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="technical_id">Technical Id<span style="color: red">*</span></label>                             
                                	<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Technical id" name="technical_id" id="technical_id" type="text" required="" value="<?=$row->technical_id?>">
										<small class="f-s-12 text-grey-darker">Please Enter Technical id</small>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3"> Technical Details <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="technical_Description" required=""><?=$row->technical_desc?></textarea>
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

		                            $('select[name="material_name"]').append('<option value="'+ value.slno_item +'">'+ value.item_name +'</option>');

		                        });
						    	// $('#material_name').html(response);
						    }
						});

					}else{
						$('#material_name').html('<option value="">--Select Material--</option>');
					}
				}
			</script>

		
