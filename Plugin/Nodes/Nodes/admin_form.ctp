<?php

$this->extend('/Common/lte_edit');
$this->Html->script(array('Nodes.admin'), false);

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Content'), array('controller' => 'nodes', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_add') {
	$formUrl = array('action' => 'add', $typeAlias);
	$this->Html
		->addCrumb(__d('croogo', 'Create'), array('controller' => 'nodes', 'action' => 'create'))
		->addCrumb($type['Type']['title'], '/' . $this->request->url);
}

if ($this->request->params['action'] == 'admin_edit') {
	$formUrl = array('action' => 'edit');
	$this->Html->addCrumb($this->request->data['Node']['title'], '/' . $this->request->url);
}

$lookupUrl = $this->Html->apiUrl(array(
	'plugin'     => 'users',
	'controller' => 'users',
	'action'     => 'lookup',
));

$parentTitle = isset($parentTitle) ? $parentTitle : null;
$apiUrl = $this->Form->apiUrl(array(
	'controller' => 'nodes',
	'action'     => 'lookup',
	'?'          => array(
		'type' => $type['Type']['alias'],
	),
));

$username = isset($this->data['User']['username']) ?
	$this->data['User']['username'] :
	$this->Session->read('Auth.User.username');

$this->start('form');
echo $this->Form->create('Node', array(
	'url'   => $formUrl,
	'class' => 'protected-form',
));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', $type['Type']['title']), '#node-main');
echo $this->Croogo->adminTab(__d('croogo', 'Access'), '#node-access');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing'));
echo $this->element('save-buttons');
echo $this->element('status') .
	$this->Form->input('promote', array(
		'label' => __d('croogo', 'Promoted to front page'),
	)) .
	$this->Form->autocomplete('user_id', array(
		'type'         => 'text',
		'label'        => __d('croogo', 'Publish as '),
		'autocomplete' => array(
			'default'             => $username,
			'data-displayField'   => 'username',
			'data-primaryKey'     => 'id',
			'data-queryField'     => 'name',
			'data-relatedElement' => '#NodeUserId',
			'data-url'            => $lookupUrl,
		),
		'class'        => 'form-control'
	)) .

	$this->Form->input('created', array(
		'type' => 'text',
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
	);
echo $this->Html->endBox();
$this->end();
?>
<div id="node-main" class="tab-pane">
	<?php
	echo $this->Form->autocomplete('parent_id', array(
		'label'        => __d('croogo', 'Parent'),
		'type'         => 'text',
		'autocomplete' => array(
			'default'             => $parentTitle,
			'data-displayField'   => 'title',
			'data-primaryKey'     => 'id',
			'data-queryField'     => 'title',
			'data-relatedElement' => '#NodeParentId',
			'data-url'            => $apiUrl,
		),
		'class'        => 'form-control'
	));
	echo $this->Form->input('id');
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('slug', array(
		'label' => __d('croogo', 'Slug'),
	));
	echo $this->Form->input('excerpt', array(
		'label' => __d('croogo', 'Excerpt'),
	));
	echo $this->Form->input('body', array(
		'label' => __d('croogo', 'Body'),
	));
	?>
</div>

<div id="node-access" class="tab-pane">
	<?php
	echo $this->Form->input('Role.Role', array(
		'label' => __d('croogo', 'Role'),
	));
	?>
</div>
