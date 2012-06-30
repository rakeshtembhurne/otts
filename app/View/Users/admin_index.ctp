<?php echo $this->Html->link('New Admin Registation', 
array('action' => 'add', 'admin' => true), 
array('class' => 'btn btn-info btn-large pull-right')
);?>
<div class="admin index">
	<h2><?php echo __('Admin');?></h2>
	<table class="table table-condensed table-striped table-bordered">
	<tr>			
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>		
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>		
		<td class="actions">			
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'], 'admin' => true), array('class' => 'btn btn-info btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-success btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>
</div>

