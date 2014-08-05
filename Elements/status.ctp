<?php

echo $this->Form->input('status', array(
	'type'    => 'radio',
	'legend'  => false,
	'default' => CroogoStatus::UNPUBLISHED,
	'options' => $this->Croogo->statuses(),
));