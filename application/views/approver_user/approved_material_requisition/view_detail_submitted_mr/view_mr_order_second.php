<?php 
$email_id=$this->session->userdata('approver_email_id');
if(empty($email_id)){
	
	redirect('approve-logout-by-pass');
}

$value=$value;
$value1=$value1;
$value2=$value2;
if($value2!=$value){
	  $this->session->set_flashdata('error_message', 'Some thing went worng');
	redirect('user-approver-home');
}

?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />

<div class="sidebar-bg"></div>
		<!-- end #sidebar -->

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="<?=base_url()?>user-approver-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Material Requisition</a></li>
				<li class="breadcrumb-item active">Approved Material Requisition </li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Approved Material Requisition</h1>
			<!-- end page-header error_message -->
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
			 <?php if(!empty($this->session->flashdata('error_message'))){?>
			<div class="alert alert-danger fade show">
			  <span class="close" data-dismiss="alert">×</span>
			  <strong>Error!</strong>
			  <?=$this->session->flashdata('error_message')?>
			  <!-- <a href="#" class="alert-link">an example link</a>.  -->
			</div>
			<?php
			}
			 // print_r($this->session->userdata());
			 ?>

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Approved Material Requisition </h4>
				</div>
				<div class="panel-body">

					<!-- <div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up
                        	</div> -->
					<form  action="#">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="activity_name">MR No 
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<?php
										$get_mr_id=$this->design_user->get_design_mr_no_deatils($value);
										$mr_no=$get_mr_id['mr_details'][0]->mr_no;
										$job_code_id=$get_mr_id['mr_details'][0]->job_code_id;
										$materilal_category_id_slno=$get_mr_id['mr_details'][0]->materilal_category_id_slno;
										$approver_id=$get_mr_id['mr_details'][0]->approver_id;
										$techinal_evalution=$get_mr_id['mr_details'][0]->techinal_evalution;
										$date_required=$get_mr_id['mr_details'][0]->date_required;
										$date_creation=$get_mr_id['mr_details'][0]->date_creation;
										$edit_id=$get_mr_id['mr_details'][0]->edit_id;
										$status_mr=$get_mr_id['mr_details'][0]->status;
										$resubmit_count=$get_mr_id['mr_details'][0]->resubmit_count;
										if($status_mr!=1){
											    $this->session->set_flashdata('error_message', 'Editing is denied for this MR');
											   
												redirect('user-approver-home');
										}
										?>
										<input class="form-control m-b-5"  name="Mr_no" id="Mr_no" type="text" value="<?=$mr_no?>" required="" readonly>
										<input class="form-control m-b-5"  name="slno_Mr_no" id="slno_Mr_no" type="hidden" value="<?=$value?>" required="" readonly>
										<input class="form-control m-b-5"  name="value1" id="value1" type="hidden" value="<?=$value1?>" required="" readonly>
										<input class="form-control m-b-5"  name="edit_id" id="edit_id" type="hidden" value="<?=$edit_id?>" required="" readonly>
										<input class="form-control m-b-5"  name="status_mr" id="status_mr" type="hidden" value="<?=$status_mr?>" required="" readonly>
										<input class="form-control m-b-5"  name="resubmit_count" id="resubmit_count" type="hidden" value="<?=$resubmit_count?>" required="" readonly>
										<!-- <small class="f-s-12 text-grey-darker">MR no</small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="job_code">Job Code 
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Activity name" name="job_code_id" id="job_code_id" type="text" value="<?=$job_code_id?>" required="" readonly>
										<!-- <small class="f-s-12 text-grey-darker">Job Code</small> -->
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="tech_evalution">Technical Evalution 
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<!-- <input class="form-control m-b-5" placeholder="Enter Activity name" name="activity_name" id="activity_name" type="text" required=""> -->
										<select name="tech_evalution" class="form-control m-b-5" id="tech_evalution" readonly>
											<option value="2" <?php if($techinal_evalution==2){echo "selected";}?> >No</option>
											<option value="1" <?php if($techinal_evalution==1){echo "selected";}?> >Yes</option>
										</select>
										<!-- <small class="f-s-12 text-grey-darker">Select Technical Evalution</small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="job_code">Action 
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<input type="text" readonly class="form-control-plaintext" value="Approved" />
										<!-- <div class="radio radio-css radio-inline">
										  <input type="radio" id="inlineCssRadio2" name="type_action"  value="1"  required="" />
										  <label for="inlineCssRadio2">Approved</label>
										</div>
										<div class="radio radio-css radio-inline">
										  <input type="radio" id="inlineCssRadio1" name="type_action" value="2" required="" />
										  <label for="inlineCssRadio1">Comment</label>
										</div> -->							
										
									</div>
								</div>






							</div>

							<div class="col-md-6 col-lg-6">
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="approver_id">Approver Name 
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<?php 
											$get_approver_id_slno=$this->approver_user->approver_get_creator_mr($approver_id);
						                			// print_r($get_approver_id_slno);
						                			 $Username_get_Procurement_id=$get_approver_id_slno['list_user'][0]->Username;
						                		
						                ?>
										<input type="text" readonly class="form-control-plaintext" value="<?=$Username_get_Procurement_id?>" />
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="materials_id">Material Category 
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<?php
										$data_array_materials=$this->design_user->get_design_material_category_list();

										?>

										<select name="materials_id" class="form-control m-b-5" id="materials_id" readonly>
											<?php
											if($data_array_materials['no_materials']==2){?>
												<option value="">--No Material Category Is found--</option>
												<?php
											}else if($data_array_materials['no_materials']==1){
												?>
												<!-- <option value="">--Select Material Category--</option> -->
											<?php
												foreach ($data_array_materials['materials_list'] as $key_materials) {
													if($materilal_category_id_slno==$key_materials->Slno_cat){
														echo "<option value='".$key_materials->Slno_cat."'>".$key_materials->category_name." [ ".$key_materials->short_code." ]</option>";
													}
												}


											}
											?>

										</select>
										<!-- <small class="f-s-12 text-grey-darker">Select Job Code</small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="mr_date_of_creation">Date Of Creating
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<input class="form-control m-b-5" name="mr_date_of_creation" value="<?=$date_creation?>" id="mr_date_of_creation" type="text" required="" readonly>
										<small class="f-s-12 text-grey-darker">Date Of Creating MR</small>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="required_date">Date Required
									 <!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<input disabled="" class="form-control m-b-5 datepickers" placeholder="Enter Date Required " name="required_date" id="required_date" type="text" value="<?=$date_required?>" required="">
										<!-- <small class="f-s-12 text-grey-darker">Please enter Date Required</small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="Procurement">Procurement Name 
										<!-- <span style="color: red">*</span> -->
									</label>
									<div class="col-md-9">
										<?php 
						                
						                	
						                		$get_approved=$this->approver_user->get_approver_conform_mr_job_detail($value);
						                		if($get_approved['no_mr_deatils']==1){
						                			$user_procement=$get_approved['mr_details'][0]->Procurement_id;
						                		
						                			$get_Procurement_id=$this->approver_user->approver_get_creator_mr($user_procement);

						                			 $Usget_Procurement_id=$get_Procurement_id['list_user'][0]->Username;
						                		}
						                ?>
						                 <input type="text" readonly class="form-control-plaintext" value="<?=$Usget_Procurement_id?>" />
									</div>
								</div>
							</div>








						 </div>
						 <div class="row">
							<div class="col-lg-12">
								<div id="cart-item-files"></div>
							</div>
						</div>
						 
						<hr>
						<div class="row">
							<div class="col-lg-12">
								<div id="cart-item"></div>
							</div>
						</div>
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                                <a  href="<?=base_url()?>approver-new-mr-conform" class="btn btn-sm btn-success">Back</a> 
                                <a  href="<?=base_url()?>user-approver-home" class="btn btn-sm btn-info">Home</a> 
                            </div>
                        </div>


					</form>

				</div>
			</div>
