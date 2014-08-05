<?php
$comments = $this->requestAction(
	array(
		'plugin'     => 'comments',
		'controller' => 'comments',
		'action'     => 'index',
		'admin'      => true
	),
	array(
		'?' => array('status' => 0)
	)
);

$amount = count($comments);
?>
<li class="dropdown messages-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-comment"></i>
		<?php if ($amount > 0): ?>
			<span class="label label-success"><?php echo $amount; ?></span>
		<?php endif; ?>
	</a>
	<ul class="dropdown-menu">
		<li class="header"><?php echo h(__dn('admin_lte', 'There is one new comment', 'There are %d new comments', $amount, $amount)); ?></li>
		<li>
			<!-- inner menu: contains the actual data -->
			<ul class="menu">
				<?php
				foreach ($comments as $comment):
				?>
				<li><!-- start message -->
					<a href="<?php echo Router::url(array('plugin' => 'comments', 'controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'])); ?>">
						<div class="pull-left">
							<?php echo $this->Html->image('http://www.gravatar.com/avatar/' . md5(strtolower($comment['Comment']['email'])) . '?s=32', array('class' => 'img-circle')); ?>
						</div>
						<h4>
							<?php echo h($comment['Comment']['name']); ?>
							<small><i class="fa fa-clock-o"></i> <?php echo h($this->Time->timeAgoInWords($comment['Comment']['created'])); ?></small>
						</h4>
						<p><?php echo h($comment['Comment']['body']); ?></p>
					</a>
				</li><!-- end message -->
				<?php
				endforeach;
				?>
			</ul>
		</li>
		<li class="footer"><?php echo $this->Html->link(__d('admin_lte', 'View all comments'), array('plugin' => 'comments', 'controller' => 'comments')); ?></li>
	</ul>
</li>