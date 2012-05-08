<div class="testQuestions index">
	<h2><?php echo __('Test Questions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('test_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('option_1');?></th>
			<th><?php echo $this->Paginator->sort('option_2');?></th>
			<th><?php echo $this->Paginator->sort('option_3');?></th>
			<th><?php echo $this->Paginator->sort('option_4');?></th>
			<th><?php echo $this->Paginator->sort('answer');?></th>
			<th><?php echo $this->Paginator->sort('selected_option');?></th>
			<th><?php echo $this->Paginator->sort('subject');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($testQuestions as $testQuestion): ?>
	<tr>
		<td><?php echo h($testQuestion['TestQuestion']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($testQuestion['Test']['id'], array('controller' => 'tests', 'action' => 'view', $testQuestion['Test']['id'])); ?>
		</td>
		<td><?php echo h($testQuestion['TestQuestion']['title']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['option_1']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['option_2']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['option_3']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['option_4']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['answer']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['selected_option']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['subject']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['created']); ?>&nbsp;</td>
		<td><?php echo h($testQuestion['TestQuestion']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $testQuestion['TestQuestion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $testQuestion['TestQuestion']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $testQuestion['TestQuestion']['id']), null, __('Are you sure you want to delete # %s?', $testQuestion['TestQuestion']['id'])); ?>
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
