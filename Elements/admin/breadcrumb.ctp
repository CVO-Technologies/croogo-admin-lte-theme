<?php
$crumbs = $this->Html->getCrumbList(array(
	'escape' => false,
	'class' => 'breadcrumb'
));

if ($crumbs):
	echo $crumbs;
endif;
