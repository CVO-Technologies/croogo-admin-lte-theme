<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb($this->Html->icon('home'), '/admin')
	->addCrumb(__d('croogo', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Themes'), array('plugin' => 'extensions', 'controller' => 'extensions_themes', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Upload'), '/' . $this->request->url);

$this->start('form');
echo $this->Form->create('Theme', array(
	'url'  => array(
		'plugin'     => 'extensions',
		'controller' => 'extensions_themes',
		'action'     => 'add',
	),
	'type' => 'file',
));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Upload'), '#themes-upload');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox('Publishing') .
	$this->Form->button(__d('croogo', 'Upload'), array('button' => 'default')) .
	$this->Form->end() .
	$this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
	$this->Html->endBox();
$this->end();
?>
<div id="themes-upload" class="tab-pane">
	<?php
	echo $this->Form->input('Theme.file', array(
		'type' => 'file', 'button' => 'default',
	));
	?>
</div>
