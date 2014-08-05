<?php
if (empty($modelClass)) {
	$modelClass = Inflector::singularize($this->name);
}
if (!isset($className)) {
	$className = strtolower($this->name);
}
if (!empty($searchFields)):
	?>
	<div class="panel box box-default">
		<div class="box-header">
			<h4 class="box-title">
				<a data-toggle="collapse" href="#collapseOne" class="collapsed"><?php echo h(__d('croogo', 'Filter')); ?></a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse">
			<div class="box-body">
				<div class="<?php echo $className; ?> filter">
					<?php
					echo $this->Form->create($modelClass, array(
						'novalidate' => true,
						'url'        => array(
							'plugin'     => $this->request->params['plugin'],
							'controller' => $this->request->params['controller'],
							'action'     => $this->request->params['action'],
						),
					));
					$this->Form->inputDefaults(array(
						'class' => 'form-control',
						'div'   => 'form-group'
					));
					echo $this->Form->input('chooser', array(
						'type'  => 'hidden',
						'value' => isset($this->request->query['chooser']),
					));
					foreach ($searchFields as $field => $fieldOptions) {
						$options = array('empty' => '', 'required' => false);
						if (is_numeric($field) && is_string($fieldOptions)) {
							$field = $fieldOptions;
							$fieldOptions = array();
						}
						if (!empty($fieldOptions)) {
							$options = Hash::merge($fieldOptions, $options);
						}
						$this->Form->unlockField($field);
						echo $this->Form->input($field, $options);
					}

					echo $this->Form->submit(__d('croogo', 'Filter'));
					echo $this->Form->end();
					?>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>
