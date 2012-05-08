<div class="boards index">
	<h2><?php echo __('Boards');?></h2>
	<table class="table table-condensed table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($boards as $board): ?>
	<tr>
		<td><?php echo h($board['Board']['id']); ?>&nbsp;</td>
		<td><?php echo h($board['Board']['name']); ?>&nbsp;</td>
		<td><?php echo h($board['Board']['created']); ?>&nbsp;</td>
		<td><?php echo h($board['Board']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $board['Board']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $board['Board']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $board['Board']['id']), null, __('Are you sure you want to delete # %s?', $board['Board']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>
	</div>
</div>