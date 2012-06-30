<div class="questions index">
	<h2><?php echo __('Questions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('subject_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('option_1');?></th>
			<th><?php echo $this->Paginator->sort('option_2');?></th>
			<th><?php echo $this->Paginator->sort('option_3');?></th>
			<th><?php echo $this->Paginator->sort('option_4');?></th>
			<th><?php echo $this->Paginator->sort('answer');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($questions as $question): ?>
	<tr>
		<td><?php echo h($question['Question']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($question['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $question['Subject']['id'])); ?>
		</td>
		<td><?php echo h($question['Question']['title']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option_1']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option_2']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option_3']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['option_4']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['answer']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['created']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $question['Question']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<?php echo $this->element('sidebar'); ?>
