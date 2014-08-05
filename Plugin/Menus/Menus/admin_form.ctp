<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Menus'), array('plugin' => 'menus', 'controller' => 'menus', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Menu']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Menu');
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Menu'), '#menu-basic');
echo $this->Croogo->adminTab(__d('croogo', 'Misc.'), '#menu-misc');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox('Publishing') .
	$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply')) .
	$this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) .
	$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
	$this->Form->input('status', array(
		'type'    => 'radio',
		'legend'  => false,
		'class'   => false,
		'default' => CroogoStatus::UNPUBLISHED,
		'options' => $this->Croogo->statuses(),
	)) .
	$this->Html->div('input-daterange',
		$this->Form->input('publish_start', array(
			'label' => __d('croogo', 'Publish Start'),
			'type'  => 'text',
		)) .
		$this->Form->input('publish_end', array(
			'label' => __d('croogo', 'Publish End'),
			'type'  => 'text',
		))
	) .
	$this->Html->endBox();
$this->end();
?>
<div id="menu-basic" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('alias', array(
		'label' => __d('croogo', 'Alias'),
	));
	echo $this->Form->input('description', array(
		'label' => __d('croogo', 'Description'),
	));
	?>
</div>

<div id="menu-misc" class="tab-pane">
	<?php
	echo $this->Form->input('params', array(
		'label' => __d('croogo', 'Params'),
	));
	?>
</div>
