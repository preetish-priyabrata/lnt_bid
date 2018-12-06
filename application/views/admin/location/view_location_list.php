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
				<li class="breadcrumb-item"><a href="javascript:;">Location</a></li>
				<li class="breadcrumb-item active">View Location  Lsit</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">View  Location List </h1>
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

					<h4 class="panel-title">Location List</h4>
				</div>
				<div class="panel-body">

					<div class="pull-right">
						<a href="admin-add-Location" class="btn btn-info fa fa-puzzle-piece " role="button" title="hre new Category is been created">  New Location</a>
					</div>
					<br>
					<br>
					<div class="table-responsive-sm">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Location Name</th>
					                <!-- <th>Location Description</th> -->
					                <th>Status</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        		<?php
						        		$x=0;
						        		// `slno_loc`, ``, ``, ``, `date_entry`, `last_updated`
						        		$table='master_loaction_details';
						        		$query=$this->db->get($table);
						        		foreach ($query->result() as $value) {
						        			$slno_id=$value->slno_loc;
						        			$keys_id="preetishweblocation";
						        			$encript_id=($this->encrypt->encode($slno_id,$keys_id));
											 		$user_id = strtr($encript_id,array('+' => '.', '=' => '-', '/' => '~'));
						        			$x++;
					        			?>
					        			<tr>
							        		<td><?=$x?></td>
							                <td><?=$value->location_name?></td>
							                <!-- <td><?=$value->loaction_details?></td> -->
							                <td>
												<?php
													$Status=$value->status;
									                if($Status==1){
									                	echo "<a href='change-Location-status/".$user_id."/".$slno_id."/1' class='btn btn-outline-primary btn-sm'>Active Location</a>";
									                }else if($Status==2){
									                	echo "<a href='change-Location-status/".$user_id."/".$slno_id."/2' class='btn btn-outline-warning btn-sm'>In-active Location</a>";
									                }elseif ($Status==3) {
									                	echo "<a href='#' class='btn btn-danger btn-sm'>Deleted Location</a>";
									                }else{
									                	echo "--";
									                }
												?>
											</td>
							                <td>
							                	<?php  if($Status!=3){ ?>
							                	<div class="btn-group">
												  <a href="#" class="btn btn-purple btn-sm">Action</a>
												  <a href="#" class="btn btn-purple dropdown-toggle"
												    data-toggle="dropdown"></a>
												  <ul class="dropdown-menu pull-right">
												  	<li> <a href="#"  data-toggle="modal" data-target="#location_<?=$slno_id?>">Edit</a></li>
												  	
												  	<li class="divider"></li>
												  	<li><a <?php echo "href='change-Location-status/".$user_id."/".$slno_id."/3' ";?> onclick="return confirm('Are you sure you want to delete this Location?');">Delete</a></li>
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
		<?php 


			$get_type_location=$this->user->admin_get_location();
			if($get_type_location['location_no']=='1'){
				foreach ($get_type_location['location_no_list'] as $key_location) {

		?>
		<!-- end #content -->
					<!-- basic modal -->
					<div class="modal fade" id="location_<?=$key_location->slno_loc?>" tabindex="-1" role="dialog" aria-labelledby="location_<?=$key_location->slno_loc?>" aria-hidden="true">
					  	<div class="modal-dialog">
					    	<div class="modal-content">
						      	<div class="modal-header">
							        <h4 class="modal-title" id="myModalLabel">Edit Loaction</h4>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							    </div>
							    <form action="admin-add-Location-save" method="POST" >
						 			<input name="Location_name_form" id="Location_name_form" type="hidden" value="Edit_loaction" required="">
						     		<div class="modal-body">
						     			<div class="row">
											<div class="col-md-6 col-lg-12">
											 	<div class="form-group row m-b-15">
													<label class="col-form-label col-md-3" for="Location_name">Location Name <span style="color: red">*</span></label>
													<div class="col-md-9">
														<input class="form-control m-b-5" onkeyup="get_check_location(<?=$key_location->slno_loc?>)" placeholder="Enter Location name" name="Location_name" value="<?=$key_location->location_name?>" id="Location_name_<?=$key_location->slno_loc?>" type="text" required="">
														<input type="hidden" value="<?=$key_location->slno_loc?>" name="location_slno" required="">
														<small class="f-s-12 text-grey-darker">Here enter Location name</small>
														<br>
														<span id="error_<?=$key_location->slno_loc?>" style="color:red"></span>
													</div>
												</div>
											</div>
										</div>
						      		</div>
						      		<div class="modal-footer">
								        <button type="submit" id="save_<?=$key_location->slno_loc?>" class="btn btn-sm btn-primary m-r-5 btn-mo">Save</button>
								         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        
						      		</div>
						      	</form>
					    	</div>
					 	</div>
					</div>

					<?php
						}
					}
					?>
<script type="text/javascript">
		$(document).ready(function(){
			$('.btn-mo').hide();
		});
function get_check_location(id) {
	var Location_name=$('#Location_name_'+id).val();
	$('#save_'+id).hide();			
	var type_of_name=$('#type_of_name').val();	
	var action_id="location_info";
	if(type_of_name!=""){
		$('#save_'+id).hide();
		queryString_id = 'action='+action_id+'&code='+ Location_name;
		jQuery.ajax({
			url: "<?=base_url()?>check_vehicle_type_status",
			data:queryString_id,
			type: "POST",
			success:function(data){
				if(data==1){
					$('#error_'+id).html('');
					$('#save_'+id).show();
				}else if(data==2){
					$('#error_'+id).html('Location Type Is already Is existed');
					$('#save_'+id).hide();

				}else{
					$('#error_'+id).html('Some Thing Went Wrong');
					$('#save_'+id).hide();
				}
			}
		});

	}else{
		$('#save_'+id).hide();
	}

}


</script>