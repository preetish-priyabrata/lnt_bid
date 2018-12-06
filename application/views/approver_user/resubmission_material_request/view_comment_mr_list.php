<?php 
$email_id=$this->session->userdata('approver_email_id');
if(empty($email_id)){
	
	redirect('approve-logout-by-pass');
}
$type='2';
$result_drafted=$this->approver_user->approver_mr_receive_list($email_id,$type);
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
				<li class="breadcrumb-item active">Resubmission Material Request List</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> View of Resubmission Material Request List </h1>
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
					
					<h4 class="panel-title">Resubmission Material Request List</h4>
				</div>
				<div class="panel-body">		
					<div class="table-responsive-sm">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Job Code</th>
					                <th>MR No.</th>
					                <th>Material Category</th>
					                <th>Date of MR</th>	                
					              	<th>Submission date</th>
					              	<th>Submitted by</th>
					              	<th>Date of Requirement</th>
					              	<th>Resubmission Request Date</th>
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        	<?php 
					        		if($result_drafted['no_received']==1){
					        		$x=0;
					        		foreach ($result_drafted['received_list'] as $value_list) {
					        			$x++;					        			
					        			$last_id=$value_list->slno_mr;

					        			$Status=$value_list->status;
					        			switch ($value_list->materilal_category_id_slno) {
											case '1':
						                		if($Status==6){
						                            $view=('approver-new-mr-order-Comment-view/'.$last_id.'/'.'1/'.$last_id);
						                        }else{
						                        	$view="#";
						                        }				                                    
						                        break;
						                    case '2':
						                        if($Status==6){
						                            $view=('approver-new-mr-order-Comment-view/'.$last_id.'/'.'2/'.$last_id);
						                        }else{
						                            $view="#";
						                        }
			                                    break;
						                    case '3':
						                        if($Status==6){
						                            $view=('approver-new-mr-order-Comment-view/'.$last_id.'/'.'3/'.$last_id);
						                        }else{
						                            $view="#";
						                        }	                                    
			                                    break;
			                                default:
			                                    $this->session->set_flashdata('error_message', ' Something went wrong ');
			                                    $view=('user-approver-home');
			                                    break;
									 	}
					        		?>
					        		<tr>
						        		<td><?=$x?></td>								                
						                <td><?=$value_list->job_code_id?></td>
						                <td><?=$value_list->mr_no?></td>
						                <td><?=$value_list->material_category_name?></td>
						                <td><?=$value_list->date_creation?></td>
						                <td><?=$value_list->date_submition?></td>
						                <td>
						                	<?php 
						                		$creators_id=$value_list->creators_id;
						                		$get_creator=$this->approver_user->approver_get_creator_mr($creators_id);               		
						                		echo $Username=$get_creator['list_user'][0]->Username
						                	?>						                	
						                </td>  
						                 <td><?=$value_list->date_required?></td> 
						                 <td>
						                 	<?php 
						                
						                		$slno_mr=$value_list->slno_mr;
						                		$edit_id=$value_list->edit_id;
						                		$get_approved=$this->approver_user->get_approver_comment_mr_job_detail($slno_mr,$edit_id);
						                		if($get_approved['no_mr_detils']==1){
						                			echo $Date_resubmit=$get_approved['mr_details'][0]->Date_resubmit;
						                		
						                			
						                		}else{
						                			echo "---";
						                		}
						                ?>
						                 </td>     
	                                   <td><a href="<?=$view?>" class="btn btn-purple btn-sm">view more</a></td>   
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
					<a href="<?=base_url()?>user-approver-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Back</a>
				</div>
			</div>

		
		</div>
		<!-- end #content -->

		