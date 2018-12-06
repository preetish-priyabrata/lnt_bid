<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="user-admin-home">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Vehicle</a></li>
				<li class="breadcrumb-item active">View vehicle Type List</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">View Vehicle Type List </h1>
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
					
					<h4 class="panel-title">Vehicle Type List</h4>
				</div>
				<div class="panel-body">
					
					<div class="pull-right">
						<a href="admin-add-vehicle-type" class="btn btn-info fa fa-puzzle-piece " role="button" title="here new vehicle is been created">  New vehicle Type info</a>
					</div>
					<br>
					<br>
					<div class="table-responsive-sm">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Type of vehicle</th>	
					               				                
					                <th>Status</th>					                
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        		<?php 
					        		$x=0;
					        		
					        		$table='master_vehicle_type';
					        		$query=$this->db->get($table);
					        		foreach ($query->result() as $value) {
					        			// `Slno_vendor`, `Vendor_name`, `Vendor_email_id`, `Mobile_no`, `Organisation_name`, `Password`, `Password_hash`, `Status`, `Date_entry`, `Time_entry`, `Vendor_desc`, `Organisation_address`
					        			$slno_id=$value->Slno_vehicle;
					        			$keys_id="preetishwebvechiletype";
					        			 $encript_id=($this->encrypt->encode($slno_id,$keys_id));   			 
					        			
										 $user_id = strtr($encript_id,array('+' => '.', '=' => '-', '/' => '~'));
					        			
					        								        		
					        			$x++;
					        			?>
					        			<tr>
							        		<td><?=$x?></td>
							                <td><?=$value->vehicle_type?></td>
							              
							               
							                <td><?php $Status=$value->status;
							                if($Status==1){
							                	echo "<a href='change-vehicle-type-status/".$user_id."/".$slno_id."/1' class='btn btn-outline-primary btn-sm'>Active vehicle</a>";
							                }else if($Status==2){
							                	echo "<a href='change-vehicle-type-status/".$user_id."/".$slno_id."/2' class='btn btn-outline-warning btn-sm'>In-active vehicle </a>";
							                }elseif ($Status==3) {
							                	echo "<a href='#' class='btn btn-danger btn-sm'>Deleted vehicle</a>";
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
												  	<li><a href="#modal-dialog<?=$slno_id?>" data-toggle="modal">Edit</a>
												  	</li>
												  	<li class="divider"></li>
												  	<li><a <?php echo "href='change-vehicle-type-status/".$user_id."/".$slno_id."/3' ";?> onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</a></li>
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
					<?php 
					$get_type_vehicle=$this->user->admin_get_vechile_type();
					// print_r($get_type_vehicle);
					// Array ( [vehicle_type] => 1 [vehicle_type_list] => Array ( [0] => stdClass Object ( [Slno_vehicle] => 1 [vehicle_type] => vehicle3 [status] => 1 [date_entry] => 2018-09-25 [time_entry] => 16:34:29 ) [1] => stdClass Object ( [Slno_vehicle] => 2 [vehicle_type] => vehicle1 [status] => 1 [date_entry] => 2018-09-25 [time_entry] => 16:35:24 ) [2] => stdClass Object ( [Slno_vehicle] => 3 [vehicle_type] => vehicle10 [status] => 1 [date_entry] => 2018-09-25 [time_entry] => 16:37:33 ) [3] => stdClass Object ( [Slno_vehicle] => 4 [vehicle_type] => vehicle12 [status] => 1 [date_entry] => 2018-09-25 [time_entry] => 16:59:37 ) [4] => stdClass Object ( [Slno_vehicle] => 5 [vehicle_type] => vehicle2 [status] => 1 [date_entry] => 2018-09-26 [time_entry] => 15:26:05 ) ) )
					?>
					<a href="user-admin-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Back</a>
				</div>
			</div>

		
		</div>
		<!-- end #content -->

		<?php 
		if($get_type_vehicle['vehicle_type']=='1'){

			foreach ($get_type_vehicle['vehicle_type_list'] as $key_vehicle) {
			// 	echo $key_vehicle->Slno_vehicle;
			// 	# code...
			// }
			?>
		<!-- #modal-dialog -->
							<div class="modal fade" id="modal-dialog<?=$key_vehicle->Slno_vehicle?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Edit Vehicle Type Information</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<form action="admin-edit-vehicle-type-save" method="POST" >
											<input  name="type_slno" id="type_slno" type="hidden" value="<?=$key_vehicle->Slno_vehicle?>" required="">
											<div class="modal-body">
												<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="type_of_name">Type of vehicle <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5"  placeholder="Enter type of vehicle " name="type_of_name" id="type_of_name" type="text" value="<?=$key_vehicle->vehicle_type?>" required="">
														<small class="f-s-12 text-grey-darker">Here enter Vehicle type</small>			
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
												<button type="submit" class="btn btn-success">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- #modal-without-animation -->

						<?php }

					}?>

		