<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Attachments'), array('plugin' => 'file_manager', 'controller' => 'attachments', 'action' => 'index'))
	->addCrumb($this->data['Attachment']['title'], '/' . $this->request->url);

$this->start('form');
echo $this->Form->create('Attachment', array('url' => array('controller' => 'attachments', 'action' => 'edit')));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Attachment'), '#attachment-main');
$this->end();

$this->start('sidebar');
$redirect = array('action' => 'index');
if ($this->Session->check('Wysiwyg.redirect')) {
	$redirect = $this->Session->read('Wysiwyg.redirect');
}
echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
	$this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply')) .
	$this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) .
	$this->Html->link(
		__d('croogo', 'Cancel'),
		$redirect,
		array('class' => 'cancel', 'button' => 'danger')
	) .
	$this->Html->endBox();
$this->end();
?>
<div id="attachment-main" class="tab-pane">
	<?php
	echo $this->Form->input('id');

	$fileType = explode('/', $this->data['Attachment']['mime_type']);
	$fileType = $fileType['0'];
	if ($fileType == 'image') {
		$imgUrl = $this->Image->resize('/uploads/' . $this->data['Attachment']['slug'], 200, 300, true, array('class' => 'img-polaroid'));
	} else {
		$imgUrl = $this->Html->image('/croogo/img/icons/' . $this->Filemanager->mimeTypeToImage($this->data['Attachment']['mime_type'])) . ' ' . $this->data['Attachment']['mime_type'];
	}
	echo $this->Html->link($imgUrl, $this->data['Attachment']['path'], array(
		'class' => 'thickbox pull-right',
	));
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('excerpt', array(
		'label' => __d('croogo', 'Caption'),
	));

	echo $this->Form->input('file_url', array(
			'label'    => __d('croogo', 'File URL'),
			'value'    => Router::url($this->data['Attachment']['path'], true),
			'readonly' => 'readonly')
	);

	echo $this->Form->input('file_type', array(
			'label'    => __d('croogo', 'Mime Type'),
			'value'    => $this->data['Attachment']['mime_type'],
			'readonly' => 'readonly')
	);

	?>
</div>