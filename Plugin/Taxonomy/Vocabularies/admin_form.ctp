<?php
$this->Html->script(array('/taxonomy/js/vocabularies'), false);
$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html
		->addCrumb(__d('croogo', 'Vocabularies'), array('plugin' => 'taxonomy', 'controller' => 'vocabularies', 'action' => 'index', $this->request->data['Vocabulary']['id']))
		->addCrumb($this->request->data['Vocabulary']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html
		->addCrumb(__d('croogo', 'Vocabularies'), array('plugin' => 'taxonomy', 'controller' => 'vocabularies', 'action' => 'index'))
		->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Vocabulary');
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Vocabulary'), '#vocabulary-basic');
echo $this->Croogo->adminTab(__d('croogo', 'Options'), '#vocabulary-options');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->element('save-buttons') .
	$this->Html->endBox();
$this->end();
?>
<div id="vocabulary-basic" class="tab-pane">
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
	echo $this->Form->input('Type.Type', array(
		'label' => __d('croogo', 'Type'),
	));
	?>
</div>

<div id="vocabulary-options" class="tab-pane">
	<?php
	echo $this->Form->input('required', array(
		'label' => __d('croogo', 'Required'),
	));
	echo $this->Form->input('multiple', array(
		'label' => __d('croogo', 'Multiple'),
	));
	echo $this->Form->input('tags', array(
		'label' => __d('croogo', 'Tags'),
	));
	?>
</div>
