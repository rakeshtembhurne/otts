<div class="courses index">
	<h2><?php echo __('Courses');?></h2>
	<table class="table table-condensed table-striped table-bordered">
	<tr>	
	        <th><?php echo $this->Paginator->sort('board');?></th>		
			<th><?php echo $this->Paginator->sort('name');?></th>		
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($courses as $course): ?>
	<tr>
	    <td><?php echo h($course['Board']['name']); ?>&nbsp;</td>				
		<td><?php echo h($course['Course']['name']); ?>&nbsp;</td>		
		<td class="actions">			
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $course['Course']['id'], 'admin' => true), array('class' => 'btn btn-info btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $course['Course']['id']), array('class' => 'btn btn-success btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $course['Course']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $course['Course']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>
</div>

