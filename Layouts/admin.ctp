<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title><?php echo $title_for_layout; ?> - <?php echo __d('croogo', 'Croogo'); ?></title>
	<?php

	echo $this->Html->css(array(
		'old-fontawesome',
		'admin',

		'bootstrap.min',
		'font-awesome.min',
		'AdminLTE'
	));
	echo $this->Layout->js();
	echo $this->Html->script(array(
		'jquery.min',
		'/croogo/js/html5',
		'/croogo/js/jquery/jquery-ui.min',
		'/croogo/js/jquery/jquery.slug',
		'/croogo/js/jquery/jquery.cookie',
		'/croogo/js/jquery/jquery.hoverIntent.minified',
		'/croogo/js/jquery/superfish',
		'/croogo/js/jquery/supersubs',
		'/croogo/js/jquery/jquery.tipsy',
		'/croogo/js/jquery/jquery.elastic-1.6.1.js',
		'/croogo/js/jquery/thickbox-compressed',
		'/croogo/js/underscore-min',
		'/croogo/js/admin',
		'/croogo/js/choose',
		'/croogo/js/typeahead_autocomplete',

		'bootstrap.min',
		'AdminLTE/app',
	));

	echo $this->fetch('script');
	echo $this->fetch('css');

	?>
</head>
<body class="skin-blue">
<?php echo $this->element('admin/header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="left-side sidebar-offcanvas">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<?php
			$user = $this->Session->read('Auth.User');
			?>
			<div class="user-panel">
				<div class="pull-left image">
					<img src="http://www.gravatar.com/avatar/'<?php echo md5($user['email']); ?>" class="img-circle" alt="User Image"/>
				</div>
				<div class="pull-left info">
					<p><?php echo h(__d('admin_lte', 'Hello, %s', $user['name'])); ?></p>
				</div>
			</div>
			<!-- search form -->
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i
		                                class="fa fa-search"></i></button>
                            </span>
				</div>
			</form>
			<!-- /.search form -->
			<?php echo $this->element('admin/navigation'); ?>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php
				if ($titleBlock = $this->fetch('title')):
					echo $titleBlock;
				else:
					echo !empty($title_for_layout) ? $title_for_layout : $what . ' ' . $modelClass;
				endif;
				?>
				<small>Control panel</small>
			</h1>
			<?php echo $this->element('admin/breadcrumb'); ?>
		</section>

		<!-- Main content -->
		<section class="content">
			<?php
			echo $this->element('flash-messages');
			echo $this->fetch('content');
			?>
		</section>
		<!-- /.content -->
	</aside>
	<!-- /.right-side -->
</div>
<?php
//echo $this->element('admin/footer');
echo $this->Blocks->get('scriptBottom');
echo $this->Js->writeBuffer();
?>
</body>
</html>