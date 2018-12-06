<?php 
$email_id=$this->session->userdata('buy_email_id');
if(empty($email_id)){
	
	redirect('buy-logout-by-pass');
}
$resutl=$this->user->get_bu_trackinh(2,'');
					        		// $query_id=$this->db->get_where('master_tracking_tools',array('Status'=>'2'));
					        		// echo $this->db->error();
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="<?=base_url()?>user-design-home">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Bid document to Technical Evaluator</a></li>
				<li class="breadcrumb-item active">Bid document to Technical Evaluator</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> >Bid document to Technical Evaluator </h1>
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
			 <div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					
					<h4 class="panel-title">Bid document to Technical Evaluator </h4>
				</div>
				<div class="panel-body">		
					<div class="table-responsive">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Bid No.</th>
					                <th>MR No.</th>
					                <th>Material Category</th>	                
					              	<th>Status</th>					              	
					              	<th>View</th>					              	
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        	<?php 
					        		$x=0;   	
					        		if($resutl['no_received']=='1'){


					        		
					        		// echo $this->db->last_query();
					        		// print_r($resutl);
					        		foreach ($resutl['received_list'] as $key_value) {
					        			$x++;
					        			// print_r($key_value);
					        		
					        	?>
					        	<tr>
					        		<td><?=$x?></td>
					        		<td><?=$key_value->Job_code?></td>
					        		<td><?=$key_value->Po_no?></td>
					        		<td><?=$key_value->Po_date?></td>
					        		<td><?=$key_value->Update?></td>
					        		<td><?php 
					        			$submitted_by=$key_value->submitted_by;
					        			$get_creator=$this->approver_user->approver_get_creator_mr($submitted_by);               		
						                		echo $Username=$get_creator['list_user'][0]->Username
					        		?></td>
					        		<td><?php 
						        		if($submitted_by==$email_id){
						        			 $Slno_tracking=$key_value->Slno_tracking;
						        			?>
						        			<a href="bu-edit-tracking-tool/<?=$Slno_tracking?>" class="btn btn-purple btn-sm">Edit Details</a>
						        			<?php 
						        		}else{
						        			echo "---";
						        		}
					        		?></td>


					        	</tr>
					        	<?php 
					        }
					        }

					        	?>
					        </tbody>				        
					    </table>
					</div>
					<br>
					<br>
					<a href="<?=base_url()?>user-bu-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Back</a>
				</div>
			</div>

		
		</div>
		<!-- end #content -->

		