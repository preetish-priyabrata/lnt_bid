<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>asserts/assert/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>asserts/assert/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>asserts/assert/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>asserts/assert/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>asserts/assert/plugins/iCheck/square/blue.css">
  <style type="text/css">
    .login-box-body, .register-box-body {
      background: #fff9;
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background: linear-gradient(rgba(28, 43, 54, 0.5), rgba(28, 43, 54, 0.5)), url(<?=base_url()?>/asserts/img/back1.jpg); background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="#"><b>Login</b></a> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <a href="#"><b>Login</b></a>
    </div>
    <p class="login-box-msg">Smart Bidding System</p>
    <div>
      <!-- error & Success message // Get Flash data on view success_message
$this->session->flashdata('message_name'); -->
        <?php
          if(!empty($this->session->flashdata('error_msg'))) {
            ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error</strong> <?=$this->session->flashdata('error_msg')?>
            </div>
            <?php

          }if(!empty($this->session->flashdata('success_message'))){
             ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success</strong> <?=$this->session->flashdata('success_message')?>
            </div>
            <?php

          }else{

          }?>
    </div>
    <form action="login-rocess" method="POST">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="login_id"  placeholder="User Login Id " required="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="user_password" placeholder="Password" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>asserts/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>asserts/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>asserts/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
