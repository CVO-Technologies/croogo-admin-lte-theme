<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Attachments'), array('plugin' => 'file_manager', 'controller' => 'attachments', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Upload'), '/' . $this->request->url);

$formUrl = array('controller' => 'attachments', 'action' => 'add');
if (isset($this->request->params['named']['editor'])) {
	$formUrl['editor'] = 1;
}

$this->start('form');
echo $this->Form->create('Attachment', array('url' => $formUrl, 'type' => 'file'));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Upload'), '#attachment-upload');
$this->end();

$this->start('sidebar');
$redirect = array('action' => 'index');
if ($this->Session->check('Wysiwyg.redirect')) {
	$redirect = $this->Session->read('Wysiwyg.redirect');
}
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->Form->button(__d('croogo', 'Upload'), array('button' => 'default')) .
	$this->Form->end() .
	$this->Html->link(__d('croogo', 'Cancel'), $redirect, array('button' => 'danger')) .
	$this->Html->endBox();
$this->end();
?>
<div id="attachment-upload" class="tab-pane">
	<?php
	echo $this->Form->input('file', array('label' => __d('croogo', 'Upload'), 'type' => 'file'));
	?>
</div>
