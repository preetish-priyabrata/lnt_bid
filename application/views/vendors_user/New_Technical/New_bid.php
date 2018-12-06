<?php
$Vendor_email_id=$this->session->userdata('Vendor_email_id');
if(empty($Vendor_email_id)){

	redirect('vendor-logout-pass');
}
$result_new_bid=$this->vendor_db_users->vendor_new_technical_bid_list($Vendor_email_id)
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
			<h1 class="page-header">New Technical Bid<small></small></h1>
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
					<h4 class="panel-title">New Bid</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php
						// print_r($result_new_bid);
						?>
						<table id="example" class="display table" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Bid Ref</th>
					                <th>Status</th>
					                <th>Type of Bid</th>
					                <th>Bid Start date</th>
					              	<th>Bid End date</th>
					              	<th>Action</th>
					              	<th>Query</th>

					            </tr>
					        </thead>
					        <tbody>
					        	<?php
  										$x=0;
											if($result_new_bid['no_new_tech']==1){

													foreach ($result_new_bid['new_tech_list'] as  $key_technical) {

														$x++;
  									?>
													  <tr>
													    	<td><?php echo $x;?></td>
													    	<td><?php echo $key_technical->bid_ref;?></td>
													     	<td>
																	<?php
																			$status_view=$key_technical->status_view;
																			switch ($status_view) {
																				case '5':
																					echo "<b style='color:orange;'>Not Viewed</b>";
																					break;
																				case '6':
																							echo "<b style='color:blue;'>Viewed</b>";
																						break;
																			  case '7':
																							echo "<b style='color:green;'>Submitted</b>";
																						break;

																				default:
																					// code...
																					break;
																			}
																	?>
															  </td>
													     	<td><?php echo $key_technical->mode_bid;?></td>
													     	<td><?php echo $key_technical->date_start;?></td>
													     	<td><?php echo $key_technical->date_end;?></td>
																<td><a href="<?=base_url()?>user-vendor-bid-view-technical-details/<?=$key_technical->slno_vendor?>" class="btn btn-sm btn-success">View</a></td>
																<td><a href="<?=base_url()?>user-vendor-query-panel/<?=$key_technical->slno_vendor?>" class="btn btn-sm btn-warning">Query</a></td>
													  </tr>
  												<?php }
												}
													?>

</tbody>
  </table>
    </div>
  </div>
<!-- </div> -->
  </body>
