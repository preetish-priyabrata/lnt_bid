<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
 	$value1=$category_Slno;
	 
	 $value2=$token;
	 
	 
	$keys_id="preetishwebcategory";

	$value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
	$value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
	if($value1_convered_id==$value2){
		$data = array('Slno_cat' =>$value1_convered_id);
        $table='master_category';
        $query=$this->db->get_where($table,$data);
        $data_db=$query->result(); // here fetch information 
        $row = $data_db[0]; 
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
				<li class="breadcrumb-item"><a href="javascript:;">Category</a></li>
				<li class="breadcrumb-item active">Edit Category</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit Category Form </h1>
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
					<h4 class="panel-title">Edit Category Information</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-secondary">
                    	<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                    </div>
					<form action="<?=base_url()?>admin-edit-category-save" method="POST" >						
						<input type="hidden" name="value1" value="<?=$value1?>">
						<input type="hidden" name="value2" value="<?=$value2?>">
						<div class="row">
							<div class="col-md-6 col-lg-6">
					        		

							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Category_name">Category Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Category name" name="Category_name" id="Category_name" type="text" required="" value="<?=$row->category_name?>">
										<small class="f-s-12 text-grey-darker">Here enter Category name</small>
									</div>
								</div>	

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="category_id">category id <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter category id" name="category_id" id="category_id" type="text" required=""  value="<?=$row->category_id?>">
										<small class="f-s-12 text-grey-darker">Here enter category id</small>
									</div>
								</div>

							</div>
							<div class="col-md-6 col-lg-6">
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="category_short">Short Category Name <span style="color: red">*</span></label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Short Category name" name="category_short" id="category_short" type="text" required=""  value="<?=$row->short_code?>">
										<small class="f-s-12 text-grey-darker">Here enter Short Category name</small>
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Category Description  <span style="color: red">*</span></label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="category_Description" required=""><?=$row->category_desc?></textarea>
										<small class="f-s-12 text-grey-darker"> Please Enter Category description  </small>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
                                <a  href="<?=base_url()?>user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                            </div>
                        </div>
						
						
					</form>
					
				</div>
			</div>
			
				
