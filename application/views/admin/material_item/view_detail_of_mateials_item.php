<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
$value1=$Slno_item;
$value2=$token;
$keys_id="preetishwebitem";
$value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));

$value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
if($value1_convered_id==$value2){
	$table="master_items_material";
	// `Slno_item`, `Category_slno`, `item_name`, `item_id`, `item_detail`, `item_uom`, `status`, `date_entry`, `time_entry`, `category_id`, `category_name`
	$data_array = array('Slno_item' =>$value1_convered_id);
	$query=$this->db->get_where($table,$data_array);
	$result=$query->result();
	$value=$result[0];


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
				<li class="breadcrumb-item active"><a href="user-admin-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Material Item</a></li>
				<li class="breadcrumb-item active">View details of Material Item</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">View Details of Materials</h1>
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
					<h4 class="panel-title">View details of Material Item</h4>
				</div>
				<div class="panel-body">
						<h3>Material Item details <a href="<?=base_url()?>edit-Material-Item-info/<?=$value1?>/<?=$value2?>" class="btn btn-primary btn-sm pull-right"> Edit Material Info </a></h3>
						    	<br>
						<div class="row">
							<div class="col-md-6 col-lg-6">

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Item_Name">Material Item Name <span style="color: red"></span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Material Item name" name="Item_Name" id="Item_Name" type="text" required=""value="<?=$value->item_name?>" disabled>
										<small class="f-s-12 text-grey-darker"></small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="item_id"> Material Item id  <span style="color: red"></span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Material Item id " name="item_id" id="item_id" type="text" required=""value="<?=$value->item_id?>"  disabled>
										<small class="f-s-12 text-grey-darker"></small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Material Item Description  <span style="color: red"></span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="category_Description" required="" disabled><?=$value->item_detail?></textarea>
										<small class="f-s-12 text-grey-darker"></small>
									</div>
								</div>

								
								
							</div>
							<div class="col-md-6 col-lg-6">

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="item_uom"> Material Item UOM  <span style="color: red"></span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Material Item UOM " name="item_uom" id="item_uom" type="text" required="" value="<?=$value->item_uom?>" disabled>
										<small class="f-s-12 text-grey-darker"></small>
									</div>
								</div>
							 	
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="category_name">Category  Name<span style="color: red"></span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" type="text" value="<?=$value->category_name?>" disabled>
										
										
									</div>
								</div>
								
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="category_id">Category Id<span style="color: red"></span></label>                             
                                	<div class="col-md-9">
											<input class="form-control m-b-5" type="text" disabled value="<?=$value->category_id?>">
										<small class="f-s-12 text-grey-darker"></small>
									</div>
								</div>
							</div>				
						</div>
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                               
                                <a  href="user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                                <a  href="<?=base_url()?>admin-view-Material-Item" class="btn btn-sm btn-primary">Back </a> 
                            </div>
                        </div>				
								
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
			
				
