<?php 
$email_id=$this->session->userdata('email_id');
if(empty($email_id)){
	
	redirect('admin-logout-by-pass');

}

	$value1=$user_id;
	$value2=$token;
	$keys_id="preetishweb";
	$value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
	$value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
if($value1_convered_id==$value2){
	$data = array('slno' =>$value1_convered_id);
	$table='master_admin';
	$query=$this->db->get_where($table,$data);
	$data_db=$query->result(); // here fetch information 
	$row = $data_db[0]; 
}else{
	$this->session->set_flashdata('error_message', 'Some thing went Wrong');
    // After that you need to used redirect function instead of load view such as                 
    redirect('user-admin-home');
}
?>
<style type="text/css">
	.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
/* The message box is shown when the user clicks on the password field */
#message {
    display:none;
    background: #f1f1f1;
    color: #000;
    position: relative;
    padding: 20px;
    margin-top: 10px;
}

#message p {
    padding: 10px 35px;
    font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -35px;
    content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
    color: red;
}

.invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
}
</style>
<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="user-admin-home" class="fa fa-home ">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">User</a></li>
				<li class="breadcrumb-item active">Change Users Password</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Change User Password Form </h1>
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

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> -->
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
					</div>
					<h4 class="panel-title">User Information</h4>
				</div>
				<div class="panel-body">
				<!-- 	<div class="alert alert-secondary">
                        		<span style="color: red"> *</span> All mandory fields shall be duly filled up 
                        	</div> -->
					<form action="<?=base_url()?>admin-add-users-save-password" method="POST">
						<input type="hidden" name="user_id_slno" value="<?=$value1?>">
						<input type="hidden" name="token_id" value="<?=$value2?>">

						<div class="row">
							<div class="col-md-6 col-lg-6">
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3" for="user_name">User Name </label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter User name" value="<?=$row->Username?>"  id="user_name" type="text" required="" disabled>
										<!-- <small class="f-s-12 text-grey-darker">Here enter user name</small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Mobile No </label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter mobile no" id="user_mobile"  type="number" value="<?=$row->user_mobile?>" disabled pattern="[1-9]{1}[0-9]{9}" required="" onkeyup="check_mobile(); return false;" ><span id="message_mobile"></span>
										<br>
										<!-- pattern="\d{3}[\-]\d{3}[\-]\d{4}"  -->
										<!-- <small class="f-s-12 text-grey-darker">Enter unique 10 digit moblie no</small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Password <span style="color: red">*</span></label>
									<div class="col-md-9">						
										
              							<input id="password-field" type="password" class="form-control m-b-5" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=""><span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
										<small class="f-s-12 text-grey-darker">No symbolic character is acceptable</small>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
							 	<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Email Id </label>
									<div class="col-md-9">
										<input class="form-control m-b-5" value="<?=$row->email_id?>" disabled placeholder="Enter email" type="email" required="">
										<!-- <small class="f-s-12 text-grey-darker">Email Id should be  Unique and valid</small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">Designation </label>
									<div class="col-md-9">
										<input class="form-control m-b-5" placeholder="Enter Degination" value="<?=$row->user_degination?>" disabled   type="text" required="">
										<!-- <small class="f-s-12 text-grey-darker">Please Enter a valid Designation </small> -->
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-form-label col-md-3">User Role </label>
									<div class="col-md-9">
										<select class="form-control" required=""  disabled="">
											<option value="">--Select User Role --</option>
											<option value="2" <?php if($row->role_id=='2'){echo "selected";}?>>Design User</option>
											<option value="3" <?php if($row->role_id=='3'){echo "selected";}?>>Project User</option>
											<option value="4" <?php if($row->role_id=='4'){echo "selected";}?>>Procurement User</option>
											<option value="5" <?php if($row->role_id=='5'){echo "selected";}?>>Report User</option>
										</select>
										<!-- <small class="f-s-12 text-grey-darker">Please select a role for the user  </small> -->
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row pull-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Update</button>
                                <a  href="user-admin-home" class="btn btn-sm btn-default">Cancel</a> 
                            </div>
                        </div>
						
						
					</form>
					
				</div>
			</div>
			<div id="message">
			  <h3>Password must contain the following:</h3>
			  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
			  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
			  <p id="number" class="invalid">A <b>number</b></p>
			  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
			</div>
			<!-- end panel -->
		</div>
		<!-- end #content -->
		<script type="text/javascript">
			$(".toggle-password").click(function() {

			  $(this).toggleClass("fa-eye fa-eye-slash");
			  var input = $($(this).attr("toggle"));
			  if (input.attr("type") == "password") {
			    input.attr("type", "text");
			  } else {
			    input.attr("type", "password");
			  }
			});
		</script>
		
				
<script>
var myInput = document.getElementById("password-field");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

function check_mobile(){

    var pass1 = document.getElementById('user_mobile');


    var message = document.getElementById('message_mobile');

   var goodColor = "#0C6";
    var badColor = "#FF9B37";

    if(pass1.value.length!=10){

        pass1.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "required 10 digits, match requested format!";
    }else if(pass1.value.length==10){
    	var filter =/[0-9]/g;
	    if (filter.test(pass1)) {
    		 pass1.style.backgroundColor = badColor;
        	message.style.color = badColor;
        	message.innerHTML = "invalid match requested format!";
    	}else{
    		pass1.style.backgroundColor = goodColor;
        	message.style.color = goodColor;
        	message.innerHTML = "match requested format!";

    		
        }    	
    }else{
    	 pass1.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "required 10 digits, match requested format!";
    }
}
</script>