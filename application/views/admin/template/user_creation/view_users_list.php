<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
  <!--   
    https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css -->

<!-- 
    https://code.jquery.com/jquery-3.3.1.js
    
 -->
<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="user-admin-home">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">User</a></li>
				<li class="breadcrumb-item active">View Users Lsit</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">View System User List <small>Who can access system..</small></h1>
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
					
					<h4 class="panel-title">System User List</h4>
				</div>
				<div class="panel-body">
					
					<div class="pull-right">
						<a href="admin-add-users" class="btn btn-info fa fa-user-plus " role="button">  New User</a>
					</div>
					<br>
					<br>
					<div class="table-responsive-sm">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>User Name</th>
					                <th>User Email Id</th>
					                <th>Mobile No </th>
					                <th>Designation</th>
					                <th>Password</th>
					                <th>Status</th>
					                <th>User Role</th>
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        		<?php 
					        		$x=0;
					        		$data = array('role_id !=' => '1' );
					        		$table='master_admin';
					        		$query=$this->db->get_where($table,$data);
					        		foreach ($query->result() as $value) {
					        			$slno_id=$value->slno;
					        			$keys_id="preetishweb";
					        			 $encript_id=($this->encrypt->encode($slno_id,$keys_id));   			 
					        			
										 $user_id = strtr($encript_id,array('+' => '.', '=' => '-', '/' => '~'));
					        			
					        								        		
					        			$x++;
					        			?>
					        			<tr>
							        		<td><?=$x?></td>
							                <td><?=$value->Username?></td>
							                <td><?=$value->email_id?></td>
							                <td><?=$value->user_mobile?></td>
							                <td><?=$value->user_degination?></td>
							                <td><?=$value->Password?></td>
							                <td><?php $Status=$value->Status;
							                if($Status==1){
							                	echo "Active User";
							                }else if($Status==2){
							                	echo "In-active User";
							                }elseif ($Status==3) {
							                	echo "Deleted User";
							                }else{
							                	echo "--";
							                }

							                ?></td>
							                <td><?php $role_id=$value->role_id;
							                	switch ($role_id) {
							                		case '2':
							                			echo "Design User";
							                			break;
							                		case '3':
							                			echo "Project User";
							                			break;
							                		case '4':
							                			echo "Procurement User";
							                			break;
							                		case '5':
							                			echo "Report User";
							                			break;
							                		case '6':
							                			echo "BU User";
							                			break;
							                		case '7':
							                			echo "Buyer User";
							                			break;
							                		case '7':
							                			echo "Approver User";
							                			break;
							                		
							                		default:
							                			echo "--";
							                			break;
							                	}

							                ?></td>
							                <td>
							                	<div class="btn-group">
												  <a href="#" class="btn btn-purple btn-sm">Action</a>
												  <a href="#" class="btn btn-purple dropdown-toggle"
												    data-toggle="dropdown"></a>
												  <ul class="dropdown-menu pull-right">
												  	<li><a href="admin-user-change_password/<?=$user_id?>/<?=$slno_id?>" >Change Password</a></li>
												  	<li><a href="user-admin-home" >Edit </a></li>
												  	<li class="divider"></li>
												  	<li><a href="">Delete</a></li>
												  </ul>
												</div>
							                	<!-- <a href="user-admin-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Reset Password</a> <br>
							                	<a href="user-admin-home" class="btn btn-xs btn-info fa fa-angle-left"   role="button"><i class=""></i> Edit Password</a> -->
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

			<!-- begin panel -->
			<!-- <div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Panel Title here</h4>
				</div>
				<div class="panel-body">

					Panel Content Here
				</div>
			</div> -->
			<!-- end panel -->
		</div>
		<!-- end #content -->

		