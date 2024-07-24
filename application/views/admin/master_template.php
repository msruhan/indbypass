<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo $this->config->item('assets_url');?>css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="//cdn.datatables.net/select/1.2.5/css/select.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->config->item('assets_url');?>plugins/select2/select2.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->
<!-- <link rel="shortcut icon" href="favicon.ico"/> -->
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>js/jquery.cookie.js"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<!-- END JAVASCRIPTS -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
          <!--  <a href="<?php echo site_url(); ?>">
                <img src="<?php echo $this->config->item('assets_url');?>img/fsd-solutions-logo.png" alt="logo"/>
            </a>-->
        </div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="<?php echo $this->config->item('assets_url');?>img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<li class="devider">
				 &nbsp;
			</li>
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="<?php echo $this->config->item('assets_url');?>img/users/administrator-icon.png"/>
				<span class="username username-hide-on-mobile"><?php echo $this->session->userdata('full_name'); ?> </span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo site_url('admin/employee/profile'); ?>"><i class="fa fa-user"></i> My Profile</a>
					</li>
					<li>
						<a href="<?php echo site_url('admin/setting'); ?>"><i class="fa fa-gear"></i> Settings</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="<?php echo site_url('admin/session/logout'); ?>"><i class="fa fa-key"></i> Log Out</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<div class="clearfix">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="start <?php echo($this->uri->segment(2)==''?'active"':''); ?>">
					<a href="<?php echo site_url("admin"); ?>">
						<i class="icon-home"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
					</a>
				</li>
				<li <?php echo( in_array($this->uri->segment(2), ['apimanager','brand','servicemodel'])?'class="active"':''); ?>>
					<a href="javascript:;">
						<i class="fa fa-jsfiddle"></i>
						<span class="title">Api Manager</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php echo($this->uri->segment(2)=='apimanager'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/apimanager"); ?>">
							<i class="fa fa-rss"></i>
                            Api Manager</a>
						</li>
						<li <?php echo($this->uri->segment(2)=='brand'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/brand"); ?>">
							<i class="fa fa-mobile"></i>
                            Mobile Brands</a>
						</li>
                        <li <?php echo($this->uri->segment(2)=='servicemodel'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/servicemodel"); ?>">
							<i class="fa fa-codepen"></i>
                            Brand Models</a>
						</li>
					</ul>
				</li>
                <li <?php echo( in_array($this->uri->segment(2), ['network','method','imeiorder'])?'class="active"':''); ?>>
					<a href="javascript:;">
						<i class="icon-share"></i>
						<span class="title">IMEI Service</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php echo($this->uri->segment(2)=='network'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/network"); ?>">
							<i class="icon-shuffle"></i>
                            Service Groups</a>
						</li>
						<li <?php echo($this->uri->segment(2)=='method'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/method"); ?>">
							<i class="icon-target"></i>
                            Services</a>
						</li>
                        <li <?php echo($this->uri->segment(2)=='imeiorder'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/imeiorder"); ?>">
							<i class="icon-basket"></i>
                            Orders</a>
						</li>
					</ul>
				</li>
                <li <?php echo( in_array($this->uri->segment(2), ['fileservices','fileorder'])?'class="active"':''); ?>>
					<a href="javascript:;">
						<i class="icon-docs"></i>
						<span class="title">File Service</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php echo($this->uri->segment(2)=='fileservices'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/fileservices"); ?>">
							<i class="icon-doc"></i>
                            File Services</a>
						</li>
						<li <?php echo($this->uri->segment(2)=='fileorder'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/fileorder"); ?>">
							<i class="icon-cloud-upload"></i>
                            File Service Orders</a>
						</li>
					</ul>
				</li>
				<li <?php echo( in_array($this->uri->segment(2), ['serverbox','serverservice','serverorder'])?'class="active"':''); ?>>
					<a href="javascript:;">
						<i class="icon-screen-desktop"></i>
						<span class="title">Server Service</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php echo($this->uri->segment(2)=='serverbox'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/serverbox"); ?>">
							<i class="icon-shuffle"></i>
                            Boxes / Tools</a>
						</li>
						<li <?php echo($this->uri->segment(2)=='serverservice'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/serverservice"); ?>">
							<i class="icon-target"></i>
                            Services</a>
						</li>
						<li <?php echo($this->uri->segment(2)=='serverorder'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/serverorder"); ?>">
							<i class="icon-basket"></i>
                            Orders</a>
						</li>
					</ul>
				</li>
                <li <?php echo( in_array($this->uri->segment(2), ['group','member'])?'class="active"':''); ?>>
					<a href="javascript:;">
						<i class="icon-users"></i>
						<span class="title">Members & Groups</span>
                        <span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php echo($this->uri->segment(2)=='group'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/group"); ?>">
							<i class="icon-user-following"></i>
                            Groups</a>
						</li>
						<li <?php echo($this->uri->segment(2)=='member'?'class="active"':''); ?>>
                        	<a href="<?php echo site_url("admin/member"); ?>">
							<i class="fa fa-users"></i>
                            Members</a>
						</li>
					</ul>
				</li>
                <li <?php echo($this->uri->segment(2)=='employee'?'class="active"':''); ?>>
					<a href="<?php echo site_url("admin/employee"); ?>">
						<i class="icon-key"></i>
						<span class="title">Employees Access</span>
					</a>
				</li>
                <li <?php echo($this->uri->segment(2)=='credit'?'class="active"':''); ?>>
					<a href="<?php echo site_url("admin/credit"); ?>">
						<i class="icon-calendar"></i>
						<span class="title">Credits Management</span>
					</a>
				</li>
                <li <?php echo($this->uri->segment(2)=='payment'?'class="active"':''); ?>>
					<a href="<?php echo site_url("admin/payment"); ?>">
						<i class="fa fa-money"></i>
						<span class="title">Payment Methods</span>
					</a>
				</li>
                <li <?php echo($this->uri->segment(2)=='autoresponder'?'class="active"':''); ?>>
					<a href="<?php echo site_url("admin/autoresponder"); ?>">
						<i class="icon-envelope"></i>
						<span class="title">Email Templates</span>
					</a>
				</li>
				<li <?php echo($this->uri->segment(2)=='setting'?'class="active"':''); ?>>
					<a href="<?php echo site_url("admin/setting"); ?>">
						<i class="icon-settings"></i>
						<span class="title">Settings</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
        	<h3 class="page-title">
			<?php echo $this->module_name ?> 
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo site_url() ?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN OVERVIEW STATISTIC BARS-->
			<?php $this->load->view('admin/includes/message'); ?>
			<?php $this->load->view($template); ?>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 2018 &copy; developed by Exclusiveunlock.
	</div>
	<div class="footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<?php if( FALSE === $this->uri->segment(2) ): ?> 
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery.peity.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo $this->config->item('assets_url');?>plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo $this->config->item('assets_url');?>scripts/index.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<?php endif ?>
<script src="<?php echo $this->config->item('assets_url');?>plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>scripts/app.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
<?php if( FALSE === $this->uri->segment(2) ): ?> 
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initPeityElements();
   Index.initKnowElements();
   Index.initDashboardDaterange();
   Tasks.initDashboardWidget();
<?php endif ?>
});
</script>
</body>
<!-- END BODY -->
</html>