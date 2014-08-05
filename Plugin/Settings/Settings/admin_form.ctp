<?php
$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('croogo', 'Settings'), array(
		'admin'      => true,
		'plugin'     => 'settings',
		'controller' => 'settings',
		'action'     => 'index',
	));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Setting']['key'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Setting', array(
	'class' => 'protected-form',
));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Settings'), '#setting-basic');
echo $this->Croogo->adminTab(__d('croogo', 'Misc'), '#setting-misc');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->element('save-buttons', array('apply' => false)) .
	$this->Html->endBox();
$this->end();
?>

<div id="setting-basic" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('key', array(
		'help'  => __d('croogo', "e.g., 'Site.title'"),
		'label' => __d('croogo', 'Key'),
	));
	echo $this->Form->input('value', array(
		'label' => __d('croogo', 'Value'),
	));
	?>
</div>

<div id="setting-misc" class="tab-pane">
	<?php
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('description', array(
		'label' => __d('croogo', 'Description'),
	));
	echo $this->Form->input('input_type', array(
		'label' => __d('croogo', 'Input Type'),
		'help'  => __d('croogo', "e.g., 'text' or 'textarea'"),
	));
	echo $this->Form->input('editable', array(
		'label' => __d('croogo', 'Editable'),
	));
	echo $this->Form->input('params', array(
		'label' => __d('croogo', 'Params'),
	));
	?>
</div>
