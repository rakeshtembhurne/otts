<div class="tests index">
	<h2><?php echo __('Tests');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('candidate_id');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('Status');?></th>
            <th><?php echo $this->Paginator->sort('Score');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($tests as $test): ?>
	<tr>
		<td><?php echo h($test['Test']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($test['Candidate']['name'], array('controller' => 'candidates', 'action' => 'view', $test['Candidate']['id'])); ?>
		</td>
		<td><?php echo h($test['Test']['code']); ?>&nbsp;</td>
		<td><?php echo h($test['Test']['created']); ?>&nbsp;</td>
        <?php if ($test['Test']['started'] != null): ?>
		<td><?php echo __('Submitted'); ?>&nbsp;</td>
        <td><?php echo __($test['Test']['score']['totalScore'].'/'. $test['Test']['score']['totalQuestions']); ?>&nbsp;</td>
        <?php else: ?>
        <td><?php echo __('Not submitted'); ?>&nbsp;</td>
        <td><?php echo __('--'); ?>&nbsp;</td>
        <?php endif; ?>
		<td class="actions">
            <?php echo $this->Html->link(__('Review'), array('action' => 'review', $test['Test']['id'])); ?>
            <?php echo $this->Html->link(__('Auto Review'), array('action' => 'auto_review', $test['Test']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $test['Test']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $test['Test']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $test['Test']['id']), null, __('Are you sure you want to delete # %s?', $test['Test']['id'])); ?>
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
