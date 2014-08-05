<div class="form-box" id="login-box">
	<div class="header"><?php echo $title_for_layout; ?></div>
	<?php
	echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));

	$this->Form->inputDefaults(array(
		'label' => false,
		'class' => 'form-control',
		'div'   => 'form-group',
	));
	?>
	<div class="body bg-gray">
		<?php
		echo $this->element('flash-messages');
		echo $this->Form->input('username', array(
			'placeholder' => __d('croogo', 'Username'),
		));
		echo $this->Form->input('password', array(
			'placeholder' => __d('croogo', 'Password'),
		));
		if (Configure::read('Access Control.autoLoginDuration')):
			echo $this->Form->input('remember', array(
				//'label'   => __d('croogo', 'Remember me?'),
				'type'    => 'checkbox',
				'default' => false,
				'class'   => null,
				'after'   => ' ' . __d('croogo', 'Remember me?')
			));
		endif;
		?>
	</div>
	<div class="footer">
		<?php
		echo $this->Form->button(__d('croogo', 'Log In'), array(
			'class' => 'btn bg-olive btn-block'
		));
		?>
		<p>
			<?php
			echo $this->Html->link(__d('croogo', 'Forgot password?'), array(
				'admin'      => false,
				'controller' => 'users',
				'action'     => 'forgot',
			));
			?>
		</p>
	</div>
	<?php echo $this->Form->end(); ?>
</div>