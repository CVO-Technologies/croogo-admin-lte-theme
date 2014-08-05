<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Contacts'), array('plugin' => 'contacts', 'controller' => 'contacts', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Messages'), array('plugin' => 'contacts', 'controller' => 'messages', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->data['Message']['id'] . ': ' . $this->data['Message']['title'], '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Message');
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Message'), '#message-main');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing'));
echo $this->element('save-buttons', array('apply' => false));
echo $this->Html->endBox();
$this->end();
?>

<div id="message-main">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('name', array(
		'label' => __d('croogo', 'Name'),
	));
	echo $this->Form->input('email', array(
		'label' => __d('croogo', 'Email'),
	));
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('body', array(
		'label' => __d('croogo', 'Body'),
	));
	echo $this->Form->input('phone', array(
		'label' => __d('croogo', 'Phone'),
	));
	echo $this->Form->input('address', array(
		'label' => __d('croogo', 'Address'),
	));
	?>
</div>
