<?php 
$email_id=$this->session->userdata('buy_email_id');
if(empty($email_id)){
	
	redirect('buy-logout-by-pass');
}
$result_drafted=$this->buyer_user->drafted_bid_information($email_id,4,'');

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="#" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Bid Information</a></li>
				<li class="breadcrumb-item active">Save Bid Information</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Save Information Of Technical Bid</h1>
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
					<h4 class="panel-title">Save Bid Information</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php

						// print_r($result_drafted);
						// Array ( [no_bid] => 1 [bid_list] => Array ( [0] => stdClass Object ( [Slno_bid] => 1 [buyer_slno] => 1 [bid_date_entry] => 2018-12-03 [bid_ref] => REF 2018 [bid_id] => REF 2018 [category] => 3 [mode_bid] => Closed Bid [technical_bid_type] => 1 [status_bid] => 4 [mr_slno] => 3 [mr_no] => 2018-11-05-pUgws [job_code] => 679034 [edit_id] => 1 [material_category_name] => logistics [ logistics ] [bid_title] => SUPPLY OF CLOTHING ARTICLES FOR NCC CADETS OF NCC DIRECTORATE DELHI [bid_description] => INVITATION OF BIDS FOR SUPPLY OF CLOTHING ARTICLES FOR NCC CADETS OF NCC DIRECTORATE DELHI [data_entry] => 2018-12-03 14:55:44 [bid_creator_id] => buy1@ilab.com ) ) ) 

						?>
						<table id="example_buyer" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Bid Ref No</th>				                      
					              	<th>Bid Start Date</th>

					              	<th>Bid End Date</th>
					              	<th>Bid Query Date</th>
					              	<th>Bid Type</th>					              	
					              	<th>Status</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php 
					        	$x=0;
					        		if($result_drafted['no_bid']==1){
					        			foreach ($result_drafted['bid_list'] as $key_techniacl) {
					        				$x++;
					        				$bid_ref=$key_techniacl->bid_ref;
					        				$Slno_bid=$key_techniacl->Slno_bid;
					        				$result_drafted_dates=$this->buyer_user->drafted_bid_information_DATE($Slno_bid,4);
					        				// print_r($result_drafted_dates);
					        				 // Array ( [no_bid_date] => 1 [bid_date_list] => Array ( [0] => stdClass Object ( [Slno_bid_date] => 1 [bid_slno] => 3 [buyer_slno] => 1 [bid_start_date] => 2018-12-04 [bid_closed_date] => 2018-12-15 [bid_query_closed_date] => 2018-12-06 [status] => 4 [master_bid_id] => 1 ) ) ) 
					        				$category=$key_techniacl->category;
					        				switch ($category) {
					        					case '1':
					        						$edit=base_url()."buyer-bid-edit/".$Slno_bid."/".$category;
					        						$send=base_url()."buyer-bid-sent/".$Slno_bid."/".$category;
					        						break;
					        					case '2':
					        						$edit=base_url()."buyer-bid-edit/".$Slno_bid."/".$category;
					        						$send=base_url()."buyer-bid-sent/".$Slno_bid."/".$category;
					        						break;
					        					case '3':
					        						$edit=base_url()."buyer-bid-edit/".$Slno_bid."/".$category;
					        						$send=base_url()."buyer-bid-sent/".$Slno_bid."/".$category;
					        						break;
					        					default:
					        						$edit="#";
					        						$send="#";
					        						break;
					        				}
					        				?>
					        				<tr>
					        					<td><?=$x?></td>
					        					<td><?=$bid_ref?></td>
					        					<td><?=$result_drafted_dates['bid_date_list'][0]->bid_start_date?></td>
					        					<td><?=$result_drafted_dates['bid_date_list'][0]->bid_closed_date?></td>
					        					<td><?=$result_drafted_dates['bid_date_list'][0]->bid_query_closed_date?></td>
					        					<td><?=$key_techniacl->mode_bid?></td>
					        					<td><b style='color: red'>Not Send</b></td>
					        					<td><a href="<?=$edit?>" class="btn-info btn-sm "><i class="fa fa-edit"></i> Edit</a> || <a href="<?=$send?>" class="btn-success btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</a></td>
					        				</tr>

					        				<?php 
					        				# code...
					        			}
					        		}
					        	?>
					        </tbody>
					    </table>
					</div>					
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->