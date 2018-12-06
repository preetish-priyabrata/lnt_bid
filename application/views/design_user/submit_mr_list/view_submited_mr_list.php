<?php 
$email_id=$this->session->userdata('design_email_id');
if(empty($email_id)){
	
	redirect('bu-logout-by-pass');
}
$result_drafted=$this->design_user->design_mr_submited_list();
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
				<li class="breadcrumb-item"><a href="javascript:;">Material Requisition</a></li>
				<li class="breadcrumb-item active">View Material Requisition List</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> View Material Requisition </h1>
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
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					
					<h4 class="panel-title">Material Requisition List</h4>
				</div>
				<div class="panel-body">
					
					<div class="pull-right">
						<a href="<?=base_url()?>design-new-mr-order" class="btn btn-info fa fa-puzzle-piece " role="button" title="here new material requisition been created"> Create New Material Requisition</a>
					</div>
					<br>
					<br>
					<div class="table-responsive-sm">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Job Code</th>
					                <th>Submitted MR</th>
					                <th>Drafted MR</th>
					              
					               
					            </tr>
					        </thead>	
					        <tbody>
					        	<?php 
					        		$x=0;
					        		// print_r($result_drafted);
					        		foreach ($result_drafted['submited_list'] as $value_list) {
					        			$x++;
					        			
					        		?>
					        		<tr>
						        		<td><?=$x?></td>								                
						                <td><?=$job_code_id=$value_list->job_code_id?></td>
						                <td>
						                	<?php  $results_submit=$this->design_user->get_design_master_mr_get_no_entry(1,$job_code_id);
						                 if($results_submit!=0){
						                	echo '<a href="design-submitted-mr-order-detail/'.$job_code_id.'/2" class="btn btn-lime btn-sm">View More '.$results_submit.'</a>';             

						                }else{
						                	echo $results_submit;
						                }
						                ?>
						                </td>
						                <td>
						                	<?php  $results_submit=$this->design_user->get_design_master_mr_get_no_entry(2,$job_code_id);
						                 if($results_submit!=0){
						                	echo '<a href="design-submitted-mr-order-detail/'.$job_code_id.'/3" class="btn btn-lime btn-sm">View More '.$results_submit.'</a>';             

						                }else{
						                	echo $results_submit;
						                }
						                ?></td>

						              
															  
						            </tr>

					        		<?php 



					        		}				        	
					        	?>
					        </tbody>				        
					    </table>
					</div>
					<br>
					<br>
					<a href="<?=base_url()?>user-design-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Back</a>
				</div>
			</div>

		
		</div>
		<!-- end #content -->

		