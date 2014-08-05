<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title><?php echo $title_for_layout; ?> - <?php echo __d('croogo', 'Croogo'); ?></title>
		<?php
		echo $this->Html->css(array(
			'bootstrap.min',
			'font-awesome.min',
			'AdminLTE'
		));
		echo $this->Layout->js();
		echo $this->Html->script(array(
			'jquery.min',
		));

		echo $this->fetch('script');
		echo $this->fetch('css');
		?>
	</head>
	<body class="bg-black">
		<?php
		echo $this->fetch('content');
		?>
	</body>
</html>
