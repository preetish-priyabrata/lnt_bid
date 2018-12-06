<?php 
$email_id=$this->session->userdata('buy_email_id');
if(empty($email_id)){
	
	redirect('buy-logout-by-pass');
}
$type='';
$result_drafted=$this->buyer_user->buyer_mr_receive_list($email_id,$type,'');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="<?=base_url()?>user-buyer-home">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Material Requisition</a></li>
				<li class="breadcrumb-item active">View Receive Material Requisition List</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"> View Receive Material Requisition </h1>
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
					
					<h4 class="panel-title">Receive Material Requisition </h4>
				</div>
				<div class="panel-body">		
					<div class="table-responsive">
						<table id="example_buyer" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Job Code</th>
					                <th>MR No.</th>
					                <th>Material Category</th>	                
					              	<th>Date of Creation</th>
					              	<th>Date of Submission</th>
					              	<th>Submited by</th>
					              	<th>Date of Approved</th>
					              	<th>Approved by</th>
					              	<th>Date of Assign</th>
					              	<th>Buyer by</th>
					              	<th>Status</th>
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        	<?php 
					        		if($result_drafted['no_received']==1){
					        		$x=0;
					        		// print_r($result_drafted);
					        		// Array ( [no_received] => 1 [received_list] => Array ( [0] => stdClass Object ( [Slno_buyer] => 1 [Mr_id] => 2018-11-05-pUgws [Slno_mr_id] => 3 [Job_code] => 679034 [Slno_procurement_id] => 3 [Buyer_id] => buy1@ilab.com [Status] => 1 [Technical_type] => 1 [Edit_id] => 1 [Technical_process_status] => 0 [Commercial_process_status] => 0 [Date_technical_status] => [Date_commercial__status] => [Mode_tender] => 0 [date_receive] => 2018-11-06 12:43:56 [procurement_id] => pro@ilab.com ) [1] => stdClass Object ( [Slno_buyer] => 2 [Mr_id] => 2018-11-05-Qts0z [Slno_mr_id] => 1 [Job_code] => 0770 [Slno_procurement_id] => 1 [Buyer_id] => buy1@ilab.com [Status] => 1 [Technical_type] => 2 [Edit_id] => 1 [Technical_process_status] => 0 [Commercial_process_status] => 0 [Date_technical_status] => [Date_commercial__status] => [Mode_tender] => 0 [date_receive] => 2018-11-06 14:43:07 [procurement_id] => pro@ilab.com ) ) ) 
					        		foreach ($result_drafted['received_list'] as $value_list) {
					        				$slnos=$value_list->Slno_mr_id;
					        				 $Slno_procurement_id=$value_list->Slno_procurement_id;
					        				$Technical_type=$value_list->Technical_type;
					        				$Technical_process_status=$value_list->Technical_process_status;
					        				$Commercial_process_status=$value_list->Commercial_process_status;
					        				$Slno_buyer=$value_list->Slno_buyer;
					        			$result_drafted_pr=$this->procurement_user->procurement_mr_receive_list('','1',$slnos);	
					        			// print_r($result_drafted_pr);
					        				$Approver_id=$result_drafted_pr['received_list'][0]->Approver_id;
					        				$buyer_name=$result_drafted_pr['received_list'][0]->buyer_name;
					        				$Forward_date=$result_drafted_pr['received_list'][0]->Forward_date;
					        				$Date_approver=$result_drafted_pr['received_list'][0]->Date_approver;
					        			$get_information=$this->procurement_user->procurement_mr_receive_single($slnos);
					        			$x++;	
					        			// print_r($get_information);				        			
					        			$last_id=$get_information['received_list_single'][0]->slno_mr;

					        			$Status=$get_information['received_list_single'][0]->status;
					        			switch ($get_information['received_list_single'][0]->materilal_category_id_slno) {
											case '1':
						                		if($Status==1){
						                            $view=($last_id.'/'.'1/'.$last_id.'/'.$Slno_buyer);
						                        }else{
						                        	$view="#";
						                        }				                                    
						                        break;
						                    case '2':
						                        if($Status==1){
						                            $view=($last_id.'/'.'2/'.$last_id.'/'.$Slno_buyer);
						                        }else{
						                            $view="#";
						                        }
			                                    break;
						                    case '3':
						                        if($Status==1){
						                            $view=($last_id.'/'.'3/'.$last_id.'/'.$Slno_buyer);
						                        }else{
						                            $view="#";
						                        }	                                    
			                                    break;
			                                default:
			                                    $this->session->set_flashdata('error_message', ' Something went wrong ');
			                                    $view=('user-procurement-home');
			                                    break;
									 	}
					        		?>
					        		<tr>
						        		<td><?=$x?></td>								                
						                <td><?=$get_information['received_list_single'][0]->job_code_id?></td>
						                <td><?=$get_information['received_list_single'][0]->mr_no?></td>
						                <td><?=$get_information['received_list_single'][0]->material_category_name?></td>
						                <td><?=$get_information['received_list_single'][0]->date_creation?></td>
						                 <td><?=$get_information['received_list_single'][0]->date_submition?></td>
						                <td>
						                	<?php 
						                		$creators_id=$get_information['received_list_single'][0]->creators_id;
						                		$get_creator=$this->approver_user->approver_get_creator_mr($creators_id);               		
						                		echo $Username=$get_creator['list_user'][0]->Username
						                	?>						                	
						                </td> 
						                  <td><?=$Date_approver?></td>
						                <td>
						                	<?php 
						                		
						                		$get_creators=$this->approver_user->approver_get_creator_mr($Approver_id);               		
						                		echo $Username=$get_creators['list_user'][0]->Username
						                	?>						                	
						                </td> 
						                  <td><?=$Forward_date?></td>
						                <td>
						                	<?php 
						                		             		
						                		echo $buyer_name
						                	?>						                	
						                </td>  
						                <td><?php
						                	$value_process =$Technical_type.$Technical_process_status.$Commercial_process_status;
						                	switch ($value_process) {
						                		case '111': // no action
						                			echo "Technical & Commercial Completed";
						                			 $href_id="--";
						                			break;
						                		case '100':
						                			echo "Technical Not Initiated";
						                			 $href_id='<a href="'.base_url().'buyer-technical-commercial-assign/005100/'.$view.'" class="btn btn-purple btn-sm">View & Send Technical </a>';
						                			break;
						                		case '110':
						                			echo "Technical Completed Commercial Not Initiated";
						                			 $href_id='<a href="'.base_url().'buyer-technical-commercial-assign/005110/'.$view.'" class="btn btn-purple btn-sm">View & Send Commercial </a>';
						                			break;
						                		case '200':
						                			echo "Commercial Not Initiated";
						                			 $href_id='<a href="'.base_url().'buyer-technical-commercial-assign/005200/'.$view.'" class="btn btn-purple btn-sm">View & Send Commercial Only </a>';
						                			break;
						                		case '201': // no action
						                			echo "Commercial Completed";
						                			 $href_id='--';
						                			break;
						                		case '120': // no action
						                			echo "Technical Processing";
						                			 $href_id='--';
						                			break;
						                		case '112': // no action
						                			echo "Commercial Processing";
						                			 $href_id='--';
						                			break;
						                		case '202': // no action
						                			echo "Commercial Processing";
						                			 $href_id='--';
						                			break;
						                		default:
						                			
						                			echo "Processing";
						                		 	$href_id='--';
						                			break;
						                	}
						                ?></td>    
	                                   <td><?=$href_id?></td>   
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
					<a href="<?=base_url()?>user-procurement-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Back</a>
				</div>
			</div>

		
		</div>
		<!-- end #content -->

		