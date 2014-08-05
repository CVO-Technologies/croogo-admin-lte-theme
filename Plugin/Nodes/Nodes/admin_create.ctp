<?php
$this->Html->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Content'), array('controller' => 'nodes', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Create'), '/' . $this->request->url);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-body">
				<?php foreach ($types as $type): ?>
					<?php
						if (!empty($type['Type']['plugin'])):
							continue;
						endif;
					?>
					<div class="type">
						<h3><?php echo $this->Html->link($type['Type']['title'], array('action' => 'add', $type['Type']['alias'])); ?></h3>
						<p><?php echo $type['Type']['description']; ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
