<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Login - Admin Panel</title>
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
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('assets_url');?>plugins/select2/select2.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo $this->config->item('assets_url');?>css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo $this->config->item('assets_url');?>css/pages/login.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('assets_url');?>css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<!-- <a href="index.html">
	<img src="<?php echo $this->config->item('assets_url');?>img/logo.png" alt=""/>
	</a> -->
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
    
    <?php echo form_open('admin/session/login', array('class' => 'login-form')); ?>
    <input type="hidden" name="return_url" value="<?php echo $this->input->get('return_url') ?>" />
		<h3 class="form-title">Welcome Please Sign In</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="email" name="Email" id="Email" placeholder="Email" value="<?php echo set_value('Email') ?>" autocomplete="off"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" name="Password" id="Password" placeholder="Password"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-info pull-right">
			Login </button>
		</div>
		<div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
				 no worries, click <a href="javascript:;" id="forget-password">here</a>
				to reset your password.
			</p>
		</div>
    <?php echo form_close(); ?>  
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
    <?php echo form_open('admin/session/forgot_password', array('class' => 'forget-form')) ?>
		<h3>Forget Password ?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Your email" name="Email" value="<?php echo set_value('Email') ?>"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" class="btn btn-info pull-right">
			Submit </button>
		</div>
    <?php echo form_close(); ?>  
	<!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2018 &copy; Exclusiveunlock.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo $this->config->item('assets_url');?>plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo $this->config->item('assets_url');?>scripts/app.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  App.init();
  Login.init();
  var action = location.hash.substr(1);
    if (action == 'forgetpassword')  {
        $('.register-form').hide();
        $('.login-form').hide();
        $('.forget-form').show();
    }
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>