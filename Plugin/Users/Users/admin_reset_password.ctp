<?php
$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('croogo', 'Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'))
	->addCrumb($this->request->data['User']['name'], array(
		'action' => 'edit', $this->request->data['User']['id'],
	))
	->addCrumb(__d('croogo', 'Reset Password'), '/' . $this->request->url);

$this->set('title_for_layout', __d('croogo', 'Reset Password for %s', $this->data['User']['username']));

$this->start('form');
echo $this->Form->create('User', array('url' => array('action' => 'reset_password')));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Reset Password'), '#reset-password');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->Form->button(__d('croogo', 'Reset'), array('button' => 'default')) .
	$this->Html->link(
		__d('croogo', 'Cancel'),
		array('action' => 'index'),
		array('button' => 'primary')) .
	$this->Html->endBox();
$this->end();
?>
<div id="reset-password" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('password', array('label' => __d('croogo', 'New Password'), 'value' => ''));
	echo $this->Form->input('verify_password', array('label' => __d('croogo', 'Verify Password'), 'type' => 'password', 'value' => ''));
	?>
</div>