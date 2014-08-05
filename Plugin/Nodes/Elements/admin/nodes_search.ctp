<?php
$url = isset($url) ? $url : array('action' => 'index');
?>
<div class="row">
	<div class="col-lg-12">
		<div class="clearfix filter">
			<?php
			echo $this->Form->create('Node', array(
				'class' => 'inline',
				'url' => $url,
			));

			$this->Form->inputDefaults(array(
				'label' => false,
				'class' => 'col-lg-11 form-control',
				'div'   => 'form-group',
			));

			echo $this->Form->input('chooser', array(
				'type' => 'hidden',
				'value' => isset($this->request->query['chooser']),
			));

			echo $this->Form->input('filter', array(
				'title' => __d('croogo', 'Search'),
				'placeholder' => __d('croogo', 'Search...'),
				'div' => 'input text col-lg-3 form-group',
				'tooltip' => false,
			));

			if(!isset($this->request->query['chooser'])){

				echo $this->Form->input('type', array(
					'options' => $nodeTypes,
					'empty' => __d('croogo', 'Type'),
					'div' => 'input select col-lg-2  form-group',
				));

				echo $this->Form->input('status', array(
					'options' => array(
						'1' => __d('croogo', 'Published'),
						'0' => __d('croogo', 'Unpublished'),
					),
					'empty' => __d('croogo', 'Status'),
					'div' => 'input select col-lg-2 form-group',
				));

				echo $this->Form->input('promote', array(
					'options' => array(
						'1' => __d('croogo', 'Yes'),
						'0' => __d('croogo', 'No'),
					),
					'empty' => __d('croogo', 'Promoted'),
					'div' => 'input select col-lg-2 form-group',
				));

			}

			echo $this->Form->submit(__d('croogo', 'Filter'), array('class' => 'btn',
				'div' => 'input submit col-lg-2 form-group'
			));
			echo $this->Form->end();
			?>
		</div>
	</div>
</div>
