<div class="topics index">
	<h2><?php echo __('Topics');?></h2>
	<table class="table table-condensed table-striped table-bordered">
	<tr>	
	        <th><?php echo $this->Paginator->sort('subject');?></th>		
			<th><?php echo $this->Paginator->sort('name');?></th>		
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($topics as $topic): ?>
	<tr>
	    <td><?php echo h($topic['Subject']['name']); ?>&nbsp;</td>				
		<td><?php echo h($topic['Topic']['name']); ?>&nbsp;</td>		
		<td class="actions">			
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $topic['Topic']['id'], 'admin' => true), array('class' => 'btn btn-info btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $topic['Topic']['id']), array('class' => 'btn btn-success btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $topic['Topic']['id']), array('class' => 'btn btn-danger btn-mini'), __('Are you sure you want to delete # %s?', $topic['Topic']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>
</div>

