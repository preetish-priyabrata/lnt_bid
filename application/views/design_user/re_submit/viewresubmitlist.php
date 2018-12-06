<?php 
$email_id=$this->session->userdata('design_email_id');
if(empty($email_id)){
	
	redirect('bu-logout-by-pass');
}
$result_drafted=$this->design_user->design_mr_resubmission_list();
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
				<li class="breadcrumb-item active">View Resubmission  Material Requisition List</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> View of Resubmission Material Requisition </h1>
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
					
					<h4 class="panel-title">Resubmission Material Requisition List</h4>
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
					                <th>MR No.</th>
					                <th>Date of MR</th>	                
					              	<th>Date of Submission</th>
					              	<th>Approver</th>
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        	<?php 
					        		$x=0;
					        		if($result_drafted['no_drafted']==1){
					        		// print_r($result_drafted);
					        		foreach ($result_drafted['drafted_list'] as $value_list) {
					        			$x++;
					        			
					        			$last_id=$value_list->slno_mr;
					        		?>
					        		<tr>
						        		<td><?=$x?></td>								                
						                <td><?=$value_list->job_code_id?></td>
						                <td><?=$value_list->mr_no?></td>
						                <td><?=$value_list->material_category_name?></td>
						                <td><?=$value_list->date_creation?></td>       
	                                   <td><?php $Status=$value_list->status;
						                if($Status==6){
						                	echo "Commented";
						                }else{
						                	echo "--";
						                }

						                ?></td>
						                
						                <td>
						                	<div class="btn-group">
												<a href="#" class="btn btn-purple btn-sm">Action</a>
												<a href="#" class="btn btn-purple dropdown-toggle" data-toggle="dropdown"></a>
												<ul class="dropdown-menu pull-right">	
													<?php 
														switch ($value_list->materilal_category_id_slno) {
															case '1':
						                                   
															if($Status==6){
						                                    	$edit=('design-resubmit-mr-order-edit/'.$last_id.'/'.'1/'.$last_id);
						                                	}else{
						                                		$edit='#';
						                                	}
						                                    
						                                    break;
						                                case '2':
						                                	if($Status==6){
						                                    	$edit=('design-resubmit-mr-order-edit/'.$last_id.'/'.'2/'.$last_id);
						                                	}else{
						                                		$edit='#';
						                                	}
						                                
						                                    
						                                    break;
						                                case '3':
						                                	if($Status==6){
						                                    	$edit=('design-resubmit-mr-order-edit/'.$last_id.'/'.'3/'.$last_id);
						                                	}else{
						                                		$edit='#';
						                                	}
						                                 
						                                    
						                                   
						                                    break;
						                                
						                                default:
						                                    $this->session->set_flashdata('error_message', ' Something went wrong ');
						                                    $edit=('user-design-home');
						                                    break;
													 	}
													 ?>										  	
													<li><a   <?php echo "href='".$edit."'";?> >Edit </a></li>
													<li class="divider"></li>
													
												</ul>
											</div>
	                                   </td>
	                                   <!-- <td></td> -->
															  
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

					<a href="<?=base_url()?>user-design-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Back</a>
				</div>
			</div>

		
		</div>
		<!-- end #content -->

		