<div class="topics view">
<h2><?php  echo __('Topic');?></h2>
	<dl>
		<dt class="span3"><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($topic['Topic']['id']); ?>
			&nbsp;
		</dd>
		
		<dt class="span3"><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($topic['Topic']['name']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($topic['Topic']['created']); ?>
			&nbsp;
		</dd>
		<dt class="span3"><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($topic['Topic']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
