<?php
if (!isset($cancelUrl)):
	$cancelUrl = array('action' => 'index');
endif;
if (!isset($apply)):
	$apply = true;
endif;
?>
<div class="btn-toolbar" role="toolbar">
	<div class="btn-group">
		<?php
		if ($apply):
			echo $this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply'));
		endif;
		echo $this->Form->button(__d('croogo', 'Save'), array('button' => 'success'));
		?>
	</div>
	<div class="btn-group"><?php echo $this->Html->link(__d('croogo', 'Cancel'), $cancelUrl, array('class' => 'cancel btn btn-danger')); ?></div>
</div>