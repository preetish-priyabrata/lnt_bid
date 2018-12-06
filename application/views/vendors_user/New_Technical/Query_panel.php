<?php
$Vendor_email_id=$this->session->userdata('Vendor_email_id');
if(empty($Vendor_email_id)){

	redirect('vendor-logout-pass');
}
$value=$value;
$result_title=$this->vendor_db_users->vendor_new_query_tech_title($value,$Vendor_email_id);
if($result_title['no_new_tech']!=1){
	$this->session->set_flashdata('error_message', 'Unable find Bid');
	redirect('user-vendor-home');
}
?>
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<!-- <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
				<li class="breadcrumb-item active">Page with Top Menu</li> -->
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Query Panel<small></small></h1>
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

			 ?>
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">

						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Query Panel</h4>
				</div>
				<div class="panel-body">
						<form  action="<?=base_url()?>vendor-bid-query-tech" method="post">
	            <div class="row">
								<div class="col-md-12 col-lg-12">

									<h4 class="panel-title ">Title Bid  : <h5><?=$result_title['new_tech_list'][0]->title?></h5></h4>
									<hr style="height: 2px; background:  green">
								</div>
							</div>



							<div class="row">
	            	<div class="col-lg-2">
	              	<div class="form-group row m-b-15">
			     					<label class="col-form-label col-md-3" for="title">Query <span style="color: red"></span></label>
									</div>
								</div>
						 		<div class="col-lg-9">
									<input type="hidden" name='query_slno' value="<?=$value?>">
									<input type="hidden" name="bid_id" value="<?=$master_bid_id=$result_title['new_tech_list'][0]->master_bid_id?>">
									<textarea class="form-control" rows="3" name="query_details" ></textarea>
								</div>
								<div class="col-lg-1">
									 <button type="submit" class="btn btn-default">Submit</button>
								</div>
				      </div>
						</form>
					</div>
				</div>
				<!-- Query Block End  -->
				<?php
				 	$result_query=$this->vendor_db_users->vendor_new_query_list_view($master_bid_id,$Vendor_email_id);
					// print_r($result_query);
				?>
				<!-- Query table WILL SHOW  -->
				<div class="panel panel-inverse">
					<div class="panel-heading">
						<div class="panel-heading-btn">

							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
						</div>
						<h4 class="panel-title">Query List </h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive-sm">
								<table id="example" class="display" style="width:100%">
									<thead>
										 <tr>
											 <th>Slno .</th>
											 <th>Query</th>
											 <th>Query Date</th>
											 <th>Response Details</th>
											 <th>Response Date</th>
										 </tr>
								 </thead>
								 <tbody>
									 <?php
									 $x=0;
									 		if($result_query['no_new_tech_query']==1){
												foreach ($result_query['new_tech_query_list'] as $key_query) {
													$x++;

													?>
													<tr>
														<td><?=$x?></td>
														<td><?=$key_query->query_details?></td>
														<td><?=$key_query->date_query?></td>
														<?php if($key_query->status_responds==1){?>
														<td><?=$key_query->response_detail?></td>
														<td><?=$key_query->date_respond?></td>
													<?php }else{
														?>
														<td>--</td>
														<td>--</td>
														<?php
													}?>
													</tr>
													<?php
													
												}

											}
									  ?>

								 </tbody>

							</table>

						</div>
					</div>
					<a  href="<?=base_url()?>user-design-home" class="btn btn-sm btn-link">Back</a>

				</div>
