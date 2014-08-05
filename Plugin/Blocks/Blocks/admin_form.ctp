<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('croogo', 'Blocks'), array('plugin' => 'blocks', 'controller' => 'blocks', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Block']['title'], '/' . $this->request->url);
}
if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Block', array(
	'class' => 'protected-form',
));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Block'), '#block-basic');
echo $this->Croogo->adminTab(__d('croogo', 'Access'), '#block-access');
echo $this->Croogo->adminTab(__d('croogo', 'Visibilities'), '#block-visibilities');
echo $this->Croogo->adminTab(__d('croogo', 'Params'), '#block-params');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing'));
echo $this->element('save-buttons');
echo $this->element('status');
echo $this->Form->input('show_title', array(
	'label' => __d('croogo', 'Show title ?'),
));
echo $this->Html->div('input-daterange',
	$this->Form->input('publish_start', array(
		'label' => __d('croogo', 'Publish Start'),
		'type'  => 'text',
	)) .
	$this->Form->input('publish_end', array(
		'label' => __d('croogo', 'Publish End'),
		'type'  => 'text',
	))
);
echo $this->Html->endBox();
$this->end();
?>
<div id="block-basic" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));

	echo $this->Form->input('alias', array(
		'label' => __d('croogo', 'Alias'),
		'help'  => __d('croogo', 'unique name for your block'),
	));
	echo $this->Form->input('region_id', array(
		'label' => __d('croogo', 'Region'),
		'help'  => __d('croogo', 'if you are not sure, choose \'none\''),
	));
	echo $this->Form->input('body', array(
		'label' => __d('croogo', 'Body'),
	));
	echo $this->Form->input('class', array(
		'label' => __d('croogo', 'Class')
	));
	echo $this->Form->input('element', array(
		'label' => __d('croogo', 'Element')
	));
	?>
</div>

<div id="block-access" class="tab-pane">
	<?php echo $this->Form->input('Role.Role'); ?>
</div>

<div id="block-visibilities" class="tab-pane">
	<?php
	echo $this->Form->input('Block.visibility_paths', array(
		'label' => __d('croogo', 'Visibility Paths'),
		'help'  => __d('croogo', 'Enter one URL per line. Leave blank if you want this Block to appear in all pages.')
	));
	?>
</div>

<div id="block-params" class="tab-pane">
	<?php
	echo $this->Form->input('Block.params', array(
		'label' => __d('croogo', 'Params'),
	));
	?>
</div>
