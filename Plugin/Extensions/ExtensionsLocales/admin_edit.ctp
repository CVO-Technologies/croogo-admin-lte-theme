<?php
$this->extend('/Common/lte_edit');
$this->set('className', 'extensions-locales');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Extensions'), array('plugin' => 'extensions', 'controller' => 'extensions_plugins', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Locales'), array('plugin' => 'extensions', 'controller' => 'extensions_locales', 'action' => 'index'))
	->addCrumb($this->request->params['pass'][0], '/' . $this->request->url);

$this->start('form');
echo $this->Form->create('Locale', array(
	'url' => array(
		'plugin'     => 'extensions',
		'controller' => 'extensions_locales',
		'action'     => 'edit',
		$locale
	),
));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Content'), '#locale-content');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Actions')) .
	$this->Form->button(__d('croogo', 'Save'), array('button' => 'primary')) .
	$this->Html->link(__d('croogo', 'Cancel'),
		array('action' => 'index'),
		array('button' => 'danger')
	) .
	$this->Html->endBox();
$this->end();
?>
<div class="locale-content" class="tab-pane">
	<?php
	echo $this->Form->input('Locale.content', array(
		'label'          => __d('croogo', 'Content'),
		'data-placement' => 'top',
		'value'          => $content,
		'type'           => 'textarea',
	));
	?>
</div>
