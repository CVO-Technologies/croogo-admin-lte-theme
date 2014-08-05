<?php
if (empty($class)):
	$class = '';
endif;

switch ($class):
	case 'error':
		$type = 'danger';
		$icon = 'ban';
		break;
	case 'success':
		$type = 'success';
		$icon = 'check';
		break;
	default:
		$type = 'info';
		$icon = 'info';
endswitch;
?>
<div class="alert alert-<?php echo h($type); ?> alert-dismissable">
	<i class="fa fa-<?php echo h($icon); ?>"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<b><?php echo h(__d('admin_lte', 'Alert!')); ?></b> <?php echo h($message); ?>
</div>