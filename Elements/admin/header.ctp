<?php

$dashboardUrl = Configure::read('Croogo.dashboardUrl');

?>
<!-- header logo: style can be found in header.less -->
<header class="header">
<?php echo $this->Html->link(Configure::read('Site.title'), $dashboardUrl, array('class' => 'logo')); ?>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>

<div class="navbar-right">
<ul class="nav navbar-nav">
<?php echo $this->element('admin/data/comments'); ?>
<!-- User Account: style can be found in dropdown.less -->
<?php
$user = $this->Session->read('Auth.User');
?>
<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="glyphicon glyphicon-user"></i>
		<span><?php echo h($user['name']); ?> <i class="caret"></i></span>
	</a>
	<ul class="dropdown-menu">
		<!-- User image -->
		<li class="user-header bg-light-blue">
			<img src="http://www.gravatar.com/avatar/'<?php echo md5($user['email']); ?>" class="img-circle" alt="User Image"/>

			<p>
				<?php echo h($user['name']); ?>
				<small>Member since Nov. 2012</small>
			</p>
		</li>
		<!-- Menu Body -->
		<li class="user-body">
			<div class="col-xs-4 text-center">
				<a href="#">Followers</a>
			</div>
			<div class="col-xs-4 text-center">
				<a href="#">Sales</a>
			</div>
			<div class="col-xs-4 text-center">
				<a href="#">Friends</a>
			</div>
		</li>
		<!-- Menu Footer-->
		<li class="user-footer">
			<?php echo $this->Custom->buttonMenu(CroogoNav::items('top-right'), array(
			)); ?>
		</li>
	</ul>
</li>
</ul>
</div>
</nav>
</header>'