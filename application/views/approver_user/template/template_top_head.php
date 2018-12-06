<?php 
$created_session_id=$this->session->userdata('session_id');
if(empty($created_session_id)){
	
	redirect('approve-logout-by-pass');
}
?>
<style type="text/css">
	.page-sidebar-toggled.page-sidebar-minified .sidebar.sidebar-transparent,.sidebar-bg,
.sidebar.sidebar-transparent,.sidebar-bg {
    background: linear-gradient(rgba(185, 59, 38, 0.81), rgba(6, 132, 16, 0.63)), url(<?=base_url()?>file_css_admin/assets/css/default/images/cover-sidebar.jpg);
    background-size: cover
}
</style>
<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="user-approver-home" class="navbar-brand"><span class="navbar-logo rounded-circle" style="background: url(<?=base_url()?>file_css_admin/assets/img/logo/logo-admin.png) no-repeat;width: 48px; background-size: cover; height: 40px; margin-top: -6px ;"></span> <b>Ilab</b> Admin</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">				
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?=base_url()?>file_css_admin/assets/img/user/user-13.jpg" alt="" /> 
						<span class="d-none d-md-inline"><?=$this->session->userdata('Username');?></span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="javascript:;" class="dropdown-item">Edit Profile</a>
						<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
						<a href="javascript:;" class="dropdown-item">Calendar</a>
						<a href="javascript:;" class="dropdown-item">Setting</a>
						<div class="dropdown-divider"></div> -->
						<a href="<?=base_url()?>design-logout" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end #header -->
		