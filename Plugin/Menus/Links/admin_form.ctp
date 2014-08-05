<?php

$this->extend('/Common/lte_edit');
$this->Html->script(array('Menus.admin'), false);

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Menus'), array('plugin' => 'menus', 'controller' => 'menus', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_add') {
	$this->Html
		->addCrumb($menus[$menuId], array(
				'plugin' => 'menus', 'controller' => 'links', 'action' => 'index',
				'?'      => array('menu_id' => $menuId))
		)
		->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
	$formUrl = array(
		'controller' => 'links', 'action' => 'add', 'menu' => $menuId
	);
}

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html
		->addCrumb($this->data['Menu']['title'], array(
			'plugin' => 'menus', 'controller' => 'links', 'action' => 'index',
			'?'      => array('menu_id' => $this->data['Menu']['id'])))
		->addCrumb($this->request->data['Link']['title'], '/' . $this->request->url);
	$formUrl = array(
		'controller' => 'links', 'action' => 'edit',
		'?'          => array(
			'menu_id' => $menuId,
		),
	);
}

$this->start('form');
echo $this->Form->create('Link', array(
	'url'   => $formUrl,
	'class' => 'protected-form',
));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$linkChooserUrl = $this->Html->url(array(
	'admin'       => true,
	'plugin'      => 'menus',
	'controllers' => 'links',
	'action'      => 'link_chooser',
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Link'), '#link-basic');
echo $this->Croogo->adminTab(__d('croogo', 'Access'), '#link-access');
echo $this->Croogo->adminTab(__d('croogo', 'Misc.'), '#link-misc');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->element('save-buttons', array('cancelUrl' => array('action' => 'index', '?' => array('menu_id' => $menuId)))) .
	$this->element('status') .
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

$this->start('modal');
echo $this->element('Croogo.admin/modal', array(
	'id'    => 'link_choosers',
	'class' => 'hide',
	'title' => __d('croogo', 'Choose Link'),
));
$this->end();
?>

<div id="link-basic" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('menu_id', array(
		'selected' => $menuId,
	));
	echo $this->Form->input('parent_id', array(
		'title'   => __d('croogo', 'Parent'),
		'options' => $parentLinks,
		'empty'   => true,
	));
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));

	echo $this->Form->input('link', array(
		'label' => __d('croogo', 'Link'),
		'after' => $this->Html->link('', '#link_choosers', array(
				'button'      => 'default',
				'icon'        => array('link'),
				'iconSize'    => 'small',
				'data-title'  => 'Link Chooser',
				'data-toggle' => 'modal',
				'data-remote' => $linkChooserUrl,
			)),
	));
	?>
</div>

<div id="link-access" class="tab-pane">
	<?php
	echo $this->Form->input('Role.Role');
	?>
</div>

<div id="link-misc" class="tab-pane">
	<?php
	echo $this->Form->input('class', array(
		'label' => __d('croogo', 'Class'),
	));
	echo $this->Form->input('description', array(
		'label' => __d('croogo', 'Description'),
	));
	echo $this->Form->input('rel', array(
		'label' => __d('croogo', 'Rel'),
	));
	echo $this->Form->input('target', array(
		'label' => __d('croogo', 'Target'),
	));
	echo $this->Form->input('params', array(
		'label' => __d('croogo', 'Params'),
	));
	?>
</div>
