<?php
$this->extend('/Common/lte_edit');

$this->Html->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Settings'), array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'index'))
	->addCrumb($prefix, '/' . $this->request->url);

$this->start('form');
echo $this->Form->create('Setting', array(
	'url'   => array(
		'controller' => 'settings',
		'action'     => 'prefix',
		$prefix,
	),
	'class' => 'protected-form',
));
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab($prefix, '#settings-main');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Saving')) .
	$this->element('save-buttons', array('apply' => false)) .
	$this->Html->endBox();
$this->end();
?>
<div id="settings-main" class="tab-pane">
	<?php
	$i = 0;
	foreach ($settings as $setting) :
		if (!empty($setting['Params']['tab'])) {
			continue;
		}
		$keyE = explode('.', $setting['Setting']['key']);
		$keyTitle = Inflector::humanize($keyE['1']);

		$label = ($setting['Setting']['title'] != null) ? $setting['Setting']['title'] : $keyTitle;

		$i = $setting['Setting']['id'];
		echo
			$this->Form->input("Setting.$i.id", array(
				'value' => $setting['Setting']['id'],
			)) .
			$this->Form->input("Setting.$i.key", array(
				'type' => 'hidden', 'value' => $setting['Setting']['key']
			)) .
			$this->SettingsForm->input($setting, $label, $i);
		$i++;
	endforeach;
	?>
</div>
