<?php

$this->extend('/Common/lte_edit');

$this->Html->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Content'), array('plugin' => 'nodes', 'controller' => 'nodes', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Types'), array('plugin' => 'taxonomy', 'controller' => 'types', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Type']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Type');
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Type'), '#type-main');
echo $this->Croogo->adminTab(__d('croogo', 'Taxonomy'), '#type-taxonomy');
echo $this->Croogo->adminTab(__d('croogo', 'Comments'), '#type-comments');
echo $this->Croogo->adminTab(__d('croogo', 'Params'), '#type-params');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->element('save-buttons') .
	$this->Form->input('format_show_author', array(
		'label' => __d('croogo', 'Show author\'s name'),
	)) .
	$this->Form->input('format_show_date', array(
		'label' => __d('croogo', 'Show date'),
	)) .
	$this->Html->endBox();
$this->end();
?>
<div id="type-main" class="tab-pane">
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

<div id="type-taxonomy" class="tab-pane">
	<?php
	echo $this->Form->input('Vocabulary.Vocabulary');
	?>
</div>

<div id="type-comments" class="tab-pane">
	<?php
	echo $this->Form->input('comment_status', array(
		'type'    => 'radio',
		'options' => array(
			'0' => __d('croogo', 'Disabled'),
			'1' => __d('croogo', 'Read only'),
			'2' => __d('croogo', 'Read/Write'),
		),
		'default' => 2,
		'legend'  => false,
		'label'   => true
	));
	echo $this->Form->input('comment_approve', array(
		'label' => __d('croogo', 'Auto approve comments')
	));
	echo $this->Form->input('comment_spam_protection', array(
		'label' => __d('croogo', 'Spam protection (requires Akismet API key)')
	));
	echo $this->Form->input('comment_captcha', array(
		'label' => __d('croogo', 'Use captcha? (requires Recaptcha API key)')
	));
	echo $this->Html->link(__d('croogo', 'You can manage your API keys here.'), array(
		'plugin'     => 'settings',
		'controller' => 'settings',
		'action'     => 'prefix',
		'Service'
	));
	?>
</div>

<div id="type-params" class="tab-pane">
	<?php
	echo $this->Form->input('Type.params', array(
		'label' => __d('croogo', 'Params'),
	));
	?>
</div>
