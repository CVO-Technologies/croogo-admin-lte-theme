<?php
$messages = $this->Session->read('Message');
$output = '';
if (is_array($messages)):
	foreach (array_keys($messages) as $key):
		$output .= $this->Session->flash($key, array(
			'element' => 'flash'
		));
	endforeach;
endif;

if (!trim($output)) {
	return;
}

echo $output;
