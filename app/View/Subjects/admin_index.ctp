<div class="subjects index">
	<h2><?php echo __('Subjects');?></h2>
	<table class="table table-condensed table-striped table-bordered">
	<tr>			
			
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($subjects as $subject): ?>
	<tr>		
		
		<td><?php echo h($subject['Subject']['name']); ?>&nbsp;</td>		
		<td class="actions">			
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $subject['Subject']['id'], 'admin' => true), array('class' => 'btn btn-info btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $subject['Subject']['id']), array('class' => 'btn btn-success btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $subject['Subject']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $subject['Subject']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>
</div>

