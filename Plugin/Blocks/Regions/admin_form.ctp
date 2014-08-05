<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Blocks'), array(
		'plugin' => 'blocks', 'controller' => 'blocks', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Regions'), array(
		'plugin' => 'blocks', 'controller' => 'regions', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Region']['title'], array(
		'plugin' => 'blocks', 'controller' => 'regions', 'action' => 'edit',
		$this->request->params['pass'][0]
	));
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Region');
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Region'), '#region-main');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply')) .
	$this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) .
	$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
	$this->Html->endBox();
$this->end();
?>
<div id="region-main" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('alias', array(
		'label' => __d('croogo', 'Alias'),
	));
	?>
</div>
