<div class="boards view">
<h2><?php  echo __('Board');?></h2>
	<dl>
		<dt class="span3"><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($board['Board']['id']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($board['Board']['name']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($board['Board']['created']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($board['Board']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

