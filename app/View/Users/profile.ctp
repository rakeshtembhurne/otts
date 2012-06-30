<div class="users view well">
<h2><?php  echo __('My Profile');?></h2>
	<dl>
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
		<dt class="span3"><?php echo __('DoB'); ?></dt>
		<dd>
			<?php echo date('m-d-Y', strtotime($user['User']['dob'])); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($user['User']['mobile']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['address']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Pincode'); ?></dt>
		<dd>
			<?php echo h($user['User']['pincode']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
