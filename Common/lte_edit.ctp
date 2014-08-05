<?php
$this->extend('/Common/admin_edit');

echo $this->fetch('form');
?>
<div class="row">
	<div class="col-lg-8">
		<div class="nav-tabs-custom">

			<ul class="nav nav-tabs">
				<?php
				echo $this->fetch('tabs');
				echo $this->Croogo->adminTabs();
				?>
			</ul>

			<div class="tab-content">
				<?php
				echo $this->fetch('content');
				echo $this->Croogo->adminTabs();
				?>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<?php
		echo $this->fetch('sidebar');
		echo $this->Croogo->adminBoxes();
		?>
	</div>
</div>
<?php
echo $this->Form->end();

echo $this->fetch('modal');
