<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Settings'), array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix', 'Site'))
	->addCrumb(__d('croogo', 'Language'), array('plugin' => 'settings', 'controller' => 'languages', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Language']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Language');
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Language'), '#language-main');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->Form->button(__d('croogo', 'Save'), array('button' => 'default')) .
	$this->Html->link(
		__d('croogo', 'Cancel'),
		array('action' => 'index'),
		array('class' => 'cancel', 'button' => 'danger')
	) .
	$this->Form->input('status', array('class' => false)) .
	$this->Html->endBox();
$this->end();
?>
<div id="language-main" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('native', array(
		'label' => __d('croogo', 'Native'),
	));
	echo $this->Form->input('alias', array(
		'label' => __d('croogo', 'Alias'),
	));
	?>
</div>
