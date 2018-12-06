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
				<li class="breadcrumb-item"><a href="javascript:;">Technical</a></li>
				<li class="breadcrumb-item active">View Technical List</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">View Technical List </h1>
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
					
					<h4 class="panel-title">Technical List</h4>
				</div>
				<div class="panel-body">
					
					<div class="pull-right">
						<a href="admin-add-Technical" class="btn btn-info fa fa-puzzle-piece " role="button" title="here new Technical is been created">  New Technical</a>
					</div>
					<br>
					<br>
					<div class="table-responsive-sm">
						<table id="example" class="display" style="width:100%">
					        <thead>
					            <tr>
					                <th>Slno .</th>
					                <th>Technical Name</th>	
					                <th>Technical Id</th>	
					                <th>Technical Details</th>
					                <th>Category</th>
					                <th>Material Name</th>					                
					                <th>Status</th>					                
					                <th>Action</th>
					            </tr>
					        </thead>	
					        <tbody>
					        		<?php 
					        		$x=0;
					        		
					        		$table='master_technical_detail';
					        		$query=$this->db->get($table);
					        		foreach ($query->result() as $value) {
					        		// `Slno_technical`, `technical_name`, `technical_desc`, `technical_id`, `category_slno`, `status`, `date_entry`, `time_entry`
					        			$slno_id=$value->Slno_technical;
					        			$keys_id="preetishwebtechnical";
					        			 $encript_id=($this->encrypt->encode($slno_id,$keys_id));   			 
					        			
										 $user_id = strtr($encript_id,array('+' => '.', '=' => '-', '/' => '~'));
					        			
					        								        		
					        			$x++;
					        			?>
					        			<tr>
							        		<td><?=$x?></td>
							                <td><?=$value->technical_name?></td>
							                <td><?=$value->technical_id?></td>
							                <td><?=$value->technical_desc?></td>
							                <td><?php
							                $data_cat = array('Slno_cat' => $value->category_slno);
							                // print_r($data_cat);
							                $table_cat='master_category';
					        				$query_cat=$this->db->get_where($table_cat,$data_cat);
					        				$result_cat=$query_cat->result();
					        				$data_cat_result=$result_cat[0];
					        				echo $data_cat_result->category_name;
							                ?></td>
							                <td><?php
							                $data_mat = array('Slno_cat' => $value->category_slno);
							                $table_mat='master_items_material';
											$data_array_mat = array('Category_slno'=>$value->category_slno, 'Slno_item'=>$value->material_slno);
								        	$query_mat=$this->db->get_where($table_mat,$data_array_mat);
							                
					        				$result_mat=$query_mat->result();
					        				$data_mat_result=$result_mat[0];
					        				echo $data_mat_result->item_name;
							                ?></td>
							               
							                <td><?php $Status=$value->status;
							                if($Status==1){
							                	echo "<a href='change-Technical-status/".$user_id."/".$slno_id."/1' class='btn btn-outline-primary btn-sm'>Active Technical</a>";
							                }else if($Status==2){
							                	echo "<a href='change-Technical-status/".$user_id."/".$slno_id."/2' class='btn btn-outline-warning btn-sm'>In-active Technical </a>";
							                }elseif ($Status==3) {
							                	echo "<a href='#' class='btn btn-danger btn-sm'>Deleted Technical</a>";
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
												  	<li><a   <?php echo "href='admin-edit-Technical-info/".$user_id."/".$slno_id."'";?> >Edit </a></li>
												  	<li class="divider"></li>
												  	<li><a <?php echo "href='change-Technical-status/".$user_id."/".$slno_id."/3' ";?> onclick="return confirm('Are you sure you want to delete this vendor?');">Delete</a></li>
												  </ul>
												</div>
												<?php }?>
							                	<!-- <a edit-Material-Item-infohref="user-admin-home" class="btn btn-xs btn-success fa fa-angle-left"   role="button"><i class=""></i> Reset Password</a> <br>
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

		
		</div>
		<!-- end #content -->

		