<?php

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

Configure::write('debug', 0);
echo $this->Meta->field();
