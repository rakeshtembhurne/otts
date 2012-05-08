<div class="boards view">
<h2><?php  echo __('Board');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($board['Board']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($board['Board']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($board['Board']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($board['Board']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Board'), array('action' => 'edit', $board['Board']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Board'), array('action' => 'delete', $board['Board']['id']), null, __('Are you sure you want to delete # %s?', $board['Board']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('action' => 'add')); ?> </li>
	</ul>
</div>
