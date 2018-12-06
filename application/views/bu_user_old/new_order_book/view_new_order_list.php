<?php 
$email_id=$this->session->userdata('bu_email_id');
if(empty($email_id)){
	
	redirect('bu-logout-by-pass');
}
$this->db->select('*');
	$this->db->from('master_project');
	$this->db->join('assign_project_user', ' (assign_project_user.project_slno = master_project.Project_Slno AND master_project.bu_status=1 AND master_project.status=1 ) ', 'right outer' );
						// $this->db->join('city', 'city.user_id = users.id','left');
	$this->db->where('assign_project_user.email_id', $email_id); 
	$this->db->where('master_project.bu_status', 1); 
	$query_bu = $this->db->get();
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="<?=base_url()?>user-bu">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Order Book</a></li>
				<li class="breadcrumb-item active">View Order Book Lsit</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">View  Order Book List </h1>
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
					
					<h4 class="panel-title">Order Book List</h4>
				</div>
				<div class="panel-body">
					
					<div class="pull-right">
						<a href="bu-add-new-order-book" class="btn btn-info fa fa-puzzle-piece " role="button" title="here new activity is been created"> Create New Order Book</a>
					</div>
					<br>
					<br>
					<div class="table-responsive-sm">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Job Name</th>
					                <th>Project Name</th>
					                <th>Description</th>					                
					                <th>Status</th>					                
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        	<!-- Array ( [0] => stdClass Object ( [Project_Slno] => 1 [Project_Name] => project 1 [job_Code] => 0770 [Date_Start] => 2018-11-01 [Customer_Name] => sandy [Customer_Mobile_No] => 12345667890 [project_Description] => This page contains top rated real world PHP examples of method Flight::set from package flight extracted from open source projects. You can rate examples to [status] => 1 [bu_status] => 0 [Date_Entry] => 2018-09-28 [Time_Entry] => 20:38:23 [slno_assign_project] => 1 [user_slno] => 7 [email_id] => bu1@ilab.com [project_slno] => 1 [job_code] => 0770 [role_id] => 6 [date_create] => 2018-09-28 [time_create] => 20:38:23 ) )  -->
					        		<?php 
					        		// print_r($query_bu->result());
					        		$x=0;
					        		
					        		
					        		foreach ($query_bu->result() as $value) {
					        			$table='master_new_order_book';
					        			$get_data_order = array('Slno_project' =>$value->Project_Slno );
					        			$query=$this->db->get_where($table,$get_data_order);
					        			$data_result=$query->result();
					        			$data_order=$data_result[0];
					        			// `Activity_Slno`, `Activity_Name`, `Activity_Description`, `Status`, `Date_Entry`, `Time_Entry`
					        			$slno_id=$data_order->Slno_n_order;
					        			$keys_id="preetishwebneworder";
					        			 $encript_id=($this->encrypt->encode($slno_id,$keys_id));   			 
					        			
										 $user_id = strtr($encript_id,array('+' => '.', '=' => '-', '/' => '~'));
					        			
					        								        		
					        			$x++;
					        			
					        			?>
					        			<tr>
							        		<td><?=$x?></td>
							                <td><?=$value->Project_Name?></td>
							                <td><?=$value->job_Code?></td>
							                <td><?=$data_order->Job_description?></td>
							               
							                <td><?php $Status=$data_order->Status;
							                if($Status==1){
							                	echo "<a href='bu-change-order-booked-status/".$user_id."/".$slno_id."/1' class='btn btn-outline-primary btn-sm'>Active </a>";
							                }else if($Status==2){
							                	echo "<a href='bu-change-order-booked-status/".$user_id."/".$slno_id."/2' class='btn btn-outline-warning btn-sm'>In-active </a>";
							                }elseif ($Status==3) {
							                	echo "<a href='#' class='btn btn-danger btn-sm'>Deleted </a>";
							                }else{
							                	echo "--";
							                }

							                ?></td>
							               
							                <td>
							                	<?php  if($Status!=3){ ?>
							                	<div class="btn-group">
												  <a href="#" class="btn btn-purple btn-sm">Action</a>
												  <a href="#" class="btn btn-purple dropdown-toggle"
												    data-toggle="dropdown"></a>
												  <ul class="dropdown-menu pull-right">											  	
												  	<li><a   <?php echo "href='bu-view-order-booked-info/".$user_id."/".$slno_id."'";?> >View & Edit </a></li>
												  	<li class="divider"></li>
												  	
												  </ul>
												</div>
												<?php }?>
							                	
							                </td>
					            		</tr>
					        			<?php 
					        		}
					        		?>
					        </tbody>				        
					    </table>
					</div>
					<br>
					<br>
					<a href="user-admin-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Back</a>
				</div>
			</div>

		
		</div>
		<!-- end #content -->

		