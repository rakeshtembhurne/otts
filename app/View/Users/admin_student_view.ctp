<div class="users view">
<h2><?php  echo __('User');?></h2>
	<dl>
		<dt class="span3"><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Firstname'); ?></dt>
		<dd>
			<?php echo h($user['User']['firstname']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Lastname'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastname']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Subject'); ?></dt>
		<?php foreach($user['Subject'] as $subject) : ?>
        
		    <?php $subjects[] = $subject['name']; ?>
		     
		<?php endforeach; ?>

		<dd><strong>
			<?php echo implode(', ', $subjects); ?>
		</strong></dd>
	</dl>
</div>
