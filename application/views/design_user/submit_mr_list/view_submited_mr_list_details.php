<?php 
$email_id=$this->session->userdata('design_email_id');
if(empty($email_id)){
	
	redirect('bu-logout-by-pass');
}
$job_Code_id=$job_Code_id;
$result_drafted=$this->design_user->design_mr_submited_list($job_Code_id);
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
				<li class="breadcrumb-item">View Material Requisition List</li>
				<li class="breadcrumb-item active">Detail Of View Of Submitted MR Job Code </li>
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
					                <th>MR No</th>
					                <th>Material Category</th>	  
					                <th>Date Create MR</th>
					                <th>Re-submit</th>
					                <th>Status of MR</th>
					                <th>Approve Date</th>
					                <th>Action</th>
					               
					            </tr>
					        </thead>	
					        <tbody>
					        	<?php 
					        		$x=0;
					        		// print_r($result_drafted);
					        		foreach ($result_drafted['submited_list'] as $value_list) {
					        			$last_id=$value_list->slno_mr;
					        			$x++;
					        			$Status=$value_list->status;
					        			switch ($value_list->materilal_category_id_slno) {
											case '1':
						                		if($Status==1){
						                            $view=('design-new-mr-order-first-view/'.$last_id.'/'.'1/'.$last_id);
						                        }else{
						                        	$view="#";
						                        }				                                    
						                        break;
						                    case '2':
						                        if($Status==1){
						                            $view=('design-new-mr-order-second-view/'.$last_id.'/'.'2/'.$last_id);
						                        }else{
						                            $view="#";
						                        }
			                                    break;
						                    case '3':
						                        if($Status==1){
						                            $view=('design-new-mr-order-third-view/'.$last_id.'/'.'3/'.$last_id);
						                        }else{
						                            $view="#";
						                        }	                                    
			                                    break;
			                                default:
			                                    $this->session->set_flashdata('error_message', ' Something went wrong ');
			                                    $view=('user-design-home');
			                                    break;
									 	}
													 	
					        		?>
					        		<tr>
						        		<td><?=$x?></td>								                
						                <td><?=$job_code_id=$value_list->job_code_id?></td>            				                
						                <td><?=$mr_no=$value_list->mr_no?></td> 
						                <td><?=$value_list->material_category_name?></td>					                
						                <td><?=$date_creation=$value_list->date_creation?></td>
						                <td><?=$resubmit_count=$value_list->resubmit_count?></td>	
						                <td><?php $mr_forword_status=$value_list->mr_forword_status;
						                		if($mr_forword_status==1){
						                			echo "<p style='color:green'><b>Approved</b></p>";
						                		}else{
						                			echo "<p style='color:orange'><b>Pending</b></p>";
						                		}
						                ?></td>
						                <td><?php
						                if($mr_forword_status==1){
						                	 echo $mr_forword_date=$value_list->mr_forword_date;
						                }else{
						                	echo "N/A";
						                }
						               ?></td>
						                <td><a href="<?=base_url().$view?>" class="btn btn-indigo btn-sm">View More</a></td>
						                
						              
															  
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

		