<script type="text/javascript">
function submitCheck(){
		var radioValue = $("input[name='type_action']:checked").val();
			// alert(radioValue);
            if(radioValue==2){
            	var textboxes = $('[id^=comment]');
				var emptytextboxes = textboxes.filter(function(){
				  return this.value == "";
				});

				if(textboxes.length == emptytextboxes.length){
				   alert('atleast one of the Comment should be filled');  
				   return false;
				}  
            	$('#Procurement').prop('required',false);

	    		return true;
              

            }else{
            	$('#Procurement').prop('required',true);
            	 return true;
            }

	    
	}

	function file_uploaded(){
		var actions_file='files_info_view';
    	var Mr_no = $('#Mr_no').val();
		var slno_Mr_no = $('#slno_Mr_no').val();
		queryString_id = 'actions_file='+actions_file+'&Mr_no='+ Mr_no+'&slno_Mr_no='+slno_Mr_no;

		jQuery.ajax({
			url: "<?php echo base_url(); ?>approver-file-upload-data",
			data:queryString_id,
			type: "POST",
			success:function(data){
				$("#cart-item-files").html(data);
			}
		});

	}
	function cart_active(){
		var action='add';
		var actions_file=$('#edit_id').val();;
    	var Mr_no = $('#Mr_no').val();
		var slno_Mr_no = $('#slno_Mr_no').val();
		queryString_id = 'actions_file='+actions_file+'&Mr_no='+ Mr_no+'&slno_Mr_no='+slno_Mr_no+'&action='+action;

		jQuery.ajax({
			url: "<?php echo base_url(); ?>approve_item_required_session_ids",
			data:queryString_id,
			type: "POST",
			success:function(data){
				$("#cart-item").html(data);
			}
		});

	}
	
  
   $(document).ready(function (e) {
   		file_uploaded();
   		cart_active();
        
    });
</script>
